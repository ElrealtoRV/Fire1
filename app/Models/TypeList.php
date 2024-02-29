<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeList extends Model
{
    use HasFactory;

    public $guarded = [];
    
    protected $table = 'type_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];
}
