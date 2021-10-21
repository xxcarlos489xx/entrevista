<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuids;
class User extends Authenticatable
{
    use Notifiable,Uuids;

    protected $primaryKey = 'id';

    public $incrementing = false;
    
    protected $table = 'usuarios';
    // public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 
        'ape_paterno',
        'ape_materno',
        'nombres_completos',
        'role_id',
        'estado',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function rol(){
        return $this->hasOne(Roles::class,'role_id','id');
    }
}
