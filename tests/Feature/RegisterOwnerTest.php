<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterOwnerTest extends TestCase
{
    protected $url = '/api/v1/owner/register';
    protected $owner;

    public function setUp():void{
        parent::setUp();
        $this->owner = Owner::factory()->make();
    }

    /**
     * @test
     */
    public function it_check_if_the_request_contains_the_field_name()
    {


        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
               'last_name' => $this->owner->last_name,
               'dni' => $this->owner->dni,

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
        ])->json('POST', $this->url,
            [
                'name' => $this->owner->name,
                'dni' => $this->owner->dni,

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
        ])->json('POST', $this->url,
            [
                'name' => $this->owner->name,
                'last_name' => $this->owner->last_name,
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
        ])->json('POST', $this->url,
            [
                'name' => $this->owner->name,
                'last_name' => $this->owner->last_name,

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

        $this->owner->save();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'name' => $this->owner->name,
                'last_name' => $this->owner->last_name,
                'dni' => $this->owner->dni,

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
    public function it_check_if_the_owner_was_registered_correctly()
    {


        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', $this->url,
            [
                'name' => $this->owner->name,
                'last_name' => $this->owner->last_name,
                'dni' => $this->owner->dni,
            ]
        );
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'description' => 'Owner registered in 4 ruedas successfully.',
                'errors' => [],
                'data' => [
                    'owner' => [
                        'full_name' => $this->owner->full_name,
                        'dni' => $this->owner->dni,
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
