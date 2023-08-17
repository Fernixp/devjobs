{{-- Con el wire:submit.prevent='crearVacante' mandamos el formulario a la funcion en CrearVacante.php   --}}
<form action="#" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante' >
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />

        <x-text-input 
        id="titulo" 
        class="block mt-1 w-full" 
        type="text" 
        wire:model="titulo"  {{-- wire:model en lugar de name, para comunicarse con livewire --}}
        :value="old('titulo')"
            placeholder="Titulo Vacante" />
        {{-- Para mostrar los errores: --}}
        @error('titulo')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select id="salario" wire:model="salario"
            class="rounded-md shadow-sm border-gray-300
             focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
            <option value=""> -- Seleccione --</option>
            @foreach ($salarios as $salario)
                {{-- Aca iteramos la tabla salarios para mostrarlo en las opciones --}}
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>

        {{-- Para mostrar los errores: --}}
        @error('salario')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select id="categoria" wire:model="categoria"
            class="rounded-md shadow-sm border-gray-300
             focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
            <option value=""> -- Seleccione --</option>
            @foreach ($categorias as $categoria)
                {{-- Aca iteramos la tabla salarios para mostrarlo en las opciones --}}
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>

        {{-- Para mostrar los errores: --}}
        @error('categoria')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />

        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')"
            placeholder="Empresa: ej. Netflix, Uber, Shopify" />

        {{-- Para mostrar los errores: --}}
        @error('empresa')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Último Día para postularse')" />

        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" 
        wire:model="ultimo_dia" :value="old('ultimo_dia')" />

        {{-- Para mostrar los errores: --}}
        @error('ultimo_dia')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripción Puesto')" />
        <textarea wire:model="descripcion" id="descripcion" 
        placeholder="Descripción general del puesto, experiencia"
            class="rounded-md shadow-sm border-gray-300
        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full h-72"></textarea>

        {{-- Para mostrar los errores: --}}
        @error('descripcion')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />

        <x-text-input id="imagen" class="block mt-1 w-full" type="file" 
        wire:model="imagen" 
        accept="image/*" />

        {{-- mostrar preview de la imagen, w-99 para asignar tamaño --}}
        <div class="my-5 w-80">
            @if ($imagen)
                Imagen:
                {{-- Llamando una funcion de la imagen para mostrar una url temporal --}}
                <img src="{{$imagen->temporaryUrl()}}">
            @endif
        </div>
        {{-- Para mostrar los errores: --}}
        @error('imagen')
        {{-- Mandamos los errores en $message a mostrar-alerta para que tenga estilos --}}
            <livewire:mostrar-alerta :message="$message"/>
        @enderror
    </div>

    <x-primary-button>
        Crear Vacante
    </x-primary-button>
</form>
