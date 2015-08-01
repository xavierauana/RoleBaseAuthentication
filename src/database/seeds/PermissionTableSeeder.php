<?php

use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            'create',
            'edit',
            'delete',
            'show'
        ];

        $objects = [
          'page'
        ];

        foreach($objects as $object)
        {
            foreach($actions as $action){
                DB::table('permissions')->insert([
                    'object' => $object,
                    'action' => $action
                ]);
            }
        }

    }
}
