<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireList extends Model
{
    protected $table = 'fire_lists';
    use HasFactory;
    protected $fillable = [
        'type', 'firename', 'serial_number','location','installation_date','expiration_date', 'description','status', 'status_id',
    ];

    public function fireex()
    {
        return $this->belongsTo(TypeList::class, 'type', 'id');
    }
    public function FireLocation()
    {
        return $this->belongsTo(LocationList::class, 'location', 'id');
        
    }

    public function status1()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
