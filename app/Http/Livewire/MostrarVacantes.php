<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    protected $listeners = ['eliminarVacante'];
    //gracias al route model biding, podemos recibir directamente el objeto vacante., y acceder a todos sus atributos
    public function eliminarVacante(Vacante $vacante){
        //eliminando la vacante
        $vacante->delete();
    }
    public function render()
    {
        //realizamos la consulta de las vacantes que el usuario tiene
        $vacantes = Vacante::where('user_id',auth()->user()->id)->paginate(10);
        return view('livewire.mostrar-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
