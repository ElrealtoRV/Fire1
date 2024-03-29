<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentLists extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'department_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];

    public function Department()
    {
        return $this->hasMany(RegularList::class, 'dept', 'id');
    }
}
