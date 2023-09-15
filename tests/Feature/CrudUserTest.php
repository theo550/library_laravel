<?php

use App\Models\BookVersion;
use App\Models\User;

test('create new user', function () {

    $response = $this->post('api/users', [
        "name" => "Théo Gaudin",
        "email" => "test@test.test",
        "email_verified_at" => "12121212",
        "password" => "123456",
        "remember_token" => "EDEFF34F-£424_D34FRS"
    ]);

    $response->assertOk();
    expect(User::all()->count())->toBe(1);
});

test('number of books by user', function() {

    $user = User::factory()->create();
    $bookVersion = BookVersion::factory()->create();

    $response = $this->post('api/library', [
        "reading_state" => "non lu",
        "book_version_id" => $bookVersion->id,
        "user_id" => $user->id
    ]);

    $response->assertOk();
    expect(User::with('bookVersions')
        ->where('id', $user->id)
        ->first()
        ->bookVersions
        ->count())
    ->toEqual(1);
});

test('remove user', function() {
    $user = User::factory()->create();
    $id = $user->id;

    $response = $this->delete('api/users/' . $id);

    $response->assertOk();
    expect(User::all()->count())->toEqual(0);
});

test('update user', function() {
    $user = User::factory()->create();
    $id = $user->id;

    $response = $this->put('api/users/' . $id, [
        "name" => "test",
        "email" => "a@a.a",
        "email_verified_at" => "12121212",
        "password" => "123456",
        "remember_token" => "EDEFF34F-£424_D34FRS"
    ]);

    $response->assertOk();
    expect($user->first()->name)->toEqual('test');
    expect($user->first()->email)->toEqual('a@a.a');
});
