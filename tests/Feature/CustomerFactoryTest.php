<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_customer_using_factory()
    {
        // Membuat customer menggunakan factory
        $customer = Customer::factory()->create();

        // Assert bahwa customer berhasil dibuat
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'email' => $customer->email,
        ]);
    }

    /** @test */
    public function it_can_create_multiple_customers()
    {
        // Membuat 5 customers
        $customers = Customer::factory()->count(5)->create();

        // Assert bahwa ada 5 customers di database
        $this->assertDatabaseCount('customers', 5);
        $this->assertCount(5, $customers);
    }

    /** @test */
    public function it_can_create_customer_with_custom_data()
    {
        // Membuat customer dengan data spesifik
        $customer = Customer::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Assert bahwa data custom tersimpan
        $this->assertEquals('Test User', $customer->name);
        $this->assertEquals('test@example.com', $customer->email);
    }

    /** @test */
    public function it_can_make_customer_without_saving()
    {
        // Membuat instance customer tanpa menyimpan ke database
        $customer = Customer::factory()->make();

        // Assert bahwa customer tidak ada di database
        $this->assertDatabaseCount('customers', 0);

        // Tapi object customer tetap ada
        $this->assertNotNull($customer->name);
        $this->assertNotNull($customer->email);
    }
}
