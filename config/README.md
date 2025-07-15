# Configuration Directory

This directory contains configuration files for the Brahma Disaster Management System.

## Files

### `sensitive.php.example`
This is an example file showing the structure of sensitive configuration data. 

### `sensitive.php` (NOT in version control)
This file contains actual sensitive information like:
- Email credentials (SMTP username, password)
- Payment gateway API keys
- Database credentials (if different from main config)
- API keys for external services

## Setup Instructions

1. Copy `sensitive.php.example` to `sensitive.php`
2. Replace the placeholder values with your actual credentials
3. Never commit `sensitive.php` to version control

## Security Notes

- The `sensitive.php` file is ignored by Git (see `.gitignore`)
- Keep your credentials secure and never share them in public repositories
- Use environment variables in production environments
- Regularly rotate your API keys and passwords

## Required Configuration

Make sure to update the following in `sensitive.php`:
- `SMTP_PASSWORD`: Your actual Gmail app password
- `RAZORPAY_KEY_SECRET`: Your Razorpay secret key
- `WEATHER_API_KEY`: Your weather API key (if using weather services)
- `MAPS_API_KEY`: Your maps API key (if using mapping services)
- `ENCRYPTION_KEY`: A strong encryption key for data protection
- `JWT_SECRET`: A secret key for JWT token generation
