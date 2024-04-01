<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationList extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'location_lists';
    protected $primaryKey = 'id';
    protected $fillable = ['building', 'floor', 'room'];

    public function fireLocation()
    {
        return $this->hasMany(FireList::class, 'building', 'floor', 'room', 'id');
    }

    public function requestLocation()
    {
        return $this->hasMany(RequestLists::class, 'location_id');
    }
}
