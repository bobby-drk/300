<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Reloadable;

class Seed extends Model
{
    /*
     * Pull in common useful traits for models.
     */
    use Reloadable;

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    // protected $connection = 'common';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seeds';

    protected $guarded = [];

    /**
     * boot.
     */
    public static function boot()
    {
        parent::boot();
    }

    public function getEnvironments()
    {
        $envs = [];
        if ($this->local) {
            array_push($envs, 'local');
        }
        if ($this->development) {
            array_push($envs, 'development');
        }
        if ($this->stage) {
            array_push($envs, 'stage');
        }
        if ($this->production) {
            array_push($envs, 'production');
        }

        return $envs;
    }
}
