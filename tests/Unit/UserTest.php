<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

/**
 * This test suite verifies the functionality of the User model.
 * It tests basic user creation, attributes, password hashing,
 * role assignment, permission verification, and the initials method.
 */

/**
 * Test that a user can be created using the factory.
 * This verifies that the User factory is properly configured
 * and creates valid User instances with expected attributes.
 */
test('user can be created with factory', function () {
    $user = User::factory()->create();

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->not->toBeEmpty()
        ->and($user->email)->toContain('@')
        ->and($user->email_verified_at)->not->toBeNull();
});

/**
 * Test that a user's fillable attributes can be set during creation.
 * This verifies that the User model's $fillable property is correctly configured
 * and that attributes can be properly set and retrieved.
 */
test('user has fillable attributes', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    expect($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com')
        ->and(Hash::check('password123', $user->password))->toBeTrue();
});

/**
 * Test that user passwords are automatically hashed.
 * This verifies that the password attribute is properly cast as 'hashed'
 * and that the original password can be verified against the hash.
 */
test('user password is hashed', function () {
    $user = User::factory()->create([
        'password' => 'password123',
    ]);

    expect($user->password)->not->toBe('password123')
        ->and(Hash::check('password123', $user->password))->toBeTrue();
});

/**
 * Test that a user can be assigned a role.
 * This verifies that the HasRoles trait is properly implemented
 * and that roles can be assigned and checked.
 */
test('user can be assigned a role', function () {
    // Create a role if it doesn't exist
    $roleName = 'test-role';
    $role = Role::firstOrCreate(['name' => $roleName]);

    $user = User::factory()->create();
    $user->assignRole($roleName);

    expect($user->hasRole($roleName))->toBeTrue();
});

/**
 * Test that a user can have multiple roles.
 * This verifies that the HasRoles trait can handle multiple role assignments
 * and that all assigned roles can be verified.
 */
test('user can have multiple roles', function () {
    // Create roles if they don't exist
    $roleNames = ['role1', 'role2', 'role3'];
    foreach ($roleNames as $roleName) {
        Role::firstOrCreate(['name' => $roleName]);
    }

    $user = User::factory()->create();
    $user->assignRole($roleNames);

    foreach ($roleNames as $roleName) {
        expect($user->hasRole($roleName))->toBeTrue();
    }
});

/**
 * Test that the user factory can create a user with a specific role.
 * This verifies that the role-specific factory methods (like doctor(), nurse(), etc.)
 * correctly assign the appropriate role to the created user.
 */
test('user factory can create user with specific role', function () {
    $roleName = 'doctor-role';

    // Ensure the role exists
    Role::firstOrCreate(['name' => $roleName]);

    $user = User::factory()->doctor()->create();

    expect($user->hasRole($roleName))->toBeTrue();
});

/**
 * Test that a user has permissions through roles.
 * This verifies that the permission inheritance through roles works correctly,
 * allowing users to have permissions via their assigned roles.
 */
test('user has permissions through roles', function () {
    // Create a role with permissions
    $roleName = 'test-permission-role';
    $permissionName = 'test-permission';

    $permission = Permission::firstOrCreate(['name' => $permissionName]);
    $role = Role::firstOrCreate(['name' => $roleName]);
    $role->givePermissionTo($permission);

    $user = User::factory()->create();
    $user->assignRole($role);

    expect($user->hasPermissionTo($permissionName))->toBeTrue();
});

/**
 * Test that the initials() method returns the correct initials.
 * This verifies that the custom initials() method correctly extracts
 * the first letter of each of the first two words in a user's name.
 * It tests various name formats including single names, two-word names,
 * and multi-word names.
 */
test('initials method returns correct initials', function () {
    $testCases = [
        'John Doe' => 'JD',
        'Jane Smith' => 'JS',
        'Single' => 'S',
        'Multiple Word Name' => 'MW',
        'A B C D' => 'AB',
    ];

    foreach ($testCases as $name => $expectedInitials) {
        $user = User::factory()->create(['name' => $name]);
        expect($user->initials())->toBe($expectedInitials);
    }
});
