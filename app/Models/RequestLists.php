<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLists extends Model
{
    protected $table = 'request_lists';
    use HasFactory;
    protected $fillable = [
        'type', 'firename', 'serial_number','location','request',
    ];

    public function fireex()
    {
        return $this->belongsTo(TypeList::class, 'type', 'id');
    }
    public function FireLocation()
    {
        return $this->belongsTo(LocationList::class, 'location', 'id');
        
    }
    public function AddRequest()
    {
        return $this->belongsTo(Request::class, 'request', 'id');
        
    }

}
