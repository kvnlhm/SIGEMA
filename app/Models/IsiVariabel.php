<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiVariabel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'isi_variabel';
    protected $primaryKey = 'id_varket';
}
