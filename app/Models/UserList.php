<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserList extends Authenticatable
{
    use HasFactory;

    protected $table = 'User_lists';
    protected $fillable = [
        'first_name', 'middle_name', 'last_name','Age','Contnum','Idnum','Dept', 'position_id', 'email', 'password',
     ];

     public function save(array $options = [])
     {
         // Hash the password using Bcrypt before saving
         $this->attributes['Password'] = Hash::make($this->attributes['Password']);
         parent::save($options);
     }
}
