#!/bin/bash

# Navigate to the application directory
cd /var/www/html

# Install dependencies if package.json exists
if [ -f "package.json" ]; then
    echo "Installing npm dependencies..."
    npm install

    echo "Running build process..."
    npm run build
fi

# Make sure the build artifacts have correct permissions
echo "Setting permissions..."
chown -R webapp:webapp /var/www/html
chmod -R 755 /var/www/html

echo "Build process completed successfully!"