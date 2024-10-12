<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MessageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_type')->insert([
            [                                                
                'name_tibetan' => 'སྤྱིར་བཏང་།',
            ],
            [                                                
                'name_tibetan' => 'བཀའ་འཁྲོལ།',
            ],
            [                                                
                'name_tibetan' => 'བཀོད་ཁྱབ།',
            ],
            [                                                
                'name_tibetan' => 'གསལ་བསྒྲགས།',
            ],
            [                                                
                'name_tibetan' => 'རྩ་འཛིན།',
            ],
            [                                                
                'name_tibetan' => 'སྙན་ཞུ།',
            ],
        ]);

    }
}
