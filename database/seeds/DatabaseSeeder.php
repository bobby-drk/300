<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seed;

class DatabaseSeeder extends Seeder
{

    // Exclude these seeds from auto-execution:
    private $exclude = [
        // 'EzAutoSeeder',
        // 'EzHomeSeeder'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $path = realpath('database/seeds');
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::LEAVES_ONLY);
        $seedFiles = iterator_to_array(new RegexIterator($objects, '/^.+\.php$/i',
            RecursiveRegexIterator::GET_MATCH)); // match .php files
        asort($seedFiles);

        foreach($seedFiles as $name => $object) {
            $fullPath = explode('/', $name) ?: [];
            $class = substr(substr(array_pop($fullPath), 0, -4), 3); // -4 removes .php, 3 removes integer + hyphen

            //baseSeeder is the name of this file after it's gone through the substr above
            if(in_array($class, array_merge($this->exclude, ['abaseSeeder']))) continue; // these seeders don't run

            $lastModified = date("Y-m-d H:i:s", filemtime($name) ?: '2016-01-01 01:01:01');
            $seed = Seed::firstOrCreate(['seed' => $class])->reload();
            if (app()->environment($seed->getEnvironments())) {
                if(app()->environment() != 'production') {
                    if($seed->file_modified != $lastModified) {

                        $this->call($class);
                        $seed->file_modified = $lastModified;
                        $seed->last_run = date("Y-m-d H:i:s");
                        $seed->save();
                        echo "Seeded $class, last modified: $lastModified\n";
                    } else {
                        echo "No changes to $class\n";
                    }
                }
            } else {
                echo "$class can't seed environment: ".env('APP_ENV')."\n";
            }
        }

        Model::reguard();
    }

}
