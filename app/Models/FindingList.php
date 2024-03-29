<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindingList extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'finding_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];
}
