<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengelompokan extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'pengelompokan';
    protected $primaryKey = 'id_pengelompokan';
}
