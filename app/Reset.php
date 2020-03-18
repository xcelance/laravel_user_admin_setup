<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    
    protected $table = 'password_resets';
}
