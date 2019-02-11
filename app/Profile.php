<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Un profile puede ser asignado (puede pertenecer a) a uno o más users
     *
     * @return void
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
