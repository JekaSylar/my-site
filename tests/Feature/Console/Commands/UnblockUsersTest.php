<?php
use App\Models\User;
use Illuminate\Support\Carbon;

test('unblock-users command unblocks expired users', function () {

    $unblockableUser = User::factory()->create([
        'blocked_until' => now()->subMinute(),
    ]);

    $stillBlockedUser = User::factory()->create([
        'blocked_until' => now()->addHour(),
    ]);

    $this->artisan('unblock-users')
         ->expectsOutput('1 users have been unblocked.')
         ->assertSuccessful();

    $this->assertDatabaseHas('users', [
        'id' => $unblockableUser->id,
        'blocked_until' => null,
    ]);

    $this->assertDatabaseMissing('users', [
        'id' => $stillBlockedUser->id,
        'blocked_until' => null,
    ]);
});
