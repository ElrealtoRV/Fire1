<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class RegularList extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $table = 'regular_lists';
    protected $fillable = [
       'first_name', 'middle_name', 'last_name','age','bdate','contnum', 'idnum','affiliation','dept','office','email', 'password',
     ];


     public function Affiliation()
     {
         return $this->belongsTo(AffiliationLists::class, 'affiliation', 'id');
     }

     public function Office()
     {
         return $this->belongsTo(OfficeLists::class, 'office', 'id');
     }
     public function Department()
     {
         return $this->belongsTo(DepartmentLists::class, 'dept', 'id');
     }


     public function save(array $options = [])
     {
         // Hash the password using Bcrypt before saving
         $this->attributes['password'] = Hash::make($this->attributes['password']);
         parent::save($options);
     }
}

