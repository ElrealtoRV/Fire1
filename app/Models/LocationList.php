<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationList extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'location_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];

    public function Location()
    {
        return $this->hasMany(FireList::class, 'location', 'id');
    }
    public function RequestLocation()
    {
        return $this->hasMany(RequestLists::class, 'location', 'id');
    }
}
