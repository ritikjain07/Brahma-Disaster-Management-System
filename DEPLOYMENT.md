# Brahma Disaster Management System

## Deploying on Render

Follow these steps to deploy the Brahma Disaster Management System on Render:

### Prerequisites

1. [Render.com](https://render.com) account
2. Git repository with your Brahma code
3. Your MySQL database (for schema export)

### Step 1: Export your MySQL database schema to PostgreSQL format

1. Make sure your local MySQL server is running
2. Run the schema export script:
   ```
   php database/export_schema.php
   ```
3. This will create `database/postgresql_schema.sql` with the PostgreSQL-compatible schema

### Step 2: Set up your Render Blueprint

1. Make sure your repository contains:
   - `composer.json`
   - `Procfile`
   - `render.yaml`

2. Push all changes to your Git repository

### Step 3: Deploy to Render

1. Log in to your Render dashboard
2. Click "New +"
3. Select "Blueprint"
4. Connect your Git repository
5. Follow the prompts to deploy

### Step 4: Configure Environment Variables

After deployment, navigate to your web service in Render and add these environment variables:

1. `SMTP_HOST` - Your SMTP server host
2. `SMTP_USERNAME` - Your SMTP username
3. `SMTP_PASSWORD` - Your SMTP password
4. `RAZORPAY_KEY_ID` - Your Razorpay key ID
5. `RAZORPAY_KEY_SECRET` - Your Razorpay key secret

### Step 5: Initialize the Database

1. Go to your PostgreSQL database in Render
2. Access the "Shell" tab
3. Import your schema:
   ```
   psql -d brahma_db < /path/to/postgresql_schema.sql
   ```

### Troubleshooting

If you encounter issues:

1. Check the logs in your Render dashboard
2. Make sure all environment variables are set correctly
3. Verify that your database has been properly initialized
4. Ensure your PHP code is compatible with PostgreSQL (the adapter should handle most differences)

## Local Development

To run this project locally:

1. Configure your MySQL database in `config/env.php`
2. Make sure your web server (Apache) is running
3. Navigate to the project URL in your browser
