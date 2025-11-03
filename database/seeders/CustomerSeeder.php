<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 1 customer
        Customer::factory()->create();

        // Membuat 10 customers
        Customer::factory()->count(10)->create();

        // Membuat customer dengan data spesifik
        // Customer::factory()->create([
        //     'name' => 'John Doe',
        //     'email' => 'john@example.com',
        //     'phone' => '081234567890',
        //     'address' => 'Jl. Sudirman No. 1, Jakarta'
        // ]);

        // Membuat customer dengan override beberapa field
        // Customer::factory()->create([
        //     'email' => 'jane@example.com',
        // ]);
    }
}
