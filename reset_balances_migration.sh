#!/bin/bash

# Script to reset the balances migration
echo "Resetting balances migration..."

# Roll back the migration
php artisan migrate:rollback --step=1

# Run the migration again
php artisan migrate

echo "Migration reset completed."
