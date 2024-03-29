<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliationLists extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'affiliation_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];

}
