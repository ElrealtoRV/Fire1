<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class EmployeeList extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $guard_name = 'web';
    protected $table = 'employees';
    protected $fillable = [
       'first_name', 'middle_name', 'last_name','age','bdate','contnum', 'idnum','position_id','dept', 'email', 'password',
     ];

     public function position()
     {
         return $this->belongsTo(Position::class, 'position_id', 'id');
     }
     public function save(array $options = [])
     {
         // Hash the password using Bcrypt before saving
         $this->attributes['password'] = Hash::make($this->attributes['password']);
         parent::save($options);
     }

}
