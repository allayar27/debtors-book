<?php

namespace Tests\Feature\Blade;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersPageTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_page_contains_non_empty_table()
    {
        $user = User::factory()->create([
            'id' => 1,
            'name' => 'User',
            'email' => 'test@mail.com'
        ]);

        $response = $this->actingAs($user)->get(route('users'));
        $response->assertStatus(200);

        $response->assertSee($user->email);
    }
}
