<?php

namespace Tests\Feature\Blade;

use App\Models\Debtor;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaidDebtsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_paid_debts_page_contain_empty_table()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('paid-debts'));
        $response->assertStatus(200);

        $response->assertSee(__('No paid debts not found'));
    }


    public function test_paid_debts_page_contain_non_empty_table()
    {
        $user = User::factory()->create();

        Transaction::factory()->create([
            'user_id' => $user->id,
            'debtor_id' => Debtor::factory()->create()->id,
            'received_amount' => 100.00,
            'transaction_remark' => 'debits_remark',
            'transaction_type' => 'debit'
        ]);

        $response = $this->actingAs($user)->get(route('paid-debts'));
        $response->assertStatus(200);

        $response->assertDontSee(__('No paid debts not found'));
    }
}
