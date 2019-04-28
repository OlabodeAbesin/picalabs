<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;

class SubscribeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function can_subscribe()
    {
        $faker =  Factory::create();
        $response = $this->json('POST', 'api/subscribes', [
            'phone' => $phone = $faker->phoneNumber
        ]);
        //Then
        $response->assertJsonStructure(['id', 'phone', 'created_at' ])
        ->assertJson([
            'phone' => $phone
        ])
        ->assertStatus(201);
        $this->assertDatabaseHas('subscribes', [
            'phone' => $phone
        ]);
    }
}
 