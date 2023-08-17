<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    public function render()
    {
        //realizamos la consulta de las vacantes que el usuario tiene
        $vacantes = Vacante::where('user_id',auth()->user()->id)->paginate(10);
        return view('livewire.mostrar-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
