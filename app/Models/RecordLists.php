<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordLists extends Model
{
    use HasFactory;
    protected $table = 'record_lists';
    protected $fillable = [
        'type', 'firename', 'serial_number','location','maintenance_date','expiration_date', 'finding','status',
    ];

    public function fireex()
    {
        return $this->belongsTo(TypeList::class, 'type', 'id');
    }
    public function FireLocation()
    {
        return $this->belongsTo(LocationList::class, 'location', 'id');
        
    }
    public function Findings()
    {
        return $this->belongsTo(FindingList::class, 'finding', 'id');
        
    }
}
