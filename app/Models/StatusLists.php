<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLists extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'status_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];
}
