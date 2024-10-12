<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organization_types')->insert([
            [
                'id' => 1, 
                'name_short' => 'gov',
                'name' => 'Government',                
            ],
            [
                'id' => 2, 
                'name_short' => 'pillar',
                'name' => 'Three Pillars',                            
            ],
            [
                'id' => 3, 
                'name_short' => 'indi org',
                'name' => 'Independent Organization',                            
            ],
            [
                'id' => 4, 
                'name_short' => 'dep',
                'name' => 'Department',                            
            ],
            [
                'id' => 5, 
                'name_short' => 'sec',
                'name' => 'Section',                            
            ],
            [
                'id' => 6, 
                'name_short' => 'sub sec',
                'name' => 'Sub Section',                            
            ],
            [
                'id' => 7, 
                'name_short' => 'external',
                'name' => 'external',                            
            ]

        ]);
        
    }
}
