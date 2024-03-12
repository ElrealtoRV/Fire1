<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requester extends Model
{
    use HasFactory;
    protected $table = 'requesters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_number',
        'first_name',
        'middle_name',
        'last_name',
        'contact_number',
        //'sex_id',
        // 'position_id',
        // 'college_id',
        // 'course_id',
        'status_id',
        //'user_id', //for requester user account
    ];

    // public function sex()
    // {
    //     return $this->belongsTo(Sex::class, 'sex_id', 'id');
    // }

    // public function position()
    // {
    //     return $this->belongsTo(Position::class, 'position_id', 'id');
    // }

    // public function college()
    // {
    //     return $this->belongsTo(College::class, 'college_id', 'id');
    // }

    // public function course()
    // {
    //     return $this->belongsTo(Course::class, 'course_id', 'id');
    // }
      public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
