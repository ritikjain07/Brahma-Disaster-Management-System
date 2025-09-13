<?php
/**
 * Environment Configuration for Render Deployment
 * 
 * This file will load environment variables from Render's environment
 * and make them available to your application.
 */

// Check if we're on Render and use their environment variables
if (getenv('RENDER') === 'true') {
    // Database configuration
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_USERNAME', getenv('DB_USERNAME'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
    define('DB_NAME', getenv('DB_NAME'));
    
    // Email configuration
    define('SMTP_HOST', getenv('SMTP_HOST'));
    define('SMTP_USERNAME', getenv('SMTP_USERNAME'));
    define('SMTP_PASSWORD', getenv('SMTP_PASSWORD'));
    define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
    define('SMTP_ENCRYPTION', getenv('SMTP_ENCRYPTION') ?: 'tls');
    define('EMAIL_FROM', getenv('EMAIL_FROM') ?: 'no-reply@brahma.com');
    define('EMAIL_FROM_NAME', getenv('EMAIL_FROM_NAME') ?: 'Brahma Disaster Management');
    
    // Payment gateway configuration
    define('RAZORPAY_KEY_ID', getenv('RAZORPAY_KEY_ID'));
    define('RAZORPAY_KEY_SECRET', getenv('RAZORPAY_KEY_SECRET'));
    
    // Other configuration
    define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'admin@brahma.com');
    define('ENVIRONMENT', 'production');
} else {
    // Local environment - load from sensitive.php
    if (file_exists(__DIR__ . '/sensitive.php')) {
        require_once(__DIR__ . '/sensitive.php');
    } else {
        die('Error: Configuration file sensitive.php not found');
    }
}
