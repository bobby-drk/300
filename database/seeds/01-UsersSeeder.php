<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");

        User::truncate();
        $fileName = '2016-02-24-users';
        $table_name = 'users';
        $fullFile = 'database/seeds/csv/'.$fileName.'.csv';
        $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE $table_name FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n'", addslashes($fullFile));

        DB::connection()->getPdo()->exec($query);

        // DB::connection('common')->statement("TRUNCATE user_has_roles");
        // $fileName = '2016-02-17-user-has-roles';
        // $fullFile = 'database/seeds/common/csv/'.$fileName.'.csv';
        // $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE common.user_has_roles FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n'", addslashes($fullFile));
        // DB::connection('common')->getpdo()->exec($query);

        DB::statement("SET FOREIGN_KEY_CHECKS = 1");
    }

}