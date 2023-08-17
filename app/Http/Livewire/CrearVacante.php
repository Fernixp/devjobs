<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    /* Para subir archivos: */
    use WithFileUploads;
    /* Aca definimos las reglas(validaciones) para el campo, el campo debe tener el mismo nombre */
    protected $rules = [
        'titulo' => ['required','string'],
        'salario' => ['required'],
        'categoria' => ['required'],
        'empresa' => ['required'],
        'ultimo_dia' => ['required'],
        'descripcion' => ['required'],
        'imagen' => ['required','image','max:1024'],
    ];

    public function crearVacante(){
        /* El validate aplica las $rules (reglas de validacion),
        si pasa la validacion se asigna a datos, sino vuelve a la vista a mostrar los errores */
        $datos=$this->validate();

        //Almacenar la imagen, se van a almacenar en storage/public/vacantes
        $imagen = $this->imagen->store('public/vacantes'); //aca almacenamos toda la url en $imagen
        
        //aca obtenemos unicamente el nombre de la imagen mas su extension
        $datos['imagen']=str_replace('public/vacantes/','',$imagen);
        //dd($nombre_imagen);
        
        //Crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'], //aca ponemos solo salario por que asi se llaman en el formulario de la vista crear-vacante
            'categoria_id' => $datos['categoria'], //aca solo categoria por lo mismo de salario
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],//aca podriamos poner $nombre_imagen que es la imagen sin la ruta completa o directamente modificar la variable imagen de $datos en la linea 42
            //'publicado' => $datos[''], //aca ano almaenamos publicado ya que lo instanciamos en el modelo como valor por defecto 1
            'user_id' => auth()->user()->id, //almacenando el id del user autenticado
        ]);

        //Crear un mensaje, lo haremos mediante una session
        session()->flash('mensaje','La Vacante se publicó correctamente');


        //Redireccionar al usuario
        return redirect()->route('vacantes.index');

    }

    public function render()
    {

        //Consultar BD, traer todos los registros  all()
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.crear-vacante', [
            'salarios' => $salarios, //pasando el objeto salariosa a la vista
            'categorias' => $categorias
        ]);
    }
}
