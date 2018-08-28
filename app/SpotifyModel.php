<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotifyModel extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spotify';
    protected $fillable = [
       'user_id', 
       'token', 
       'refresh_token',
    ];

}
