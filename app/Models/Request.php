<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    public $guarded = [];
    
    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $fillable = [ 'description' ];

    public function Request()
    {
        return $this->belongsTo(RequestLists::class, 'request', 'id');
    }
}
