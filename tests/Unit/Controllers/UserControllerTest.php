<?php

namespace Tests\Unit;

use App\Models\OrganizationHierarchy;
use App\Models\OrganizationType;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
    }
    public function test_adding_users()
    {
        $works_at = OrganizationHierarchy::where('name', 'Tibetan Supreme Justice Commission')->first();
        $position = Position::findOrFail(rand(1,14));

        $user = User::where('name', 'Front Desk of Kashag')->firstOrFail();

        $response = $this->actingAs($user)->post(route('manage-staff.store'),[
            'name' => 'Test Staff',
            'email' => 'Test@tibet.net',
            'password' => 'password',
            'password_confirmation' => 'password',
            'works_at' => $works_at->id,
            'position_id' => $position->id
        ]);

        // dd($response->getSession()->all());

        $response->assertStatus(302);

        // $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users',[
            'name' => 'Test Staff',
            'email' => 'Test@tibet.net',
            'works_at' => $works_at->id,
            'position_id' => $position->id
        ]);
    }

    // public function test_adding_users_with_invalid_user()
    // {

    // }
}
