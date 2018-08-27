<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitchModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'twitch';
    protected $fillable = [
       'user_id', 
       'identifiant',
       'player_username', 
    ];

}
