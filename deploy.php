<?php
/**
 * GitHub Webhook Auto-Deployment Script
 *
 * This script automatically pulls changes from GitHub when triggered by a webhook.
 * Upload this to your cPanel public_html directory.
 */

// Configuration
define('SECRET_TOKEN', 'CHANGE_THIS_TO_A_RANDOM_SECRET'); // Generate a random string
define('REPO_DIR', '/home/your-cpanel-username/public_html'); // Update with your actual path
define('GIT_BRANCH', 'main');
define('LOG_FILE', __DIR__ . '/deploy.log');

// Security: Verify GitHub webhook secret
function verifyGitHubSignature($payload, $signature) {
    if (empty($signature)) {
        return false;
    }

    $hash = 'sha256=' . hash_hmac('sha256', $payload, SECRET_TOKEN);
    return hash_equals($hash, $signature);
}

// Log function
function logMessage($message) {
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[{$timestamp}] {$message}\n";
    file_put_contents(LOG_FILE, $logEntry, FILE_APPEND);
}

// Main deployment logic
function deploy() {
    $output = [];
    $return_var = 0;

    // Change to repository directory
    chdir(REPO_DIR);

    // Pull latest changes
    exec('git fetch origin ' . GIT_BRANCH . ' 2>&1', $output, $return_var);

    if ($return_var !== 0) {
        logMessage('ERROR: Git fetch failed - ' . implode("\n", $output));
        return false;
    }

    exec('git reset --hard origin/' . GIT_BRANCH . ' 2>&1', $output, $return_var);

    if ($return_var !== 0) {
        logMessage('ERROR: Git reset failed - ' . implode("\n", $output));
        return false;
    }

    logMessage('SUCCESS: Deployment completed - ' . implode("\n", $output));
    return true;
}

// Process webhook request
header('Content-Type: application/json');

// Get payload
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify signature
if (!verifyGitHubSignature($payload, $signature)) {
    logMessage('ERROR: Invalid signature from IP: ' . $_SERVER['REMOTE_ADDR']);
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Invalid signature']);
    exit;
}

// Parse payload
$data = json_decode($payload, true);

// Check if it's a push event to the correct branch
if (isset($data['ref']) && $data['ref'] === 'refs/heads/' . GIT_BRANCH) {
    logMessage('Webhook received for branch: ' . GIT_BRANCH);

    if (deploy()) {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Deployment completed']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Deployment failed']);
    }
} else {
    logMessage('Webhook ignored - not for branch: ' . GIT_BRANCH);
    http_response_code(200);
    echo json_encode(['status' => 'ignored', 'message' => 'Not the target branch']);
}
