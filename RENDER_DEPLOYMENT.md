# Brahma Disaster Management System

![Brahma Logo](assets/images/logo_brahma.png)

A comprehensive disaster management system designed to assist in emergency response and coordination. The platform provides tools for disaster reporting, missing person tracking, medical aid, weather alerts, and more.

## Deployment to Render

This guide will walk you through deploying the Brahma Disaster Management System to [Render](https://render.com).

### Prerequisites

- A [Render](https://render.com) account
- A [GitHub](https://github.com) account
- MySQL database (Render provides this)
- SMTP email credentials (for notification features)
- Razorpay account (for donation features)

### Step 1: Fork or Push to GitHub

Push your code to GitHub:

```bash
# Initialize git repository
git init

# Add all files
git add .

# Commit changes
git commit -m "Initial commit"

# Add remote repository
git remote add origin https://github.com/ritikjain07/brahma-disaster-management.git

# Push to GitHub
git push -u origin main
```

### Step 2: Set Up MySQL Database on Render

1. Log into your Render dashboard
2. Go to "New" > "PostgreSQL" (Render uses PostgreSQL, so we'll need to adapt our code)
3. Fill in the details:
   - Name: brahma-disaster-db
   - Database: brahma_db
   - User: brahma_user
4. Click "Create Database"
5. Note the database connection details provided

### Step 3: Deploy Web Service to Render

1. From your Render dashboard, go to "New" > "Web Service"
2. Connect your GitHub repository
3. Fill in the details:
   - Name: brahma-disaster-management
   - Environment: PHP
   - Build Command: `composer install`
   - Start Command: `vendor/bin/heroku-php-apache2`
4. Under "Advanced" > "Environment Variables", add the following:
   - `DB_HOST`: Your Render database host
   - `DB_NAME`: brahma_db
   - `DB_USERNAME`: Your Render database username
   - `DB_PASSWORD`: Your Render database password
   - `SMTP_HOST`: Your SMTP host (e.g., smtp.gmail.com)
   - `SMTP_USERNAME`: Your email address
   - `SMTP_PASSWORD`: Your email password/app password
   - `SMTP_PORT`: 587
   - `EMAIL_FROM`: Your sender email
   - `EMAIL_FROM_NAME`: Brahma Disaster Management
   - `RAZORPAY_KEY_ID`: Your Razorpay key ID
   - `RAZORPAY_KEY_SECRET`: Your Razorpay secret key
5. Click "Create Web Service"

### Step 4: Database Migration

Since Render uses PostgreSQL instead of MySQL, we need to adapt our SQL schema:

1. Export your MySQL schema:
   ```bash
   php export_schema.php
   ```

2. Open the generated `database/schema.sql` file and make the following changes:
   - Replace MySQL-specific types with PostgreSQL types
   - Adjust AUTO_INCREMENT to SERIAL
   - Remove backticks and replace with double quotes

3. Import the schema via Render's database dashboard or using a tool like pgAdmin

### Step 5: Update Your Database Code (If Necessary)

If your project heavily relies on MySQL-specific features, you'll need to update:

1. Connection code to use `pg_connect()` instead of `mysqli`
2. Query syntax for PostgreSQL compatibility

### Step 6: Test Your Deployment

1. Once deployment completes, click on the URL provided by Render
2. Test all features to ensure they're working
3. Check logs for any errors

## Troubleshooting

### Common Issues

1. **Database Connection Errors**:
   - Check your environment variables
   - Verify that your database service is running
   - Make sure your IP is whitelisted in the database firewall

2. **Missing Files**:
   - Check your `.gitignore` file to ensure important files are not excluded
   - Make sure all necessary files are committed to your repository

3. **SMTP Configuration**:
   - Verify your email credentials
   - Check that your email provider allows app passwords or less secure app access

4. **Razorpay Integration**:
   - Ensure your Razorpay keys are correct
   - Test payments in test mode

## Local Development

For local development:

1. Clone the repository
2. Set up XAMPP/WAMP with PHP 7.4+ and MySQL
3. Import the database schema
4. Update the configuration files
5. Run the application on your local server

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

For questions or support, contact Ritik Jain at ritikjain4560@gmail.com
