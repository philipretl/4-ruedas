<?php

namespace Tests\Feature;

use App\Models\Owner;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InfoOwnerTest extends TestCase
{
    protected $url = '/api/v1/owner';
    protected $owners;

    public function setUp(): void
    {
        parent::setUp();

        $this->owners = Owner::factory()
            ->has(Vehicle::factory()->count(3), 'vehicles')
            ->count(3)
            ->create();
    }

    /**
     * @test
     */
    public function it_checks_when_the_owner_id_does_not_exists(){

        $response = $this->withHeaders([
            'Accept' =>  'application/json'
        ])->json('GET', $this->url.'/find/'.-1);
        $response->assertStatus(400)
            ->assertJson([
                'success'=> false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'NOT_FOUND',
                        'message' =>  'Resource not found check your request data.'
                    ]
                ]

            ]);
    }

    /**
     * @test
     */
    public function it_check_if_the_owner_was_founded(){

        $response = $this->withHeaders([
            'Accept' =>  'application/json'
        ])->json('GET', $this->url.'/find/'.$this->owners[0]->id);

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'Owner found in 4 ruedas successfully.',
                'errors' => [],
                'data' => [
                    'owner' => [
                        'id' => $this->owners[0]->id,
                        'full_name' => $this->owners[0]->full_name,
                        'dni' => $this->owners[0]->dni,
                        'user_id' => $this->owners[0]->user->id,
                        'vehicles' => [
                            [
                                'id' => $this->owners[0]->vehicles[0]->id,
                                'brand' => $this->owners[0]->vehicles[0]->brand,
                                'model' => $this->owners[0]->vehicles[0]->model,
                                'vehicle_plate' => $this->owners[0]->vehicles[0]->vehicle_plate,
                                'type' => $this->owners[0]->vehicles[0]->type,

                            ],
                            [
                                'id' => $this->owners[0]->vehicles[1]->id,
                                'brand' => $this->owners[0]->vehicles[1]->brand,
                                'model' => $this->owners[0]->vehicles[1]->model,
                                'vehicle_plate' => $this->owners[0]->vehicles[1]->vehicle_plate,
                                'type' => $this->owners[0]->vehicles[1]->type,

                            ],
                            [
                                'id' => $this->owners[0]->vehicles[2]->id,
                                'brand' => $this->owners[0]->vehicles[2]->brand,
                                'model' => $this->owners[0]->vehicles[2]->model,
                                'vehicle_plate' => $this->owners[0]->vehicles[2]->vehicle_plate,
                                'type' => $this->owners[0]->vehicles[2]->type,

                            ]
                        ]
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'FOUND',
                        'message' =>  'Model Found.'
                    ]
                ]
            ]);
    }

    /**
     * @test
     */
    public function it_check_when_the_list_of_owners_is_empty(){

        $this->owners->each(function($owner){
            $owner->vehicles()->delete();
            $owner->delete();
        });

        $response = $this->withHeaders([
            'Accept' =>  'application/json'
        ])->json('GET', $this->url.'/list');

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'Empty list of owners registered in 4 ruedas.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'EMPTY_LIST',
                        'message' =>  'Empty model list solicited.'
                    ]
                ]

            ]);
    }

    /**
     * @test
     */
    public function it_check_when_the_list_of_owners_is_not_empty(){

        $response = $this->withHeaders([
            'Accept' =>  'application/json'
        ])->json('GET', $this->url.'/list');

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'List of owners registered in 4 ruedas.',
                'data' => [
                    'owners_paginated' => [
                        'owners' => [
                            [
                               'id' => $this->owners[2]->id,
                               'full_name' => $this->owners[2]->full_name,
                               'dni' => $this->owners[2]->dni,
                            ],
                            [
                                'id' => $this->owners[1]->id,
                                'full_name' => $this->owners[1]->full_name,
                                'dni' => $this->owners[1]->dni,
                            ],
                            [
                                'id' => $this->owners[0]->idt ,
                                'full_name' => $this->owners[0]->full_name,
                                'dni' => $this->owners[0]->dni,
                            ]
                        ]
                    ]
                ],
                'errors' => [],
                'messages' => [
                    [
                        'message_code' => 'PAGINATED_LIST',
                        'message' =>  'Paginated model list'
                    ]
                ]

            ]);
    }

}
