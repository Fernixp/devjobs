<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{

    public $termino;
    public $categoria;
    public $salario;
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    public function buscar($termino, $categoria, $salario){
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
        
    }

    public function render()
    {
        /* Consultamos la BD para obtener las vacantes que tenemos actualmente */
        //$vacantes = Vacante::all();
        /* el when solo se ejecuta cuando las variables del constructor tienen algo, si estan vacios no se ejecutan */
        /* usamos el like para la busqueda */
        $vacantes = Vacante::when($this->termino,function($query){
            $query->where('titulo','LIKE', "%".$this->termino."%");
        })
        ->when ($this->termino,function($query){
            $query->orWhere('empresa','LIKE', "%".$this->termino."%");
        })
        /* Si hay categoria filtramos por categoria tambien */
        ->when($this->categoria,function($query){
            $query->where('categoria_id', $this->categoria);
        })

        ->when($this->salario,function($query){
            $query->where('salario_id', $this->salario);
        })
        
        ->get();

        return view('livewire.home-vacantes',[
            'vacantes' => $vacantes,
        ]);
    }
}
