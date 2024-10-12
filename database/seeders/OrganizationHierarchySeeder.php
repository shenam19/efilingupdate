<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrganizationHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organization_hierarchies')->insert([
                    
            [   
                'id' => 1,
                'name_short' =>   'Kashag',
                'name' => 'Kashag',                
                'type_id' => 2, //pillar
                'belongs_to_id' => null
            ],
            [
                'id' => 2,
                'name_short' =>   'TSJC',
                'name' => 'Tibetan Supreme Justice Commission',                
                'type_id' => 2, // pillar
                'belongs_to_id' => null
            ],
            [
                'id' => 3,
                'name_short' =>   'TPiE',
                'name' => 'Tibetan Parliament in Exile',                
                'type_id' => 2, //pillar
                'belongs_to_id' => null
            ],
            [
                'id' => 4,
                'name_short' =>   'Election',
                'name' => 'Election Commission',                
                'type_id' => 3, //indi
                'belongs_to_id' => null
            ],
            [
                'id' => 5,
                'name_short' =>   'Audit',
                'name' => 'Audit Section',                
                'type_id' => 3, //indi
                'belongs_to_id' => null
            ],
            [
                'id' => 6,
                'name_short' =>   'PSC',
                'name' => 'Public Service Commission',                
                'type_id' => 3, //indi
                'belongs_to_id' => null
            ],
            [
                'id' => 7,
                'name_short' =>   'DIIR',
                'name' => 'Department of Information & International Relations',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ],
            [
                'id' => 8,
                'name_short' =>   'Education',
                'name' => 'Department of Education',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ],
            [   
                'id' => 9,
                'name_short' =>   'Home',
                'name' => 'Department of Home',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ]
            ,
            [   
                'id' => 10,
                'name_short' =>   'Health',
                'name' => 'Department of Health',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ],
            [   
                'id' => 11,
                'name_short' =>   'Finance',
                'name' => 'Department of Finance',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ],
            [
                'id' => 12,
                'name_short' =>   'Security',
                'name' => 'Department of Security',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ],
            [
                'id' => 13,
                'name_short' =>   'Religion',
                'name' => 'Department of Religion & Culture',                
                'type_id' => 4, //Dep
                'belongs_to_id' => null
            ],
            [
                'id' => 14,
                'name_short' =>   'TCRC',
                'name' => 'Tibetan Computer Resource Center',                
                'type_id' => 5, //Sec
                'belongs_to_id' => null
            ],
            [
                'id' => 15,
                'name_short' =>   'TPI',
                'name' => 'Tibet Policy Institute',                
                'type_id' => 5, //Sec
                'belongs_to_id' => null
            ],
            [
                'id' => 16,
                'name_short' =>   'KAS',
                'name' => 'Kashag Archive Section',                
                'type_id' => 5, //Sec
                'belongs_to_id' => null
            ],
            [
                'id' => 17,
                'name_short' =>   'Administrative Section',
                'name' => 'Administrative Section',                
                'type_id' => 5, //Section
                'belongs_to_id' => 8 //Education
            ],  
            [
                'id' => 18,
                'name_short' =>   'Academic Section',
                'name' => 'Academic Section',                
                'type_id' => 5, //Section
                'belongs_to_id' => 8 //Education
            ],
            [
                'id' => 19,
                'name_short' =>   'Scholarship & Sponsorship Section',
                'name' => 'Scholarship & Sponsorship Section',                
                'type_id' => 5, //Section
                'belongs_to_id' => 8 //Education
            ],
            [
                'id' => 20,
                'name_short' =>   'Education Council',
                'name' => 'Education Council',                
                'type_id' => 5, //Section
                'belongs_to_id' => 8 //Education
            ],
            [
                'id' => 21,
                'name_short' =>   'Traditional',
                'name' => 'Traditional',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 18 //Academic Section
            ],
            [
                'id' => 22,
                'name_short' =>   'Modern',
                'name' => 'Modern',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 18 //Academic Section
            ],
            [
                'id' => 23,
                'name_short' =>   'Guidance & Counselling Section',
                'name' => 'Guidance & Counselling Section',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 18 //Academic Section
            ],
            [
                'id' => 24,
                'name_short' =>   'Terminology Section',
                'name' => 'Terminology Section',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 18 //Academic Section
            ],
            [
                'id' => 25,
                'name_short' =>   'Scholarship Section',
                'name' => 'Scholarship Section',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 19 //Scholarship & Sponsorship Section
            ],
            [
                'id' => 26,
                'name_short' =>   'Sponsorship Section',
                'name' => 'Sponsorship Section',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 19 //Scholarship & Sponsorship Section
            ]
            ,
            [
                'id' => 27,
                'name_short' =>   'Office Administration',
                'name' => 'Office Administration',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 17 //Administrative Section
            ],
            [
                'id' => 28,
                'name_short' =>   'Account',
                'name' => 'Account',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 17 //Administrative Section
            ]
            ,
            [
                'id' => 29,
                'name_short' =>   'Project',
                'name' => 'Project',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 17 //Administrative Section
            ]
            ,
            [
                'id' => 30,
                'name_short' =>   'Administrative',
                'name' => 'Administrative',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 20 //Education Council
            ]
            ,
            [
                'id' => 31,
                'name_short' =>   'Textbook',
                'name' => 'Textbook',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 20 //Education Council
            ]
            ,
            [
                'id' => 32,
                'name_short' =>   'Publication',
                'name' => 'Publication',                
                'type_id' => 6, //Sub Section
                'belongs_to_id' => 20 //Education Council
            ]
            ,
            [
                'id' => 33,
                'name_short' =>   'Welfare & Administrative Section',
                'name' => 'Welfare & Administrative Section',                
                'type_id' => 5, //Section,
                'belongs_to_id' => 10 //Health,
            ]
            ,
            [
                'id' => 34,
                'name_short' =>   'Programs Section',
                'name' => 'Programs Section',                
                'type_id' => 5, //Section,
                'belongs_to_id' => 10 //Health,
            ]
            ,
            [
                'id' => 35,
                'name_short' =>   'Administrative Section',
                'name' => 'Administrative Section',                
                'type_id' => 6, //Sub Section,
                'belongs_to_id' => 33 //Health Welfare & Administrative Section
            ],
            [
                'id' => 36,
                'name_short' =>   'Accounts Section',
                'name' => 'Accounts Section',                
                'type_id' => 6, //Sub Section,
                'belongs_to_id' => 33 //Health Welfare & Administrative Section
            ],
            [
                'id' => 37,
                'name_short' =>   'Welfare Section',
                'name' => 'Welfare Section',                
                'type_id' => 6, //Sub Section,
                'belongs_to_id' => 33 //Health Welfare & Administrative Section
            ],
            [
                'id' => 38,
                'name_short' =>   'Public Health Programs',
                'name' => 'Public Health Programs',                
                'type_id' => 6, //Sub Section,
                'belongs_to_id' => 34 //Health Programs Section
            ],
            [
                'id' => 39,
                'name_short' =>   'Disease Preventation Programs',
                'name' => 'Disease Preventation Programs',                
                'type_id' => 6, //Sub Section,
                'belongs_to_id' => 34 //Health Programs Section
            ],
            [
                'id' => 40,
                'name_short' =>   'Projects Section',
                'name' => 'Projects Section',                
                'type_id' => 6, //Sub Section,
                'belongs_to_id' => 34 //Health Programs Section
            ],
            [
                'id' => 41,
                'name_short' =>   'Agriculture & Co-op Division',
                'name' => 'Agriculture & Co-op Division',                
                'type_id' => 5, //Section,
                'belongs_to_id' => 9 //Home
            ],
            [
                'id' => 42,
                'name_short' =>   'Administration Division',
                'name' => 'Administration Division',                
                'type_id' => 5, //Section,
                'belongs_to_id' => 9 //Home
            ],
            [
                'id' => 43,
                'name_short' =>   'Welfare Division',
                'name' => 'Welfare Division',                
                'type_id' => 5, //Section,
                'belongs_to_id' => 9 //Home
            ],
            [
                'id' => 44,
                'name_short' =>   'Agriculture Section',
                'name' => 'Agriculture Section',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 41 //Agriculture & Co-op Division
            ],
            [
                'id' => 45,
                'name_short' =>   'Co-operative Section',
                'name' => 'Co-operative Section',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 41 //Agriculture & Co-op Division
            ],
            [
                'id' => 46,
                'name_short' =>   'General Administration & Settlement Office Coordinators',
                'name' => 'General Administration & Settlement Office Coordinators',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 42 //Administration Division
            ],
            [
                'id' => 47,
                'name_short' =>   'Account & Internal Audit',
                'name' => 'Account & Internal Audit',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 42 //Administration Division
            ],
            [
                'id' => 48,
                'name_short' =>   'Planning & Development',
                'name' => 'Planning & Development',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 42 //Administration Division
            ],
            [
                'id' => 49,
                'name_short' =>   'Housing & Estate',
                'name' => 'Housing & Estate',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 42 //Administration Division
            ],
            [
                'id' => 50,
                'name_short' =>   'Poverty Alleviation',
                'name' => 'Poverty Alleviation',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 43 //Welfare Division
            ],
            [
                'id' => 51,
                'name_short' =>   "Old People's Home",
                'name' => "Old People's Home",                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 43 //Welfare Division
            ],
            [
                'id' => 52,
                'name_short' =>   'Youth Empowerment Support',
                'name' => 'Youth Empowerment Support',                
                'type_id' => 6, // Sub Section,
                'belongs_to_id' => 43 //Welfare Division
            ]
        ]);
    }
}
