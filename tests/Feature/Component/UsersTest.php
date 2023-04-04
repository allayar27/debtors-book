<?php

namespace Tests\Feature\Component;

use App\Http\Livewire\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;


    public function test_create_users()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('users'))->assertOk();

        Livewire::test(Users::class)
            ->set('name', 'User')
            ->set('email', 'test@mail.com')
            ->set('password', 'pass1234')
            ->set('password_confirmation', 'pass1234')
            ->call('create');

        $this->assertTrue(User::where('name', 'User')->exists());

    }


    public function test_users_fields_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('users'))->assertOk();

        Livewire::test(Users::class)
            ->set('name', '')
            ->set('email', '')
            ->call('create')
            ->assertHasErrors([
                'name' => 'required',
                'email' => 'required'
            ]);
    }


    public function test_delete_users()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('users'))->assertOk();

        $create = User::factory()->create([
            'id' => 2,
            'name' => 'Debtor',
            'email' => 'test@mail.com'
        ]);

        Livewire::test(Users::class)
            ->call('deleteConfirm', $create->id)
            ->assertDispatchedBrowserEvent('delete-confirm')
            ->call('delete');

        $this->assertDatabaseMissing('users', ['id' => 2]);
    }


    public function test_component_can_render()
    {
        $component = Livewire::test(Users::class);
        $component->assertStatus(200);
    }
}
