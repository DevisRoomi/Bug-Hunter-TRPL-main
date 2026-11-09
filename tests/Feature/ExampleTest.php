<?php

namespace Tests\Feature;

use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('images/hero-bg.jpg');
    }

    public function test_equipment_image_is_displayed(): void
    {
        Equipment::create([
            'name' => 'Power Bank',
            'image' => 'images/power-bank.jpg',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Power Bank');
        $response->assertSee('images/power-bank.jpg');
    }

    public function test_backpack_is_displayed(): void
    {
        $backpack = Equipment::create([
            'name' => 'Backpack',
            'image' => 'images/backpack.jpg',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Backpack');
        $response->assertSee('images/backpack.jpg');

        $borrowResponse = $this->get(route('borrowings.create', $backpack));
        $borrowResponse->assertStatus(200);
        $borrowResponse->assertSee('Pinjam Backpack');
        $borrowResponse->assertSee('images/backpack.jpg');
    }
}
