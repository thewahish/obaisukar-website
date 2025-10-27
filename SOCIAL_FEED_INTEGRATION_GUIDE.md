# SOCIAL MEDIA FEED INTEGRATION GUIDE
## LinkedIn & Facebook Latest Posts on Homepage

**Created**: October 21, 2025
**For**: www.obaisukar.com homepage
**Purpose**: Display latest LinkedIn and Facebook posts prominently at top of homepage

---

## 🎯 IMPLEMENTATION OPTIONS

### Option 1: LinkedIn & Facebook Official Embeds (RECOMMENDED)
**Pros**:
- No coding required
- Official widgets from LinkedIn/Facebook
- Auto-updates when you post
- Professional appearance
- No API keys needed

**Cons**:
- Requires manual embed code setup once
- Limited customization

### Option 2: Third-Party Aggregator (Alternative)
**Pros**:
- One unified feed
- More customization

**Cons**:
- Requires third-party service (Juicer, Taggbox, etc.)
- May have monthly cost
- Dependency on external service

### Option 3: Custom API Integration (Advanced)
**Pros**:
- Full control over design
- Can filter/customize posts

**Cons**:
- Requires backend development
- Need API keys and authentication
- More complex maintenance

**RECOMMENDATION: Use Option 1 (Official Embeds)**

---

## 📋 STEP-BY-STEP SETUP (Option 1)

### Step 1: Get LinkedIn Post Embed Code

1. **Go to your LinkedIn profile**: https://linkedin.com/in/obaisukar
2. **Find your latest post** you want to feature
3. **Click the "..." menu** (three dots) on the post
4. **Select "Embed"** from the dropdown
5. **Copy the embed code** LinkedIn provides
6. **Save it** - you'll paste this into the website

**Example embed code looks like**:
```html
<iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:123456789" height="400" width="100%" frameborder="0" allowfullscreen="" title="Embedded post"></iframe>
```

---

### Step 2: Get Facebook Post Embed Code

1. **Go to your Facebook page/profile**
2. **Find the post** you want to feature
3. **Click the "..." menu** (three dots) on the post
4. **Select "Embed"**
5. **Click "Advanced Settings"** (optional - to customize appearance)
6. **Copy the embed code** Facebook provides
7. **Save it** - you'll paste this into the website

**Example embed code looks like**:
```html
<div class="fb-post" data-href="https://www.facebook.com/obai.sukar/posts/123456789" data-width="500"></div>
```

**Also need to add** Facebook SDK script (once per page):
```html
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0"></script>
```

---

### Step 3: Alternative - Use Profile Feed Widgets

#### LinkedIn Profile Widget:
LinkedIn offers profile widgets that show recent activity:
1. Go to: https://www.linkedin.com/badges
2. Create a "Profile" badge
3. Customize appearance
4. Get embed code

#### Facebook Page Plugin:
If you have a Facebook page (not personal profile):
1. Go to: https://developers.facebook.com/docs/plugins/page-plugin
2. Enter your Facebook Page URL
3. Customize settings (timeline, events, messages)
4. Generate code

---

## 🎨 DESIGN SPECIFICATIONS

### Layout Structure:
```
┌─────────────────────────────────────────┐
│          HERO SECTION                    │
│   (Name, Title, Current Status)          │
└─────────────────────────────────────────┘
┌─────────────────────────────────────────┐
│     SOCIAL MEDIA FEEDS                   │
│  ┌──────────────┐  ┌──────────────┐    │
│  │  LinkedIn    │  │  Facebook    │    │
│  │  Latest Post │  │  Latest Post │    │
│  └──────────────┘  └──────────────┘    │
└─────────────────────────────────────────┘
┌─────────────────────────────────────────┐
│     REST OF HOMEPAGE CONTENT             │
└─────────────────────────────────────────┘
```

