<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incidenciaActivityLog extends Model
{
    use HasFactory;

        //Usuario
        public function users(){
    
            return $this->belongsTo(User::class, 'client_id');
        }
        //Usuario
        public function productos(){
        
            return $this->belongsTo(Producto::class, 'producto_id');
        }
}
