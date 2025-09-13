#!/bin/bash

echo "Starting PHP deployment process on Render..."

# Print environment information
echo "PHP Version: $(php -v | head -n 1)"
echo "Current directory: $(pwd)"
echo "Files in current directory:"
ls -la

# Check if we're on Render
if [ "$RENDER" = "true" ]; then
  # Use the Render-specific composer.json
  echo "Running on Render, using composer-render.json"
  cp composer-render.json composer.json
fi

# Install Composer if not already installed
if ! command -v composer &> /dev/null; then
  echo "Installing Composer..."
  EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

  if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
    echo >&2 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
  fi

  php composer-setup.php --quiet
  rm composer-setup.php
  mv composer.phar /usr/local/bin/composer || mv composer.phar ./composer
  echo "Composer installed successfully!"
fi

# Install dependencies
echo "Installing dependencies with Composer..."
composer install --no-interaction

# Set correct permissions
echo "Setting correct file permissions..."
chmod -R 755 .
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

echo "Deployment process completed!"
