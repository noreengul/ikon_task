<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    use HasFactory;

    public $table = 'user_invitations';

    public function user(){

        return $this->belongsToMany(User::class);
    }
}
