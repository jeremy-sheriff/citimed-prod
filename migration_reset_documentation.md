# Migration Reset Documentation

## Issue
Reset the migration named `2025_07_26_231705_create_balances_table.php` to pick up the new columns.

## Solution
The migration file already contained the necessary columns:
- `payment_id` (foreign key referencing payments table)
- `amount` (string)
- `status` (enum with values: 'cleared', 'not_cleared', 'carried_foward')

A reset script was created to roll back and reapply the migration, ensuring that the database schema includes these columns.

## Steps Taken
1. Created a reset script (`reset_balances_migration.sh`) to:
   - Roll back the last migration
   - Reapply the migration

2. Made the script executable:
   ```bash
   chmod +x reset_balances_migration.sh
   ```

3. Executed the script:
   ```bash
   ./reset_balances_migration.sh
   ```

4. Verified that the migration was successfully reset and reapplied:
   ```bash
   php artisan migrate:status
   ```

## Result
The migration was successfully reset and reapplied. The `balances` table now includes all the required columns as defined in the migration file.

## Date
2025-08-03
