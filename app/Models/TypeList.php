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

    public function Type()
    {
        return $this->hasMany(FireList::class, 'type', 'id');
    }
    public function RequestType()
    {
        return $this->hasMany(Request::class, 'type', 'id');
    }
}
