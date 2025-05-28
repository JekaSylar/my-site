<?php
use App\Models\User;
use Carbon\Carbon;

//Index User

test('guest cannot access admin users index', function () {
    $response = $this->get(route('users.index'));

    $response->assertRedirect(route('login'));
});


test('admin can access users index', function () {
    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $response = $this->actingAs($admin)->get(route('users.index'));

    $response->assertStatus(200);
});

test('non admin cannot access admin users index', function () {
    $user = User::factory()->create([
        'is_admin' => 0,
    ]);

    $response = $this->actingAs($user)->get(route('users.index'));

    $response->assertStatus(403);
});

//Create User

test('admin can access user create', function () {
    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $response = $this->actingAs($admin)->get(route('users.create'));

    $response->assertStatus(200);
});

test('non admin cannot access admin user create', function () {
    $user = User::factory()->create([
        'is_admin' => 0,
    ]);

    $response = $this->actingAs($user)->get(route('users.create'));

    $response->assertStatus(403);
});

//Store User
test('admin can create user', function () {

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);


    $newUserData = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'secret123',
    ];

    $response = $this->actingAs($admin)->post(route('users.store'), $newUserData);

    $response->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', [
        'email' => $newUserData['email'],
        'name' => $newUserData['name'],
    ]);
});

test('user creation fails with missing required fields', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->post(route('users.store'), []);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
});


test('non-admin cannot create a user', function () {
    $user = User::factory()->create([
        'is_admin' => false,
    ]);

    $response = $this->actingAs($user)->post(route('users.store'), [
        'name' => 'Unauthorized User',
        'email' => 'unauth@example.com',
        'password' => 'secret123',
    ]);

    $response->assertForbidden();
});

test('guest cannot create a user', function () {
    $response = $this->post(route('users.store'), [
        'name' => 'Guest User',
        'email' => 'guest@example.com',
        'password' => 'secret123',
    ]);

    $response->assertRedirect(route('login'));
});

//Edit User
test('admin can access user edit', function () {
    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $userToEdit = User::factory()->create();

    $response = $this->actingAs($admin)->get(route('users.edit', $userToEdit));

    $response->assertStatus(200);
});

test('non admin cannot access admin user edit', function () {
    $user = User::factory()->create([
        'is_admin' => 0,
    ]);

    $userToEdit = User::factory()->create();

    $response = $this->actingAs($user)->get(route('users.edit', $userToEdit));

    $response->assertStatus(403);
});


//Update User
test('admin can update user', function () {

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);


    $userToEdit = User::factory()->create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
    ]);

    $updatedData = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
    ];

    $response = $this->actingAs($admin)->put(
        route('users.update', $userToEdit),
        $updatedData
    );

    $response->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $userToEdit->id,
        'name' => 'Test User',
        'email' => 'testuser@example.com',
    ]);
});


test('non-admin cannot update  user', function () {

    $no_admin = User::factory()->create([
        'is_admin' => false,
    ]);

    $userToEdit = User::factory()->create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
    ]);

    $updatedData = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
    ];


    $response = $this->actingAs($no_admin)->put(
        route('users.update', $userToEdit),
        $updatedData
    );


    $response->assertStatus(403);
});

test('user update fails with missing required fields', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
    ]);

    $userToEdit = User::factory()->create();

    $response = $this->actingAs($admin)->put(route('users.update', $userToEdit), []);

    $response->assertSessionHasErrors(['name', 'email']);
});

//Delete User

test('admin can delete user', function () {

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);


    $userToDelete = User::factory()->create([
        'name' => 'Delete Name',
        'email' => 'delete@example.com',
    ]);

    $response = $this->actingAs($admin)->delete(
        route('users.destroy', $userToDelete),
    );

    $response->assertRedirect(route('users.index'));

    $this->assertDatabaseMissing('users', [
        'email' => $userToDelete->email,
    ]);

});

test('no-admin can delete user', function () {

    $no_admin = User::factory()->create([
        'is_admin' => 0,
    ]);


    $userToDelete = User::factory()->create([
        'name' => 'Delete Name',
        'email' => 'delete@example.com',
    ]);

    $response = $this->actingAs($no_admin)->delete(
        route('users.destroy', $userToDelete),
    );

    $response->assertStatus(403);

});


//Search Users

test('admin can search users', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $response = $this->actingAs($admin)->get(route('users.search', ['search' => 'John']));

    $response->assertStatus(200);
    $response->assertSee('John Doe');
});

test('non-admin cannot search users', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get(route('users.search', ['search' => 'John']));

    $response->assertStatus(403);
});


//Email Verified User

test('admin can set email_verified_at to now', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $user = User::factory()->create(['email_verified_at' => null]);

    $response = $this->actingAs($admin)->post(route('users.change.email.verified', $user), [
        'email_verified_at' => true,
    ]);

    $response->assertRedirect(route('users.index'));

    $this->assertNotNull($user->fresh()->email_verified_at);
});

test('non-admin cannot set email_verified_at', function () {
    $user = User::factory()->create(['is_admin' => false]);
    $targetUser = User::factory()->create(['email_verified_at' => null]);

    $response = $this->actingAs($user)->post(route('users.change.email.verified', $targetUser), [
        'email_verified_at' => true,
    ]);

    $response->assertStatus(403);
});


//Change Block
test('admin can block user until specific date', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $user = User::factory()->create(['blocked_until' => null]);

    $blockedUntil = now()->addDays(3)->format('Y-m-d H:i:s');

    $response = $this->actingAs($admin)->post(route('users.change.block', $user), [
        'blocked_until' => $blockedUntil,
    ]);

    $response->assertRedirect(route('users.index'));

    $this->assertEquals(
        Carbon::parse($blockedUntil)->format('Y-m-d H:i:s'),
        $user->fresh()->blocked_until
    );
});


test('non-admin cannot block user', function () {
    $user = User::factory()->create(['is_admin' => false]);
    $targetUser = User::factory()->create();

    $response = $this->actingAs($user)->post(route('users.change.block', $targetUser), [
        'blocked_until' => now()->addDays(5)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(403);
});
