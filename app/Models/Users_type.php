<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_type extends Model
{
    protected $guarded = [];
    protected $table = 'users_type';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
