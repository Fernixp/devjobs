<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;


     protected $rules=[
         'cv' => 'required|mimes:pdf'
     ];

     public function mount(Vacante $vacante){
        /* esto es como un constructor, debemos asignar la variable que entra a la variable local */
        $this->vacante=$vacante;
     }

    public function postularme()
    {
        $datos=$this->validate();
        //Almacenar el CV
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        //Crear Candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id, //llenando los datos...
            /* 'vacante_id' => $this->vacante->id, *///Aca no requerimos llenar el id por que ya la definimos en la relacion
            'cv' => $datos['cv'],
        ]);

        //Crear notificacion y enviar el email
        //pasando los datos al constructor
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        //Mostrar el usuario un mensaje de ok
        session()->flash('mensaje','Se envió correctamente tu información, mucha suerte');
        return redirect()->back(); //redireccionando a la pagina anterior
    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
