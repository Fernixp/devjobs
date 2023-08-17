<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    //definimos la validacion
    protected $rules = [
        'titulo' => ['required', 'string'],
        'salario' => ['required'],
        'categoria' => ['required'],
        'empresa' => ['required'],
        'ultimo_dia' => ['required'],
        'descripcion' => ['required'],
        'imagen_nueva' => ['nullable','image', 'max:1024'],
        /* el cambio de imagen no será obligatorio, por que el input no va tener nada en caso de que
        no se cambie la imagen */

    ];

    public function mount(Vacante $vacante)
    {

        $this->vacante_id = $vacante->id; //cambiamos la varible a vacante_id por que id es reservada de livewire
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante()
    {

        $datos = $this->validate(); //llamamos la funcion de validacion

        //Revisamos si hay una nueva imagen
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/vacantes');    
            $datos['imagen']=str_replace('public/vacantes/','',$imagen);
        }

        // Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);
        //Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;
        //Guardar la vacante
        $vacante->save();
        //redireccionar
        //Crear un mensaje, lo haremos mediante una session
        session()->flash('mensaje', 'La Vacante se actualizó correctamente');
        //Redireccionar al usuario
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        //Consultar BD, traer todos los registros  all()
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.editar-vacante', [
            'salarios' => $salarios, //pasando el objeto salariosa a la vista
            'categorias' => $categorias
        ]);
    }
}
