<?php
    namespace Xavierau\RoleBaseAuthentication\database\seeds;

use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'developer',
            'administrator',
            'user'
        ];
        DB::table('roles')->truncate();
        foreach($roles as $role){
            DB::table('roles')->insert([
                'code' => strtolower($role),
                'display' => ucwords($role)
            ]);
        }
    }
}
