<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Factories\UserFactory;
use App\Models\User;
use App\Models\OrganizationHierarchy;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $users = [
            [
                'name' => "Kunga Jigmey",
                'email' => "kj@tibet.net",
            ],
            [   
                 'name' => "Rinchen",
                'email' => "rinchen@tibet.net",
            ],
            [
                'name' => "SP",
                'email' => "sp@tibet.net",
            ]
        ];  
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        // create super-admin users
        foreach($users as $user)
        {
            $u = (new UserFactory)->definition();
            $u['name']      = $user['name'];
            $u['works_at']  = null;   
            $u['email']     = $user['email'];
            $newUser = User::create($u);
            $newUser->assignRole('Super-Admin');
        }
        // crete admin account for each root organization
        $orgs = OrganizationHierarchy::where('belongs_to_id',null)->where('name_short','!=','individual')->get();
        foreach($orgs as $org){
            $user = (new UserFactory)->definition();
            $user['works_at'] = $org['id'];
            $user['name'] = 'Head of '.$org['name_short'];  
            $user['email']  = 'admin-'.strtolower($org['name_short']).'@tibet.net'; 
            $user = User::create($user);
            $user->assignRole('admin');
        }

        // crete staff account for each organization
        foreach($orgs as $org){
            $user = (new UserFactory)->definition();
            $user['works_at'] = $org['id'];
            $user['name'] = 'Front Desk of '. $org['name_short'];    
            $user['email']  = 'front-desk-'.strtolower($org['name_short']).'@tibet.net';
            $user = User::create($user);
            $user->assignRole('front desk');
        }
    }
}
