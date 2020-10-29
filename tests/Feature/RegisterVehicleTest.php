<?php

namespace Tests\Feature;

use App\Models\Owner;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterVehicleTest extends TestCase
{
   protected $url = '/api/v1/vehicle/register';
   protected $vehicle ;
   protected $owner;


   public function setUp(): void
   {
       parent::setUp();
       $this->owner = Owner::factory()->create();
       $this->vehicle = Vehicle::factory()->make();

   }

   /**
    * @test
    */
    public function it_check_if_the_request_contains_the_vehicle_plate_field()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'type' => $this->vehicle->type,
                'owner_id' => $this->owner->id,

            ]
        );
        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'REQUIRED',
                        'field' => 'vehicle_plate',
                        'message' => 'The vehicle plate field is required.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_check_if_the_request_contains_brand_field()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'model' => $this->vehicle->model,
                'type' => $this->vehicle->type,
                'owner_id' => $this->owner->id,

            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'REQUIRED',
                        'field' => 'brand',
                        'message' => 'The brand field is required.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }
    /**
     * @test
     */
    public function it_check_if_the_request_contains_the_type_field()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'owner_id' => $this->owner->id,

            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'REQUIRED',
                        'field' => 'type',
                        'message' => 'The type field is required.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }
    /**
     * @test
     */
    public function it_check_if_the_request_contains_the_owner_id_field()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'type' => $this->vehicle->type,

            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'REQUIRED',
                        'field' => 'owner_id',
                        'message' => 'The owner id field is required.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_check_if_the_vehicle_type_is_valid()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'type' => 'unsupported type',
                'owner_id' => $this->owner->id,

            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'IN',
                        'field' => 'type',
                        'message' => 'The selected type is invalid.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_check_if_the_owner_id_is_valid()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'type' => $this->vehicle->type,
                'owner_id' => -1,

            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'EXISTS',
                        'field' => 'owner_id',
                        'message' => 'The selected owner id is invalid.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_check_if_the_vehicle_plate_is_already_registered()
    {
        $this->vehicle->owner()->associate($this->owner);
        $this->vehicle->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'type' => $this->vehicle->type,
                'owner_id' => -1,

            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'UNIQUE',
                        'field' => 'vehicle_plate',
                        'message' => 'The vehicle plate has already been taken.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_check_if_the_vehicle_was_registered_correctly()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'vehicle_plate' => $this->vehicle->vehicle_plate,
                'brand' => $this->vehicle->brand,
                'model' => $this->vehicle->model,
                'type' => $this->vehicle->type,
                'owner_id' => $this->owner->id,
            ]
        );

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'description' => 'Vehicle registered in 4 ruedas successfully.',
                'errors' => [],
                'data' => [
                    'vehicle' => [
                        'vehicle_plate' => $this->vehicle->vehicle_plate,
                        'brand' => $this->vehicle->brand,
                        'model' => $this->vehicle->model,
                        'type' => $this->vehicle->type,
                        'owner_id' => $this->owner->id,
                    ]
                ],
                'messages' => [
                    [
                        'message_code' => 'REGISTERED',
                        'message' => 'Process completed.',
                    ],
                ],

            ]);

    }
}
