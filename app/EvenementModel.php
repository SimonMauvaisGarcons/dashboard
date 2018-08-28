<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvenementModel extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'evenements';

    protected $fillable = [
       'user_id', 
       'titre',
       'description',
       'date',
       'type',
    ];
}
