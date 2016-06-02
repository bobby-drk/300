<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ledger;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class Fabricate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabricate:ledger {count?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fabricated ledger data in the database';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $faker = Faker::create();
        $count = ($this->argument('count') ? $this->argument('count') : 1);


        $users_as_obj = DB::table('users')->select('id')->get();

        foreach($users_as_obj as $obj) {
            $all_users[] = $obj->id;
        }

        for($i = 0; $i < $count; $i++) {

            $users = $all_users;

            $creditor = $faker->randomElement($users);

            if(($key = array_search($creditor, $users)) !== false) {
                unset($users[$key]);
            }

            $debtor = $faker->randomElement($users);

            $ledger = new Ledger();
            $ledger->creditor = $creditor;
            $ledger->debtor = $debtor;
            $ledger->credit_type = $faker->randomElement(['food', 'bowling']);
            $ledger->amount = $faker->randomFloat(2, 1, 8);

            $ledger->save();



        }

    }
}
