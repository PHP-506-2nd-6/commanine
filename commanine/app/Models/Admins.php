<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'admin_pw',
        'remember_token',
    ];
    protected $guarded=[
    ];
}
