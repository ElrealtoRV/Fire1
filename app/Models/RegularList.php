<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class RegularList extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $guard_name = 'web';
    protected $table = 'regular_lists';
    protected $fillable = [
       'first_name', 'middle_name', 'last_name','age','bdate','contnum', 'idnum','status','dept', 'email', 'password',
     ];


     public function Status()
     {
         return $this->belongsTo(StatusLists::class, 'status', 'id');
     }


     public function save(array $options = [])
     {
         // Hash the password using Bcrypt before saving
         $this->attributes['password'] = Hash::make($this->attributes['password']);
         parent::save($options);
     }
}

