<?php

namespace Tests\Unit\Models;

use App\Models\OrganizationHierarchy;
use App\Models\OrganizationType;
use App\Models\User;
use Database\Seeders\OrganizationHierarchySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Role;
use Tests\TestCase;


class OrganizationHierarchyModelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_should_return_null_when_parent_org_is_not_set()
    {
        $govType = OrganizationType::where('name_short', 'gov')->first();
        $org = new OrganizationHierarchy();
        $org->name_short = 'TPiE';
        $org->type_id = $govType->id;
        $org->save();
        $this->assertEquals($org->parent, null);
    }

    public function test_should_return_parent_org_when_parent_org_is_set(): void
    {
        $govType = OrganizationType::where('name', 'Government')->first();

        $parliament = new OrganizationHierarchy();
        $parliament->name = 'Parliament';
        $parliament->name_short = 'Parliament';
        $parliament->type_id = $govType->id;
        $parliament->save();

        $threePillarType = OrganizationType::where('name', 'Three Pillars')->first();
        $tpie = new OrganizationHierarchy();
        $tpie->name_short = 'TPiE';
        $tpie->type_id = $threePillarType->id;
        $tpie->belongs_to_id = $parliament->id;
        $tpie->save();
        $this->assertEquals($tpie->parent->id, $parliament->id);
    }

    public function test_to_check_whether_the_user_works_at_particular_organziation_hierachy()
    {
        $user = User::where('name', 'Head of TCRC')->first();
        $org = OrganizationHierarchy::where('name_short', 'TCRC')->first();
        $this->assertEquals($user->works_at, $org->id);
    }
}
