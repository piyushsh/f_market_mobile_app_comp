<?php

use Illuminate\Database\Seeder;

class idea_status_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('idea_status_codes')->insert(['status_id'=>1, 'status'=>'Reviewing']);
        DB::table('idea_status_codes')->insert(['status_id'=>2, 'status'=>'Approved']);
        DB::table('idea_status_codes')->insert(['status_id'=>3, 'status'=>'Disapproved']);
    }
}