### Styling Guidelines:
- **Container**: Max-width 1200px, centered
- **Grid**: 2 columns on desktop, 1 column on mobile
- **Gap**: 2rem between feeds
- **Background**: Light gray (#F8F9FA) or white
- **Border**: Subtle border or shadow for depth
- **Padding**: 2rem around feeds
- **Responsive**: Stack vertically on mobile (<768px)

---

## 💻 IMPLEMENTATION CODE

### HTML Structure (Add to index.html after hero section):

```html
<!-- Social Media Feeds Section -->
<section class="social-feeds-section">
    <div class="container">
        <h2 class="section-title">Latest Updates</h2>
        <div class="social-feeds-grid">

            <!-- LinkedIn Feed -->
            <div class="feed-container linkedin-feed">
                <div class="feed-header">
                    <svg class="linkedin-icon" width="24" height="24" viewBox="0 0 24 24" fill="#0077B5">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    <h3>LinkedIn</h3>
                </div>
                <div class="feed-content">
                    <!-- PASTE YOUR LINKEDIN EMBED CODE HERE -->
                    <p class="feed-placeholder">LinkedIn embed code goes here</p>
                    <!-- Example: <iframe src="..." height="500" width="100%" frameborder="0"></iframe> -->
                </div>
            </div>

            <!-- Facebook Feed -->
            <div class="feed-container facebook-feed">
                <div class="feed-header">
                    <svg class="facebook-icon" width="24" height="24" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <h3>Facebook</h3>
                </div>
                <div class="feed-content">
                    <!-- PASTE YOUR FACEBOOK EMBED CODE HERE -->
                    <p class="feed-placeholder">Facebook embed code goes here</p>
                    <!-- Example: <div class="fb-post" data-href="..." data-width="500"></div> -->
                </div>
            </div>

        </div>
    </div>
</section>
```

### CSS Styles (Add to stylesheet):

```css
/* Social Media Feeds Section */
.social-feeds-section {
    padding: 4rem 2rem;
    background: var(--light-gray);
    margin-top: 2rem;
}

.social-feeds-section .container {
    max-width: 1200px;
    margin: 0 auto;
}

.social-feeds-section .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--deep-indigo);
    text-align: center;
    margin-bottom: 3rem;
}

.social-feeds-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 2rem;
}

.feed-container {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feed-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.feed-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-light);
}

.feed-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
}

.linkedin-icon,
.facebook-icon {
    width: 28px;
    height: 28px;
}

.feed-content {
    min-height: 400px;
    overflow: hidden;
}

.feed-content iframe {
    width: 100%;
    border: none;
    border-radius: 8px;
}

.feed-placeholder {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--text-light);
    font-style: italic;
    background: var(--light-gray);
    border-radius: 8px;
    border: 2px dashed var(--border-light);
}

/* Responsive Design */
@media (max-width: 768px) {
    .social-feeds-grid {
        grid-template-columns: 1fr;
    }

    .social-feeds-section {
        padding: 3rem 1rem;
    }

    .social-feeds-section .section-title {
        font-size: 2rem;
    }
}
```

---

## 🌐 BILINGUAL VERSION (English & Arabic)

### Arabic Version:

```html
<!-- قسم وسائل التواصل الاجتماعي -->
<section class="social-feeds-section" dir="rtl">
    <div class="container">
        <h2 class="section-title">آخر التحديثات</h2>
        <div class="social-feeds-grid">

            <!-- لينكد إن -->
            <div class="feed-container linkedin-feed">
                <div class="feed-header">
                    <h3>لينكد إن</h3>
                    <svg class="linkedin-icon" width="24" height="24" viewBox="0 0 24 24" fill="#0077B5">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </div>
                <div class="feed-content">
                    <!-- كود التضمين من لينكد إن هنا -->
                    <p class="feed-placeholder">ضع كود لينكد إن هنا</p>
                </div>
            </div>

            <!-- فيسبوك -->
            <div class="feed-container facebook-feed">
                <div class="feed-header">
                    <h3>فيسبوك</h3>
                    <svg class="facebook-icon" width="24" height="24" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </div>
                <div class="feed-content">
                    <!-- كود التضمين من فيسبوك هنا -->
                    <p class="feed-placeholder">ضع كود فيسبوك هنا</p>
                </div>
            </div>

        </div>
    </div>
</section>
```

---

## 🔄 AUTO-UPDATE WORKFLOW

### How This Works:
1. **You post on LinkedIn/Facebook** normally
2. **LinkedIn/Facebook embed automatically updates** to show latest content
3. **No manual website updates needed** - feeds refresh automatically
4. **Visitors see your latest posts** without you touching the code

### To Update Featured Post:
1. **Get new embed code** from the post you want to feature
2. **Replace old embed code** in website HTML
3. **Save and upload** - done!

---

## ⚡ QUICK START CHECKLIST

- [ ] Choose Option 1 (Official Embeds) or Option 2 (Third-party)
- [ ] Get LinkedIn embed code from your latest post
- [ ] Get Facebook embed code from your latest post
- [ ] Add HTML structure to index.html (after hero section)
- [ ] Add CSS styles to stylesheet
- [ ] Paste LinkedIn embed code in appropriate section
- [ ] Paste Facebook embed code in appropriate section
- [ ] Test on desktop and mobile
- [ ] Upload to live site
- [ ] Verify feeds display correctly

---

## 🚀 GOING LIVE

### Testing Locally:
1. Open index.html in browser
2. Check both feeds display correctly
3. Test responsiveness (resize browser)
4. Verify mobile layout

### Deploying:
1. Upload updated index.html to server
2. Clear browser cache
3. Visit www.obaisukar.com
4. Confirm feeds working live

---

## 💡 PRO TIPS

### Best Practices:
1. **Feature your best content** - Choose posts that represent you well
2. **Update periodically** - Swap out embed codes monthly for freshness
3. **Keep it professional** - Only feature work-related content
4. **Test mobile** - Most visitors on mobile, ensure great experience
5. **Monitor performance** - If feeds slow down page, consider alternatives

### Alternative Approach:
**Manual Curated Feed** (if embeds don't work):
- Create static cards with post screenshots
- Link to actual posts on platforms
- Update manually when you have major posts
- More control, less automation

---

## 📞 NEXT STEPS

1. **Get your embed codes** from LinkedIn and Facebook
2. **Send them to me** and I'll integrate them into your website
3. **Or follow this guide** to add them yourself
4. **Test thoroughly** before going live

**Once you have the embed codes, I can create the complete updated index.html file for you!**

---

**Created**: October 21, 2025
**Status**: READY TO IMPLEMENT
**Waiting on**: LinkedIn and Facebook embed codes from you
