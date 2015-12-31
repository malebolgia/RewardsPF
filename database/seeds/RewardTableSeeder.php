<?php

namespace Petfinder\Reward;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RewardTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('rewards')->insert(array(
            
        ));

        DB::table('permissions')->insert(array(
            array(
                'name' => 'reward.reward.view',
                'readable_name' => 'View Reward'
            ),
            array(
                'name' => 'reward.reward.create',
                'readable_name' => 'Create Reward'
            ),
            array(
                'name' => 'reward.reward.edit',
                'readable_name' => 'Update Reward'
            ),
            array(
                'name' => 'reward.reward.delete',
                'readable_name' => 'Delete Reward'
            )
        ));

        DB::table('settings')->insert(array(
            // Uncomment  and edit this section for entering value to settings table.
            /*
            array(
                'key'      => 'reward.reward.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ),
            */
        ));
    }
}
