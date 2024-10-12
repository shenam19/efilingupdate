<?php

namespace Tests\Unit;

use App\Models\Position;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\PositionSeeder;
use Database\Seeders\UserSeeder;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function setUp():void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_to_check_whether_the_particular_user_is_receptionist_or_not() {
        $user = User::where('name', 'Front Desk of Kashag')->first();
        $this->assertTrue($user->hasRole('front desk'));
    }

    public function test_position_matches() {
        $user = new User();
        $position = Position::where('name_tibetan', 'རྒན་དྲུང་།')->first();
        $user->name = 'Front Desk Data Section';
        $user->email = 'front_Desk_data@tibet.net';
        $user->password = Hash::make('password');
        $user->works_at = 14;
        $user->position_id = $position->id;
        $user->save();

        $this->assertEquals($position->id, $user->position_id);

    }
}
