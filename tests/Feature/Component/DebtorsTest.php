<?php

namespace Tests\Feature\Component;

use App\Http\Livewire\Debtors;
use App\Models\Debtor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DebtorsTest extends TestCase
{
    use RefreshDatabase;


    public function test_auth_user_can_create_debtors()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/home/debtors')->assertOk();

        Livewire::test(Debtors::class)
                ->set('name', 'Bob')
                ->set('phone', 123456789)
                ->call('create');

        $this->assertTrue(Debtor::where('name', 'Bob')->exists());
        
    }


    public function test_debtors_fields_is_required()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/home/debtors')->assertOk();

        Livewire::test(Debtors::class)
            ->set('name', '')
            ->set('phone', )
            ->call('create')
            ->assertHasErrors([
                'name' => 'required',
                'phone' => 'required'
            ]);
    }


    public function test_auth_user_can_delete_debtors()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/home/debtors')->assertOk();

        $debtor = Debtor::factory()->create([
            'id' => 1,
            'name' => 'Debtor',
            'phone' => 123456789
        ]);

        Livewire::test(Debtors::class)
                ->call('deleteConfirm', $debtor->id)
                ->assertDispatchedBrowserEvent('delete-confirm')
                ->call('delete');

        $this->assertDatabaseMissing('debtors', ['id' => 1]);
    }


    public function test_the_debtors_component_can_render()
    {
        $component = Livewire::test(Debtors::class);
        $component->assertStatus(200);
    }

}
