<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'dataset';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user');
    // }
}
