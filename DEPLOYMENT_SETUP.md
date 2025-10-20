# GitHub to cPanel Auto-Deployment Setup Guide

## Overview
This guide will help you set up automatic deployment from your GitHub repository to your cPanel hosting at obaisukar.com.

## Prerequisites
- SSH access to your cPanel account
- Git installed on your server (most cPanel hosts have this)
- Your GitHub repository: https://github.com/thewahish/website

---

## Step 1: Prepare Your Server

### 1.1 SSH into your cPanel server
```bash
ssh your-username@obaisukar.com
```

### 1.2 Navigate to your website directory
```bash
cd ~/public_html
# or wherever your website lives
```

### 1.3 Initialize git repository on server (if not already done)
```bash
# If public_html is not a git repository yet:
git init
git remote add origin https://github.com/thewahish/website.git
git fetch origin
git checkout main
```

### 1.4 Set up SSH key for GitHub (for passwordless pulls)
```bash
# Generate SSH key on server
ssh-keygen -t ed25519 -C "your-email@example.com"

# Copy the public key
cat ~/.ssh/id_ed25519.pub

# Add this key to GitHub:
# Go to: https://github.com/settings/keys
# Click "New SSH key"
# Paste the key
```

### 1.5 Update git remote to use SSH
```bash
cd ~/public_html
git remote set-url origin git@github.com:thewahish/website.git
```

---

## Step 2: Upload Deployment Script

### Option A: Using cPanel File Manager
1. Log in to cPanel: https://obaisukar.com:2083
2. Go to File Manager
3. Upload `deploy.php` to `public_html/deploy.php`

### Option B: Using FTP
1. Connect via FTP
2. Upload `deploy.php` to your website root

### Option C: Using SSH/SCP
```bash
scp deploy.php your-username@obaisukar.com:~/public_html/
```

---

## Step 3: Configure the Deployment Script

Edit `deploy.php` on your server and update these values:

```php
// Line 11: Generate a random secret (keep this private!)
define('SECRET_TOKEN', 'your-random-secret-here-abc123xyz789');

// Line 12: Update with your actual cPanel path
define('REPO_DIR', '/home/your-cpanel-username/public_html');
```

To find your exact path, SSH into your server and run:
```bash
pwd
```

### Generate a secure secret token:
```bash
# On your local machine or server:
openssl rand -hex 32
```

---

## Step 4: Set Permissions

```bash
# SSH into your server
chmod 755 ~/public_html/deploy.php
chmod 666 ~/public_html/deploy.log  # Will be created automatically
```

---

## Step 5: Configure GitHub Webhook

1. Go to your GitHub repository: https://github.com/thewahish/website

2. Click **Settings** → **Webhooks** → **Add webhook**

3. Fill in the form:
   - **Payload URL**: `https://obaisukar.com/deploy.php`
   - **Content type**: `application/json`
   - **Secret**: (paste the SECRET_TOKEN you created in Step 3)
   - **Which events**: Select "Just the push event"
   - **Active**: ✓ Checked

4. Click **Add webhook**

---

## Step 6: Test the Setup

### 6.1 Manual test via command line
```bash
# On your local machine
echo "<!-- Test comment -->" >> index.html
git add .
git commit -m "Test auto-deployment"
git push origin main
```

### 6.2 Check deployment log on server
```bash
# SSH into server
tail -f ~/public_html/deploy.log
```

You should see a log entry showing successful deployment.

### 6.3 Verify website updated
Open your website and check if the changes appear.

---

## Troubleshooting

### Issue: "Permission denied" errors
```bash
# On server:
chmod -R 755 ~/public_html
git config --global --add safe.directory ~/public_html
```

### Issue: Git asks for password
- Make sure you set up SSH keys correctly (Step 1.4-1.5)
- Verify SSH key is added to GitHub

### Issue: Webhook shows error in GitHub
- Check the deployment log: `cat ~/public_html/deploy.log`
- Verify the SECRET_TOKEN matches in both deploy.php and GitHub webhook
- Check file permissions on deploy.php

### Issue: Changes not appearing
- Check if git pull actually happened: `git log` on server
- Clear browser cache
- Check `.htaccess` rules aren't blocking updates

### View deployment logs
```bash
# SSH into server
cat ~/public_html/deploy.log
# or watch in real-time:
tail -f ~/public_html/deploy.log
```

---

## Your Workflow After Setup

1. Make changes locally: `obai_sukar_website_final.html`
2. Commit changes: `git add . && git commit -m "Update homepage"`
3. Push to GitHub: `git push origin main`
4. **Website updates automatically!** ✨

No more FTP uploads needed.

---

## Security Notes

- **Keep SECRET_TOKEN private** - never commit it to GitHub
- Consider adding IP restrictions if GitHub provides webhook IPs
- Regularly check `deploy.log` for suspicious activity
- Use HTTPS (you already have this at obaisukar.com)

---

## Alternative: Simple Cron Job Method

If webhooks don't work, you can use a cron job to pull changes every few minutes:

1. SSH into server
2. Run: `crontab -e`
3. Add this line:
```
*/5 * * * * cd ~/public_html && git pull origin main >> ~/deploy-cron.log 2>&1
```

This pulls changes every 5 minutes (less instant but simpler).

---

## Quick Reference

- **GitHub Repo**: https://github.com/thewahish/website
- **Webhook URL**: https://obaisukar.com/deploy.php
- **cPanel**: https://obaisukar.com:2083
- **Deployment Log**: `~/public_html/deploy.log`

---

## Need Help?

Common cPanel Git documentation:
- Most cPanel hosts have Git version manager in the control panel
- Look for "Git Version Control" in cPanel tools
- Some hosts provide automatic deployment UI (check if yours does)
