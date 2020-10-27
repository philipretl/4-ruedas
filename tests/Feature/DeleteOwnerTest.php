<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteOwnerTest extends TestCase
{
    protected $url = '/api/v1/owner/delete';
    protected $owner;

    public function setUp(): void
    {
        parent::setUp();
        $this->owner = Owner::factory()
            ->has(Vehicle::factory()->count(3), 'vehicles')
            ->create();
    }

    /**
     * @test
     */
    public function it_checks_when_the_owner_does_not_exists(){

        $response = $this->withHeaders([
            'Accept' =>  'application/json'
        ])->json('DELETE', $this->url.'/'.-1);

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
    public function it_checks_when_the_hard_delete_is_success(){

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('DELETE', $this->url.'/'.$this->owner->id,
            [
                'hard_delete' => 'true',
            ]
        );

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'Owner deleted in mallpty succesfuly.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'DELETED',
                        'message' =>  'Process completed.'
                    ]
                ]
            ]);
        $this->assertDeleted($this->owner);
    }

    /**
     * @test
     */
    public function it_checks_when_the_soft_delete_is_sucess(){
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('DELETE', $this->url.'/'.$this->owner->id,
            [
                'hard_delete' => 'false',
            ]
        );

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'Owner deleted in mallpty succesfuly.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'DELETED',
                        'message' =>  'Process completed.'
                    ]
                ]
            ]);
        $this->assertSoftDeleted($this->owner);
    }

    /**
     * @test
     */
    public function it_checks_when_the_soft_delete_is_success_if_hard_delete_value_is_not_present(){
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('DELETE', $this->url.'/'.$this->owner->id,[]);

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'Owner deleted in mallpty succesfuly.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'DELETED',
                        'message' =>  'Process completed.'
                    ]
                ]
            ]);
        $this->assertSoftDeleted($this->owner);
    }

}
