<?php

namespace App\Models\Traits;

trait Reloadable
{
    /**
     * reload()
     * Reload the model from the DB to 'refresh' attributes to avoid constantly writing duplicate queries.
     *
     * @return $this
     */
    public function reload()
    {
        $instance = new static();
        $instance = $instance->newQuery()->find($this->{$this->primaryKey});
        $this->attributes = $instance->attributes;
        $this->original = $instance->original;
        return $this;
    }
}
