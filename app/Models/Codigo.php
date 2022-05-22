<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Modelo
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Codigo extends Model
{
    public $timestamps = false;
      static $rules = [
          'nombre' => 'required',
          'codigo' => 'required'
      ];
  
      protected $perPage = 20;
  
      /**
       * Attributes that should be mass-assignable.
       *
       * @var array
       */
      protected $fillable = ['nombre', 'codigo', 'numero'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'codigos_id', 'id');
    }
}
  

