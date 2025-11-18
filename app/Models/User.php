<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

      protected $fillable = ['nama', 'kontak', 'username', 'password', 'role','status'];

public function toko()
{
    return $this->hasOne(Toko::class, 'user_id', 'id');
}


}
