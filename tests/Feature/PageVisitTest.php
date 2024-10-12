<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageVisitTest extends TestCase
{
    //use RefreshDatabase;

    public function test_super_admin_can_visit_staff_manage_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('Super-Admin');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/manage-staff/listMyStaff');

        $response->assertStatus(200);
    }

    public function test_super_admin_can_visit_organization_structure_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('Super-Admin');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/organization-structure/index');

        $response->assertStatus(200);
    }

    public function test_admin_can_visit_staff_manage_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('admin');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/manage-staff/listMyStaff');

        $response->assertStatus(200);
    }

    public function test_admin_can_visit_organization_structure_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('admin');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/organization-structure/index');

        $response->assertStatus(200);
    }

     public function test_front_desk_can_visit_staff_manage_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('front desk');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/manage-staff/listMyStaff');

        $response->assertStatus(200);
    }

    public function test_front_desk_can_visit_organization_structure_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('front desk');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/organization-structure/index');

        $response->assertStatus(200);
    }

    public function test_staff_can_not_visit_staff_manage_page()
    {   
        $user = User::factory()->create();
        //Adding permissions via a role
        $user->assignRole('staff');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/manage-staff/listMyStaff');

        $response->assertStatus(403);
    }

    public function test_staff_can_not_visit_organization_structure_page()
    {   
        $user = User::factory()->create();
        $user->assignRole('staff');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->get('/organization-structure/index');

        $response->assertStatus(403);
    }
    

}
