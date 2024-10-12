<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [
                'id' => 1,
                'name_english' => 'Sikyong',
                'name_tibetan' => 'སྲིད་སྐྱོང་།'
            ],
            [
                'id' => 2,
                'name_english' => 'Kalon',
                'name_tibetan' => 'བཀའ་བློན།'
            ],
            [
                'id' => 3,
                'name_english' => 'Secretary',
                'name_tibetan' => 'དྲུང་ཡིག་ཆེན་མོ།'
            ],
            [
                'id' => 4,
                'name_english' => 'Additional Secretary',
                'name_tibetan' => 'དྲུང་ཆེ་ལས་འཕར།'
            ],
            [
                'id' => 5,
                'name_english' => 'Joint Secretary',
                'name_tibetan' => 'ཟུང་འབྲེལ་དྲུང་ཆེ།'
            ],
            [
                'id' => 6,
                'name_english' => 'Deputy Secretary',
                'name_tibetan' => 'དྲུང་ཆེ་གཞོན་པ།'
            ],
            [
                'id' => 7,
                'name_english' => 'Under Secretary',
                'name_tibetan' => 'དྲུང་གཞོན་ལས་རོགས།'
            ],
            [
                'id' => 8,
                'name_english' => 'Office Superintendent',
                'name_tibetan' => 'ལས་ཁུངས་དོ་དམ་པ།'
            ],
            [
                'id' => 9,
                'name_english' => 'Section Officer',
                'name_tibetan' => 'སྡེ་ཚན་འགན་འཛིན།'
            ],
            [
                'id' => 10,
                'name_english' => 'Office Assistant',
                'name_tibetan' => 'ལས་དྲུང་།'
            ],
            [
                'id' => 11,
                'name_english' => 'Senior Clerk',
                'name_tibetan' => 'རྒན་དྲུང་།'
            ],
            [
                'id' => 12,
                'name_english' => 'Junior Clerk',
                'name_tibetan' => 'གཞོན་དྲུང་།',
            ],
            [
                'id' => 13,
                'name_english' => 'Chief Justice Commissioner',
                'name_tibetan' => 'ཁྲིམས་ཞིབ་པ་ཆེ་བ།',
            ],
            [
                'id' => 14,
                'name_english' => 'Justice Commissioner',
                'name_tibetan' => 'ཁྲིམས་ཞིབ་པ།'
            ]
        ]);
    }
}
