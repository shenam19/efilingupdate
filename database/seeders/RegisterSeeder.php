<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationHierarchy;
use App\Models\Register;

class RegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgs = OrganizationHierarchy::whereNull('belongs_to_id')->get();
        
        foreach($orgs as $org)
        {
            $register = $org->registers()->firstOrCreate(
                ['fiscal_year'=>'2022 - 2023'],
                ['incoming_no'=>$org->incoming_register, 'outgoing_no'=>$org->outgoing_register]
            );
        }
    }
}
