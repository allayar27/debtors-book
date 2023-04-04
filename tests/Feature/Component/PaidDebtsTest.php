<?php

namespace Tests\Feature\Component;

use App\Http\Livewire\PaidDebts;
use App\Models\Debtor;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PaidDebtsTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_create_paid_debts()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('paid-debts'))->assertOk();

        $debtor = Debtor::factory()->create();

        Livewire::test(PaidDebts::class)
            ->set('user_id', $user->id)
            ->set('debtor_id', $debtor->id)
            ->set('received_amount', 1234.00)
            ->set('transaction_remark', 'paid')
            ->set('transaction_type', 'debit')
            ->call('create')
            ->assertDispatchedBrowserEvent('created', ['message' => 'оплата долга создан успешно!']);

        $this->assertTrue(Transaction::where('transaction_type', 'debit')->exists());
        $this->assertTrue(Debtor::where('balance', 1234.00)->exists());
    }


    public function test_paid_debts_validation_rules()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('paid-debts'))->assertOk();

        Livewire::test(PaidDebts::class)
            ->set('debtor_id', '')
            ->set('received_amount', '')
            ->call('create')
            ->assertHasErrors([
                'debtor_id' => 'required',
                'received_amount' => 'required'
            ]);
    }


    public function test_auth_user_can_delete_paid_debts()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('paid-debts'))->assertOk();

        $debtor = Debtor::factory()->create();

        $debts = Transaction::factory()->create([
            'user_id' => $user->id,
            'debtor_id' => $debtor->id,
            'received_amount' => 123.00,
            'transaction_remark' => 'back debts',
            'transaction_type' => 'debit'
        ]);

        Livewire::test(PaidDebts::class)
            ->call('deleteConfirm', $debts->id)
            ->assertDispatchedBrowserEvent('delete-confirm')
            ->call('delete')
            ->assertDispatchedBrowserEvent('deleted', ['message' => 'оплата долга удалено успешно!']);

        $this->assertDatabaseMissing('transactions', ['transaction_type' => 'debit']);

    }

    public function test_the_debts_component_can_render()
    {
        $component = Livewire::test(PaidDebts::class);
        $component->assertStatus(200);
    }
}
