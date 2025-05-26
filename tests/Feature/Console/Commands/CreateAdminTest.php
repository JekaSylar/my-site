<?php
use Illuminate\Support\Facades\Hash;
use App\Models\User;

test('create-admin command creates an admin user', function () {
    $this->artisan('create-admin')
         ->expectsQuestion('Email:', 'admin@example.com')
         ->expectsQuestion('Name:', 'Super Admin')
         ->expectsQuestion('Password:', 'secret123')
         ->expectsOutput('Admin created successfully!')
         ->assertSuccessful();

    $this->assertDatabaseHas('users', [
        'email' => 'admin@example.com',
        'name' => 'Super Admin',
        'is_admin' => 1,
    ]);


    $user = User::where('email', 'admin@example.com')->first();
    $this->assertTrue(Hash::check('secret123', $user->password));
});
