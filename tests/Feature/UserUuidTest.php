<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class AuthenticationTest
 *
 * @package Tests\Feature
 */
class UserUuidTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_auto_generated_uuid()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        self::assertNotNull($user->uuid);
    }

    public function test_uuid_not_custom()
    {
        $uuid = Str::uuid();

        /** @var \App\Models\User $user */
        $user = User::factory()->create(['uuid' => $uuid]);

        self::assertNotEquals($uuid, $user->uuid);
    }
}
