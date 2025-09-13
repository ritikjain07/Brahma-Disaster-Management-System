#!/bin/bash

# Check if we're on Render
if [ "$RENDER" = "true" ]; then
  # Use the Render-specific composer.json
  echo "Running on Render, using composer-render.json"
  cp composer-render.json composer.json
fi

# Install dependencies
composer install

# Set correct permissions
chmod -R 755 .
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
