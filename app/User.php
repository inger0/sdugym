<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = "users";

    protected $primaryKey = "u_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_id','schoolnum', 'username', 'password','campus','realname','tel'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password','api_token','token_expire','zx','hj','xl','bt','qf','rj','news','finance','equipment'
    ];

  /*  public function getPower(){
        return $this->hasOne('Power','u_id','u_id');
    }*/
}
