<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    /* aca casteamos a tipo date el campo ultimo_dia */
    protected $casts = ['ultimo_dia' => 'date'];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'publicado',
        'user_id'
    ];

    //si dice categoria espera categoria_id
    public function categoria()
    {
        //pertenece a
        return $this->belongsTo(Categoria::class);
    }

    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }

    public function candidatos()
    {
        /* Una vacante tiene muchos candidatos 1 a n has Many */
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC');
    }

    /* nueva relacion donde una vacante pertenece a un reclutador, 
    como en este caso no ponemos user, debemos especificar a que campo hace referencia 'user_id' */
    public function reclutador()
    {
        /* Si la funcion fuese user, no seria necesario especificar el fk ,'user_id' */
        return $this->belongsTo(User::class, 'user_id');
    }
}
