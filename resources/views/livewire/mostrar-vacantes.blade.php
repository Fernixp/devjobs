<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        {{-- Forelse mescla de foreach con if(conut($vacantes)....  para hacerlo en una sola linea) --}}
        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b text-gray-900 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-800 font-bold">
                        {{ $vacante->empresa }}
                    </p>
                    {{-- el format le da formato a la fecha para mostrar dia/mes/año, pero el tipo de dato debe ser date, para eso lo asignamos en una variable en el modelo Vacante --}}
                    <p class="text-sm text-gray-700">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>

                <div class="flex flex-col md:flex-row  items-stretch gap-3  mt-5 md:md-0">
                    <a href="{{ route('candidatos.index', $vacante)}}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        {{ $vacante->candidatos->count() }}
                        Candidatos</a>
                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
                    <button wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                        class="bg-red-600 py-2 px-4 rounded-lg 
                        text-white text-xs font-bold uppercase text-center">Eliminar</button>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
        @endforelse
    </div>
    {{-- Paginacion... --}}
    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
                title: '¿Eliminar Vacante?',
                text: "Una vacante eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //si entra aca es por que presiono el boton de confirmacion
                    //Eliminar la vacante
                    Livewire.emit('eliminarVacante',vacanteId)
                    Swal.fire(
                        'Se eliminó la Vacante!',
                        'Eliminado correctamente.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
