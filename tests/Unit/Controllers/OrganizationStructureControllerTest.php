<?php

namespace Tests\Unit\Controllers;

use App\Models\OrganizationHierarchy;
use App\Models\OrganizationType;
use App\Models\User;
use Database\Seeders\OrganizationHierarchySeeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
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

    // Test adding Organization with User which Does not Belongs to Organization
    public function test_adding_organization_to_different_org_than_user_works_in()
    {
        $org = OrganizationHierarchy::where('name_short', 'Kashag')->first();
        $tsjcUser = User::where('name', 'Head of Tsjc')->first();
        $tsjcOrg = OrganizationHierarchy::where('name_short', 'TSJC')->first();
        $this->assertNotEquals($tsjcUser->works_at, $org->id);
        $this->assertTrue($tsjcUser->can('manage sub organizations'));

        $response = $this->actingAs($tsjcUser)->post(route('organization-structure.add'), [
            'name_short' => 'Tsjc user',
            'name' => 'Tsjc user',
            'id' => $org->id,
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('organization_hierarchies', [
            'name_short' => 'Tsjc user',
            'name' => 'Tsjc user',
            'id' => $org->id,
        ]);
    }

    // Test adding Organization with User which Belongs to Organization
    public function test_adding_organization_to_same_org_where_user_works_at()
    {
        $kashagOrg = OrganizationHierarchy::where('name', 'Kashag')->first();
        $kashagUser = User::where('name', 'front desk of Kashag')->first();
        $this->assertEquals($kashagOrg->id, $kashagUser->works_at);
        $this->assertTrue($kashagUser->can('manage sub organizations'));

        $response = $this->actingAs($kashagUser)->post('organization-structure/add', [
            'name_short' => 'Org und Kashag',
            'name' => 'Organization Under Kashag',
            'id' => $kashagOrg->id
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('organization_hierarchies', [
            'name_short' => 'Org und Kashag',
            'name' => 'Organization Under Kashag',
            'belongs_to_id' => $kashagOrg->id,
        ]);

        $subOrg = OrganizationHierarchy::where('name', 'Organization Under Kashag')->first();

        $reponse1 = $this->actingAs($kashagUser)->post('organization-structure/add', [
            'name_short' => 'Sub Org und resp',
            'name' => 'Sub Organization Under Response',
            'id' => $subOrg->id
        ]);

        $reponse1->assertStatus(302);
        $this->assertDatabaseHas('organization_hierarchies', [
            'name_short' => 'Sub Org und resp',
            'name' => 'Sub Organization Under Response',
            'belongs_to_id' => $subOrg->id
        ]);
    }

    // Test editing Organization with User which Does not Belongs to Organization
    public function test_editing_organization_to_different_org_than_user_works_in()
    {
        $KashagOrg = OrganizationHierarchy::where('name', 'Kashag')->first();
        $kashagUser = User::where('name', 'Front Desk of Kashag')->first();
        $tsjcUser = User::where('name', 'Front Desk of TSJC')->first();
        $this->assertNotEquals($KashagOrg->id, $tsjcUser->works_at);

        $response1 = $this->actingAs($kashagUser)->post('organization-structure/add', [
            'name_short' => 'Kashag Org',
            'name' => 'Kashag Org',
            'id' => $KashagOrg->id,
        ]);

        $createdOrg = OrganizationHierarchy::where('name', 'Kashag Org')->first();

        $this->assertNotNull($createdOrg);

        $response = $this->actingAs($tsjcUser)->post('organization-structure/edit', [
            'id' => $createdOrg->id,
            'name' => 'Tsjc Org',
            'name_short' => 'Tsjc Org',
        ]);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('organization_hierarchies', [
            'id' => $createdOrg->id,
            'name' => 'Tsjc Org',
            'name_short' => 'Tsjc Org',
            'belongs_to_id' => $KashagOrg->id,
        ]);
    }

    // Test editing Organization with User which Belongs to Organization
    public function test_editing_organization_to_same_org_where_user_works_at()
    {
        $KashagOrg = OrganizationHierarchy::where('name', 'Kashag')->first();
        $KashagUser = User::where('name', 'Front Desk of Kashag')->first();
        $this->assertEquals($KashagOrg->id, $KashagUser->works_at);
        $this->assertTrue($KashagUser->can('manage sub organizations'));

        $this->actingAs($KashagUser)->post('organization-structure/add', [
            'name_short' => 'wed',
            'name' => 'Women Empowerment',
            'id' => $KashagOrg->id,
        ]);

        $createdOrg = OrganizationHierarchy::where('name', 'Women Empowerment')->first();

        $this->assertNotNull($createdOrg);

        $response = $this->actingAs($KashagUser)->post('organization-structure/add', [
            'name_short' => 'Sub Org und resp',
            'name' => 'Sub Organization Under Response',
            'id' => $createdOrg->id
        ]);

        $editOrg = OrganizationHierarchy::where('name', 'Sub Organization Under Response')->first();

        $this->assertNotNull($editOrg);

        $this->actingAs($KashagUser)->post('organization-structure/edit', [
            'id' => $editOrg->id,
            'name' => 'Kashag Changed from WED',
            'name_short' => 'Kashag Organization',
        ]);

        $this->assertDatabaseHas('organization_hierarchies', [
            'name' => 'Kashag Changed from WED',
            'name_short' => 'Kashag Organization',
            'belongs_to_id' => $createdOrg->id
        ]);
    }

    // Test Deleting Organization with User which Belongs to Organization
    public function test_deleting_organization_to_same_org_where_user_works_at()
    {
        $kashagUser = User::where('name', 'Front Desk of Kashag')->first();
        $kashagOrg = OrganizationHierarchy::where('name', 'Kashag')->first();
        $this->assertEquals($kashagOrg->id, $kashagUser->works_at);
        $this->assertTrue($kashagUser->can('manage sub organizations'));

        $this->actingAs($kashagUser)->post('organization-structure/add', [
            'name' => 'kashag-organization',
            'name_short' => 'Kashag-org',
            'id' => $kashagOrg->id,
        ]);

        $kashagSecOrg = OrganizationHierarchy::where('name', 'kashag-organization')->first();
        $this->assertNotNull($kashagSecOrg);

        $this->actingAs($kashagUser)->post('organization-structure/add', [
            'name' => 'Kashag-sub-organization',
            'name_short' => 'kashag-sub',
            'id' => $kashagSecOrg->id
        ]);

        $kashagSubOrg = OrganizationHierarchy::where('name', 'Kashag-sub-organization')->first();

        $response = $this->actingAs($kashagUser)->delete('organization-structure/delete', ['id' => $kashagSubOrg->id]);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('organization_hierarchies', [
            'id' => $kashagSubOrg->id
        ]);
    }

    // Test Deleting Organization with User which Does not Belongs to Organization
    public function test_deleting_organization_to_different_org_than_user_works_in()
    {
        $kashagUser = User::where('name', 'Front Desk of Kashag')->first();
        $tsjcUser = User::where('name', 'Front Desk of TSJC')->first();
        $KashagOrg = OrganizationHierarchy::where('name', 'Kashag')->first();
        $this->assertNotEquals($KashagOrg->id, $tsjcUser->works_at);
        $this->assertTrue($tsjcUser->can('manage sub organizations'));

        $this->actingAs($kashagUser)->post('organization-structure/add', [
            'name' => 'Kashag - Section ABC',
            'name_short' => 'kashag-section-abc',
            'id' => $KashagOrg->id,
        ]);

        $kashagSecOrg = OrganizationHierarchy::where('name', 'Kashag - Section ABC')->first();
        $this->assertNotNull($kashagSecOrg);

        $response = $this->actingAs($tsjcUser)->delete(route('organization-structure.delete', ['id' => $kashagSecOrg->id]));
        $response->assertStatus(403);

        $this->assertDatabaseHas('organization_hierarchies', [
            'id' => $kashagSecOrg->id
        ]);
    }
}
