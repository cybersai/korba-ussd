<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Korba\Generator;

class ExampleTracker extends Model
{

    /**
     * Tracker constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = Generator::getModelDefaultParameters();
        parent::__construct($attributes);
    }
}
