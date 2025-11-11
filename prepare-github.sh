#!/bin/bash

echo "=========================================="
echo "     LAPOS - GitHub Repository Setup      "
echo "=========================================="
echo ""
echo "Preparing repository for: https://github.com/bicknicktick/LAPOS-kasir"
echo ""

# Remove existing database to avoid pushing it
echo "➤ Removing database file..."
rm -f database/database.sqlite
touch database/database.sqlite
echo "✓ Database file cleaned"

# Clean Laravel caches
echo ""
echo "➤ Cleaning Laravel caches..."
php artisan cache:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
echo "✓ Caches cleaned"

# Create .env.example if not exists
echo ""
echo "➤ Preparing .env.example..."
cp .env .env.example 2>/dev/null || true
echo "✓ Environment example created"

# Initialize Git repository
echo ""
echo "➤ Initializing Git repository..."
git init
echo "✓ Git initialized"

# Add all files
echo ""
echo "➤ Adding files to Git..."
git add .
echo "✓ Files added"

# Create initial commit
echo ""
echo "➤ Creating initial commit..."
git commit -m "🎉 Initial commit - LAPOS Point of Sale System

- Modern POS interface with real-time search
- Product inventory management
- Multiple payment methods support
- Currency redenomination ready
- Professional reporting system
- Powered by e.bitzy.id"
echo "✓ Initial commit created"

# Add remote origin
echo ""
echo "➤ Adding remote origin..."
git branch -M main
git remote add origin https://github.com/bicknicktick/LAPOS-kasir.git 2>/dev/null || git remote set-url origin https://github.com/bicknicktick/LAPOS-kasir.git
echo "✓ Remote origin configured"

echo ""
echo "=========================================="
echo "           Setup Complete!                "
echo "=========================================="
echo ""
echo "To push to GitHub, run:"
echo ""
echo "  git push -u origin main"
echo ""
echo "If the repository doesn't exist yet, create it at:"
echo "  https://github.com/new"
echo ""
echo "Repository name: LAPOS-kasir"
echo "Description: Modern Point of Sale System - Powered by e.bitzy.id"
echo ""
echo "Don't forget to:"
echo "  1. Star ⭐ the repository"
echo "  2. Add topics: laravel, pos-system, point-of-sale, php, sqlite"
echo "  3. Set it as Public"
echo ""
echo "Support development: https://paypal.me/bitzyid"
echo "=========================================="
