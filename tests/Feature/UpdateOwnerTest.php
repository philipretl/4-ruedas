<?php

namespace Tests\Feature;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateOwnerTest extends TestCase
{
    protected $url = '/api/v1/owner/update';
    protected $owner;
    protected $owner_unsaved;

    public function setUp():void{
        parent::setUp();
        $this->owner_unsaved = Owner::factory()->make();
        $this->owner = Owner::factory()->create();
    }

    /**
     * @test
     */
    public function it_check_if_the_request_contains_the_field_name()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'last_name' => $this->owner_unsaved->last_name,
                'dni' => $this->owner_unsaved->dni,

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
                        'field' => 'name',
                        'message' => 'The name field is required.',
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
    public function it_check_if_the_request_contains_the_field_last_name()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'name' => $this->owner_unsaved->name,
                'dni' => $this->owner_unsaved->dni,

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
                        'field' => 'last_name',
                        'message' => 'The last name field is required.',
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
    public function it_check_if_the_dni_is_numeric()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'name' => $this->owner_unsaved->name,
                'last_name' => $this->owner_unsaved->last_name,
                'dni' => 'it is not a numeric dni',

            ]
        );
        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'NUMERIC',
                        'field' => 'dni',
                        'message' => 'The dni must be a number.',
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
    public function it_check_if_the_request_contains_the_field_dni()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'name' => $this->owner_unsaved->name,
                'last_name' => $this->owner_unsaved->last_name,

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
                        'field' => 'dni',
                        'message' => 'The dni field is required.',
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
    public function it_check_if_owner_dni_is_already_registered()
    {
        $this->owner_unsaved->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'name' => $this->owner_unsaved->name,
                'last_name' => $this->owner_unsaved->last_name,
                'dni' => $this->owner_unsaved->dni,
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
                        'field' => 'dni',
                        'message' => 'The dni has already been taken.',
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
    public function it_checks_if_the_owner_to_update_exists(){

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . -1,
            [
                'name' => $this->owner_unsaved->name,
                'last_name' => $this->owner_unsaved->last_name,
                'dni' => $this->owner_unsaved->dni,
            ]
        );
        $response->assertStatus(400)
            ->assertJson([
                'success'=> false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [],
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
    public function it_check_if_the_owner_was_updated_correctly()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'name' => $this->owner_unsaved->name,
                'last_name' => $this->owner_unsaved->last_name,
                'dni' => $this->owner_unsaved->dni,
            ]
        );
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'description' => 'Owner updated in 4 ruedas successfully.',
                'errors' => [],
                'data' => [
                    'owner' => [
                        'full_name' => $this->owner_unsaved->full_name,
                        'dni' => $this->owner_unsaved->dni,
                    ]
                ],
                'messages' => [
                    [
                        'message_code' => 'UPDATED',
                        'message' => 'Process completed.',
                    ],
                ],

            ]);

    }

    /**
     * @test
     */
    public function it_check_if_the_owner_was_updated_correctly_with_the_same_dni()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('PUT', $this->url. '/' . $this->owner->id,
            [
                'name' => $this->owner_unsaved->name,
                'last_name' => $this->owner_unsaved->last_name,
                'dni' => $this->owner->dni,
            ]
        );
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'description' => 'Owner updated in 4 ruedas successfully.',
                'errors' => [],
                'data' => [
                    'owner' => [
                        'full_name' => $this->owner_unsaved->full_name,
                        'dni' => $this->owner->dni,
                    ]
                ],
                'messages' => [
                    [
                        'message_code' => 'UPDATED',
                        'message' => 'Process completed.',
                    ],
                ],

            ]);

    }
}
