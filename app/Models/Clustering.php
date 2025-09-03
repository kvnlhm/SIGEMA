<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'clustering';
    protected $primaryKey = 'id_clustering';

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user');
    // }
}
