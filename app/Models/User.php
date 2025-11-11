<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

      protected $fillable = ['nama', 'kontak', 'username', 'password', 'role'];

    public function tokos()
    {
        return $this->hasMany(Toko::class, 'user_id', 'id');
    }
}
