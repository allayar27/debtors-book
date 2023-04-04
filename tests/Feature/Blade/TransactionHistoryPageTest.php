<?php

namespace Tests\Feature\Blade;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionHistoryPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_view_transaction_history_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('transaction-history'));

        $response->assertStatus(200);
        $response->assertSee( __('No data not found'));
    }
}
