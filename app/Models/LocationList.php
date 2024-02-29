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
}
