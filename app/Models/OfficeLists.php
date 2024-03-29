<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeLists extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'office_lists';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];

    public function Office()
    {
        return $this->hasMany(User::class, 'office', 'id');
    }
}