<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        //Tibetan Settlement Offices
        $tso =  DB::table('contacts')->insertGetId([
            'name'=>'Tibetan Settlement Offices (TSO)',
        ]);
        DB::table('contacts')->insert([
            [
                'name'=> 'Chief Rep Office/South',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Mundgod',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/ Lugsum Bylakupee',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/Ladakh',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Kollegal',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Delar Bylakupee',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Hunsur',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Orissa',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/Miao',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Bomdilla',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Mainpat',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Bhutan',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Bir Dege',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O./Shimla',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Tezu',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Bhandara',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Pokra Tashi Palkyi',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Ravanglah',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/Puruwala',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'Rep Office/Jawalakhel',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Shawa Ra Sum- Nepal',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Pokra Tashiling-Nubri',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Chauntra',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/BTS Bir',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Dalhousie',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Herbertpur',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Poanta Sahib',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Dolanji - Solan',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/Kumroa',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Pondo/Mandi',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Sonada',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Lotserog-Nepal',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Dharamsala',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O. Dehradun',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Boudha and Jorpati-Nepal',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Gangtok',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Darjeeling',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Kullu',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/Swambu-Nepal',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Kalingpong',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Delhi',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O. Shillong',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Satuan',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O/Lodrik',
                'parent_id' => $tso,
            ],
            [
                'name'=> 'T.S.O/Tuting',
                'parent_id' => $tso,
            ],
             [
                'name'=> 'T.S.O. Kathmandu',
                'parent_id' => $tso,
            ],

        ]);

        
        //Offices of Tibet
        $OOT =  DB::table('contacts')->insertGetId([
            'name'=>'Offices Of Tibet',
            'address'=>'',
            'phone' => '',
            'email' => '',
        ]);
        //OOTs Sub Contacts
        DB::table('contacts')->insert([
            [
                'name'=>'New Delhi',
                'address'=>'Bureau Office Of His Holiness the Dalai Lama,10-B Ring Road Lajpat Nagar ,New Delhi-110024, India',
                'phone' => '011-26474798',
                'email' => 'representative@tibetbureau.in ',
                'parent_id' => $OOT,
            ],
            [
                'name'=>'OOT,DC',
                'address'=>'Office of Tibet, 1228 17th Street NW, Washington DC-20036',
                'phone' => '001-212 213 5010 ',
                'email' => 'rep.us@tibet.net ',
                'parent_id' =>$OOT ,
            ],
            [
                'name'=>'OOT,Geneva',
                'address'=>'The Tibet Bureau, Place De Navigation 10, 1201 Geneva, SWITZERLAND',
                'phone' => '0041-22 738 7940 ',
                'email' => 'rep.ch@tibet.net',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Tokyo',
                'address'=>'Liaison Office of His Holiness the Dalai Lama, Tibet House Japan, Nishi Ochia 3-26-1 Shinjuku-ku, Tokyo 1610031 JAPAN',
                'phone' => '0081-359883576 ',
                'email' => 'rep.jp@tibet.net',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,London',
                'address'=>'The Representative, The Office of Tibet, 1 Culworth Street, London NW8 7AF, UK',
                'phone' => '0044-20-7722-5378',
                'email' => 'rep.uk@tibet.net',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Canberra',
                'address'=>'Tibet Information Office, 8\13 Napier Close, Deakin  Act 2600, AUSTRALIA',
                'phone' => '+61 426 642 175',
                'email' => 'rep.au@tibet.net ',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Taipei',
                'address'=>'Religious Foundation of His Holiness the Dalai Lama and Central Tibetan Administration, 10th Fl-4&5,No 189, Sector-2, Keelung Rd. Taipei, TAIWAN',
                'phone' => '00886-2-2736-0366',
                'email' => 'rep.tw@tibet.net',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Brussels',
                'address'=>'Bureau Du Tibet, 24 Avenue Des Arts, 1000 Brussels, BELGIUM',
                'phone' => '0032-475460994 ',
                'email' => 'rep.be@tibet.net ',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Moscow',
                'address'=>'Tibet Culture & Information Center, PO Box # 3 Moscow, Russian Federation 127015',
                'phone' => '007-4957864362',
                'email' => 'rep.ru@tibet.net ',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Paris',
                'address'=>'General Secretary, Bureau Du Tibet, 84 Boulevard Adolphe,Pinard 75014, PARIS',
                'phone' => '0033-146 5654 53',
                'email' => 'francebureau@tibet.net ',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,South America',
                'address'=>'Tibet House Brazil, Alameda Lorena 349,Jardim Paulista, Sao Paulo SP,01424-001 BRAZIL, South America',
                'phone' => '+55(11)989635128',
                'email' => 'latin@tibet.net',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,South Africa',
                'address'=>'Representative-Office of Tibet, 38 Union Avenue, LYTTELTON, Post Box-16812, PRETORIA-0140, Republic of South Africa',
                'phone' => '',
                'email' => 'rep.sa@tibet.net',
                'parent_id' =>$OOT,
            ],
            [
                'name'=>'OOT,Nepal',
                'address'=>'Tibetan Refugee Welfare Office, Gaden Khangsar, PO Box No 310, Lazimpat Kathmandu, NEPAL',
                'phone' => '00977-1-4419903',
                'email' => 'rep.np@tibet.net ',
                'parent_id' =>$OOT,
            ],
        ]);

           //TCV
        $tcv =  DB::table('contacts')->insertGetId([
            'name'=>'Tibetan Children Village (TCV)',
            'address'=>'',
            'phone' => '',
            'email' => '',
        ]);
        DB::table('contacts')->insert([
            [
                'name'=>'TCV Head Office',
                'address'=>'',
                'phone' => '',
                'email' => 'headoffice@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV President',
                'address'=>'',
                'phone' => '',
                'email' => 'president@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Education Director',
                'address'=>'',
                'phone' => '',
                'email' => 'ed@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV General Secretary',
                'address'=>'',
                'phone' => '',
                'email' => 'gsadmin@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Accounts Officer',
                'address'=>'',
                'phone' => '',
                'email' => 'accountsofficer@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Bylakuppe',
                'address'=>'',
                'phone' => '',
                'email' => 'bylakuppe@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Chauntra',
                'address'=>'',
                'phone' => '',
                'email' => 'tcvchauntra@gmail.com',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Gopalpur',
                'address'=>'',
                'phone' => '',
                'email' => 'gopalpur@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Ladakh',
                'address'=>'',
                'phone' => '',
                'email' => 'ladakh@tcv.org.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Lower Dharamsala',
                'address'=>'',
                'phone' => '',
                'email' => 'lowertcv1984@gmail.com',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Suja',
                'address'=>'',
                'phone' => '',
                'email' => 'tcvsuja_bir@yahoo.co.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Upper Dharamsala',
                'address'=>'',
                'phone' => '',
                'email' => 'principal_utcv@yahoo.co.in',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Selakui',
                'address'=>'',
                'phone' => '',
                'email' => 'duketsering443@gmail.com',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV McLeod',
                'address'=>'',
                'phone' => '',
                'email' => 'tcvmcleodschool@gmail.com',
                'parent_id' =>$tcv,
            ],
            [
                'name'=>'TCV Delhi',
                'address'=>'',
                'phone' => '',
                'email' => 'delhidayschool@gmail.com',
                'parent_id' =>$tcv,
            ],
        ]);

        //STS
        $sts =  DB::table('contacts')->insertGetId([
            'name'=>'Sambhota Tibetan Schools (STS)',
            'address'=>'',
            'phone' => '',
            'email' => '',
        ]);
        DB::table('contacts')->insert([
            [
                'name'=>'STS Head Office',
                'address'=>'',
                'phone' => '',
                'email' => 'stssheadoffice@sambhota.org ',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Account Officer',
                'address'=>'',
                'phone' => '',
                'email' => 'stss.tsipa@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Mundgod Camp 3',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmundgodcamp3@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Paonta',
                'address'=>'',
                'phone' => '',
                'email' => 'stspschool2017@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Petoen School',
                'address'=>'',
                'phone' => '',
                'email' => 'stspetoen@sambhota.org',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Shillong',
                'address'=>'',
                'phone' => '',
                'email' => 'sts_shillong@rediffmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Puruwala',
                'address'=>'',
                'phone' => '',
                'email' => 'stspuruwala18@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Ravangla',
                'address'=>'',
                'phone' => '',
                'email' => 'stsravangla@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Mundgod Camp 6',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmundgod@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Arlikumari',
                'address'=>'',
                'phone' => '',
                'email' => 'stsarlikumari@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Bir',
                'address'=>'',
                'phone' => '',
                'email' => 'sambhotabirschool@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Bylakuppe',
                'address'=>'',
                'phone' => '',
                'email' => 'stsbylakuppe@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Chandragiri',
                'address'=>'',
                'phone' => '',
                'email' => 'stsschandragiri2018@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Chauntra',
                'address'=>'',
                'phone' => '',
                'email' => 'chauntrasts@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS CVP Bylakuppe',
                'address'=>'',
                'phone' => '',
                'email' => 'stscvpb@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Dholanji',
                'address'=>'',
                'phone' => '',
                'email' => 'stsdholanji2018@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Gangkyi Petoen',
                'address'=>'',
                'phone' => '',
                'email' => 'gangkyipetoen@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Gothangaon',
                'address'=>'',
                'phone' => '',
                'email' => 'stsnorgyeling@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Gulledhalla',
                'address'=>'',
                'phone' => '',
                'email' => 'stsgulledhalla17@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Gurupura',
                'address'=>'',
                'phone' => '',
                'email' => 'stsgurupura@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Kailashpura',
                'address'=>'',
                'phone' => '',
                'email' => 'stskailashpura@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Kollegal',
                'address'=>'',
                'phone' => '',
                'email' => 'stskollegal@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Lobersing',
                'address'=>'',
                'phone' => '',
                'email' => 'stslobersing@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Mainpat',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmainpat2016@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Manali',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmanali@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Miao',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmiao@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Mundgod Branch 1',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmbranch1@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Sonada',
                'address'=>'',
                'phone' => '',
                'email' => 'stssonada@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Tenzingang',
                'address'=>'',
                'phone' => '',
                'email' => 'ststenzingang@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Tezu',
                'address'=>'',
                'phone' => '',
                'email' => 'ststezu@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Darjeeling',
                'address'=>'',
                'phone' => '',
                'email' => 'stsdarjeeling@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Herbertpur',
                'address'=>'',
                'phone' => '',
                'email' => 'stsherbertpurschool@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Kalimpong',
                'address'=>'',
                'phone' => '',
                'email' => 'stskalimpong@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Mussoorie',
                'address'=>'',
                'phone' => '',
                'email' => 'stsmussoorie@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'STS Shimla',
                'address'=>'',
                'phone' => '',
                'email' => 'stsshimla@gmail.com',
                'parent_id' =>$sts,
            ],
            [
                'name'=>'Sherab Gatsel Lobling',
                'address'=>'',
                'phone' => '',
                'email' => 'shergaling@gmail.com ',
                'parent_id' =>$sts,
            ],
        ]);

        //Tibetan Homes  Foundation School
        $ths = DB::table('contacts')->insertGetId([
            'name'=>'Tibetan Homes Foundation (THS)',
            'address'=>'',
            'phone' => '',
            'email' => '',
        ]);
        DB::table('contacts')->insert([
            [
                'name'=>'THF Head Office',
                'address'=>'',
                'phone' => '',
                'email' => 'registration@tibhomes.org',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THF General Secretary',
                'address'=>'',
                'phone' => '',
                'email' => 'generalsecretary@tibhomes.org',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THF Assistant General Scretary',
                'address'=>'',
                'phone' => '',
                'email' => 'ags@tibhomes.org',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THF Education Officer',
                'address'=>'',
                'phone' => '',
                'email' => 'thf.educationofficer@gmail.com',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THS Dekyiling',
                'address'=>'',
                'phone' => '',
                'email' => 'ths.dekyiling@tibhomes.org',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THS GohriMafi',
                'address'=>'',
                'phone' => '',
                'email' => 'hgths.rishikesh@tibhomes.org',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THS Mussoorie',
                'address'=>'',
                'phone' => '',
                'email' => 'tibetanhomeschool@gmail.com',
                'parent_id' =>$ths,
            ],
            [
                'name'=>'THS Rajpur',
                'address'=>'',
                'phone' => '',
                'email' => 'principal.rajpur@tibhomes.org',
                'parent_id' =>$ths,
            ],
        ]);

        //Snow Lion Foundation
        $nepal = DB::table('contacts')->insertGetId([
            'name'=>'Snow Lion Foundation, Nepal',
            'address'=>'',
            'phone' => '',
            'email' => 'snowlionfoundation@gmail.com',
        ]);
        DB::table('contacts')->insert([
            [
                'name' => 'SFL Nepal Office',
                'address' => '',
                'phone' => '',
                'email' => 'slfnepal@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'SFL Education Officer',
                'address' => '',
                'phone' => '',
                'email' => 'slfeducationdept@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Namgyal High School Gokarna',
                'address' => '',
                'phone' => '',
                'email' => 'nhssgokarna@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Namgyal Middle Boarding School',
                'address' => '',
                'phone' => '',
                'email' => 'namgyalmiddleschool@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Srongtsen Bhrikuti Boarding School',
                'address' => '',
                'phone' => '',
                'email' => 'admin@srongtsenschool.edu.np',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Lekshed Tsal School',
                'address' => '',
                'phone' => '',
                'email' => 'ltsalschool@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Mt. Kailash Middle School',
                'address' => '',
                'phone' => '',
                'email' => 'gangchentisi@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Lopheling Boarding School Manang',
                'address' => '',
                'phone' => '',
                'email' => 'gonpowangchuk396@gmail.com',
                'parent_id' => $nepal,
            ],
             [
                'name' => 'Shree Saraswati School, Tserok',
                'address' => '',
                'phone' => '',
                'email' => 'dakpalhaktsang@gmail.com',
                'parent_id' => $nepal,
            ],
            [
                'name' => 'Atisha Primary School',
                'address' => '',
                'phone' => '',
                'email' => 'atishaprimaryschool@gmail.com',
                'parent_id' => $nepal,
            ],
             [
                'name' => 'Manjushri Primary School',
                'address' => '',
                'phone' => '',
                'email' => 'manjushrischool@hotmail.com',
                'parent_id' => $nepal,
            ],
        ]);

        //Private Schools
        $other = DB::table('contacts')->insertGetId([
            'name' => 'Private School',
        ]);
        DB::table('contacts')->insert([
            [
                'name'=> 'SOS Hermann Gmeiner School Pokhara',
                'email'=> 'sos.pokhara@sosnepal.org.np',
                'parent_id' => $other,
            ],
            [
                'name'=> 'TNMF Clementown',
                'email'=> 'dhonduplingschool@gmail.com',
                'parent_id' => $other,
            ],
            [
                'name'=> 'Ling Gesar School Manduwala',
                'email'=> 'dogyal77@yahoo.comkunzangbarling@yahoo.com',
                'parent_id' => $other,
            ],
            [
                'name'=> 'Tibetan Public School, Srinagar',
                'email'=> 'tps.srinagar@gmail.com',
                'parent_id' => $other,
            ],
        ]);

        //Monastic Schools 
        $monastic = DB::table('contacts')->insertGetId([
            'name' => 'Monastic Schools',
        ]);
        //Monastery Schools
        DB::table('contacts')->insert([
            [
                'name'=> 'Sermey Thoesam School',
                'email'=> 'serameylopchi@gmail.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Sera Je Secondary School',
                'email'=> 'seraje_school@yahoo.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Drepung Loseling School',
                'email'=> 'drelolingschool1982@gmail.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Drepung Gomang School',
                'email'=> 'bagelek1493@gmail.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Gaden Shartse School',
                'email'=> 'gasharschool@gmail.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Gaden Jangtse School',
                'email'=> 'Jangtseschool@rediffmail.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Gyudmed Tantric Monastic School',
                'email'=> 'gtmstt@yahoo.co.in',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Tashi Lhunpo Monastery',
                'email'=> 'ctlschool123@yahoo.co.in',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Drikung Kadgyue Monastery',
                'email'=> 'drikungcharitablesociety@yahoo.com',
                'parent_id' => $monastic,
            ],
            [
                'name'=> 'Namdroling Monastery School',
                'email'=> 'namdrolingoffice@gmail.com',
                'parent_id' => $monastic,
            ],
        ]);

        //Contacts given by TSJC (id = 2)
        $tcjcParent =  DB::table('contacts')->insertGetId([
            'name'=>'Tibetan Circuit Justice Commission',
            'address'=>'Dekyiling Tibetan Colony, Sahastradhara Road, P.O. Kulhan - 248001,Distt. Dehradun, Uttarakhand',
            'phone' => '0135-3571409',
            'email' => 'tcjc@tibet.net',
        ]);
        //Tibetan Circuit Justice Commission Sub Contacts
        DB::table('contacts')->insert([
            [
                'name'=>'Tibetan Local Justice Commission(Northern Region)',
                'address'=>'Dekyiling Tibetan Colony, Sahastradhara Road, P.O. Kulhan - 248001,Distt. Dehradun, Uttarakhand',
                'phone' => '0135-3571484',
                'email' => 'tljcnorth@tibet.net',
                'parent_id' => $tcjcParent,
            ],
            [
                'name'=>'Tibetan Local Justice Commission(Southern Region)',
                'address'=>'KAILASHPURA, P.O.BYLAKUPPE - 571104, DISTT. MYSORE, KARNATAKA STATE, INDIA',
                'phone' => '08223-253632',
                'email' => 'tljcsouth@tibet.net',
                'parent_id' => $tcjcParent,
            ],
            [
                'name'=>'Tibetan Local Justice Commission(Ladakh)',
                'address'=>'SONAMLING TIBETAN SETTLEMENT,P/O CHOGLAMSAR, LEH- LADAKH, UNION TERRITORY,PIN NO - 194104',
                'phone' => '01982- 264253',
                'email' => 'tljcladakh@tibet.net',
                'parent_id' => $tcjcParent,
            ],
        ]);

        DB::table('contacts')->insert([
            'name'=>'Sherig Parkhang,Delhi',
            'address'=>'',
            'phone' => '',
            'email' => 'sheparpublication@gmail.com',
        ]);

        DB::table('contacts')->insert([
            'name'=>'Education Officer (SLF)',
            'address'=>'',
            'phone' => '',
            'email' => 'slfeducationdept@gmail.com',
        ]);

        DB::table('contacts')->insert([
            'name'=>'Norlinga higher Tibetan Studies',
            'address'=>'',
            'phone' => '',
            'email' => 'principal.norlinginstitute.edu@gmail.com',
        ]);

        DB::table('contacts')->insert([
            'name'=>'College for Higher Tibetan Studies',
            'address'=>'',
            'phone' => '',
            'email' => 'chts.sarah@gmail.com',
        ]);

        DB::table('contacts')->insert([
            'name'=>'Sarah publication',
            'address'=>'',
            'phone' => '',
            'email' => 'spp2113@gmail.com',
        ]);

        DB::table('contacts')->insert([
            'name'=>'Dolmaling Nunnery',
            'address'=>'',
            'phone' => '',
            'email' => 'dolmaling@dolmalinginstitute.org',
        ]);
    }
}
