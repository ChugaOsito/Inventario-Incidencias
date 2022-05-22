<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Codigo;
use Illuminate\Support\Facades\DB;

class Producto extends Authenticatable
{
    use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
    'fecha_ingreso',
    'fecha_actualizacion',
    'serie',
    'serieGAD',
    'descripcion',
    'user_id',
    'estado_id',
    'detalle_id',
    'marca_id',
    'modelo_id',
    'incidencia_id',
    'departamento_id',
    'imagen',
    'fecha_compra',
    'caracteristicas'
];

    //Usuario
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Estado
    public function estados()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
    //Marca
    public function marcas()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    //Modelo
    public function modelos()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    public function detalles()
    {
        return $this->belongsTo(Detalle::class, 'detalle_id');
    }
    //incidents
    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
    //incidents
    public function codigos()
    {
        return $this->belongsTo(Codigo::class, 'codigos_id');
    }
    public function getNameCodigoAttribute($value)
    {
            $cantidaCodigo = DB::table('productos')->where('codigos_id', $this->codigos_id)->where('id', '<=', $this->id)->count();
            return $cantidaCodigo ; 
    }

}