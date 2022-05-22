<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productoActivityLog extends Model
{
    use HasFactory;

    public function departamentos(){
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
}
