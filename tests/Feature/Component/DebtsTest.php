<?php

namespace Tests\Feature\Component;

use App\Http\Livewire\Debts;
use App\Models\Debtor;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DebtsTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_create_debts()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/home/debts')->assertOk();
        
        $debtor = Debtor::factory()->create();

        Livewire::test(Debts::class)
                ->set('user_id', $user->id)
                ->set('debtor_id', $debtor->id)
                ->set('pay_amount', 1234.00)
                ->set('transaction_remark', 'debts')
                ->set('transaction_type', 'credit')
                ->call('create')
                ->assertDispatchedBrowserEvent('created');

        $this->assertTrue(Transaction::where('transaction_type', 'credit')->exists());
        $this->assertTrue(Debtor::where('balance', -1234.00)->exists());
    }


    public function test_debts_validation_rules()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/home/debts');

        Livewire::test(Debts::class)
                ->set('debtor_id', '')
                ->set('pay_amount', '')
                ->call('create')
                ->assertHasErrors([
                    'debtor_id' => 'required',
                    'pay_amount' => 'required'
                ]);
    }


    public function test_auth_user_can_delete_debts()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user)->get('/home/debts');

        $debtor = Debtor::factory()->create();
        
        $debts = Transaction::factory()->create([
            'user_id' => $user->id,
            'debtor_id' => $debtor->id,
            'pay_amount' => 123.00,
            'transaction_remark' => 'give debts',
            'transaction_type' => 'credit'
        ]);

        Livewire::test(Debts::class)
                ->call('deleteConfirm', $debts->id)
                ->assertDispatchedBrowserEvent('delete-confirm')
                ->call('delete')
                ->assertDispatchedBrowserEvent('deleted', ['message' => 'долг удалено успешно!']);

        $this->assertDatabaseMissing('transactions', ['transaction_type' => 'credit']);

    }

    public function test_the_debts_component_can_render()
    {
        $component = Livewire::test(Debts::class);
        $component->assertStatus(200);
    }

}
