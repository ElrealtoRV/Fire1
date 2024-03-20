<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idnum',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'bdate',
        'contnum',
        //'sex_id',
        'position_id',
        'dept',
        // 'college_id',
        // 'course_id',
        // 'status_id',
        'user_id', //for requester user account
        'email',
        'password'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}

