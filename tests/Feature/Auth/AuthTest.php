<?php

namespace Tests\Feature\Auth;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_the_home_page_after_login()
    {
        
        User::factory()->create([
            'name' => 'User',
            'email' => 'test@mail.com',
            'password' => Hash::make('password')
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@mail.com',
            'password' => 'password'//'12345678'
        ]);

        $response->assertRedirect('/home');
        
    }


    public function test_can_view_login_page()
    {
        $this->get(route('/'))
            ->assertSuccessful()
            ->assertSeeText('Вход');
    }
   
    public function test_unauthenticated_user_cannot_access_home_page()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }


    public function test_can_a_user_logout()
    {
        $user = User::factory()->create();
        $this->be($user); // login your user in system

        $this->post(route('logout'))
            ->assertRedirect(route('/')); // redirect to login, 
        $this->assertGuest(); // check that your user not auth more

    }
}
