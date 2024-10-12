<?php

namespace Tests\Unit;

use App\Models\OrganizationHierarchy;
use App\Models\OrganizationType;
use App\Models\User;
use Database\Seeders\OrganizationHierarchySeeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationStructureControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_adding_organization()
    {
        $org = OrganizationHierarchy::where('name_short', 'Education')->first();
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'TestAdmin@tibet.net';
        $user->password = bcrypt('password');
        $user->works_at = $org->id;
        $user->save();
        $user->assignRole('front desk');
        $this->actingAs($user);

        $sectionType = OrganizationType::where('name', 'Section')->first();


        //ACT
        $response = $this->post(route('organization-structure.add'),[
            'name_short' => 'Test',
            'type_id' => $sectionType->id,
            'belongs_to_id' => $org->id,
        ]);

        //ASSERT
        $response->assertStatus(500);
    }

}
