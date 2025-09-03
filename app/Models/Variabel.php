<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variabel extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'variabel';
    protected $primaryKey = 'id_variabel';

    public function isiVariabel()
    {
        return $this->hasMany(IsiVariabel::class, 'id_variabel', 'id_variabel');
    }
}
