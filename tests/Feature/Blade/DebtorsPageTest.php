<?php

namespace Tests\Feature\Blade;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DebtorsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_debtors_page_contain_empty_table()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('debtors'));
        $response->assertStatus(200);

        $response->assertSee(__('No data not found'));
    }
}
