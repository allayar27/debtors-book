<?php

namespace Tests\Feature\Blade;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfilePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_view_user_profile_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.profile'));

        $response->assertStatus(200);
        $response->assertSee($user->email);
    }
}
