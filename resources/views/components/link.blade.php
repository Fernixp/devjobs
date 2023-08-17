@php
    $classes=" text-sm text-gray-500 hover:text-gray-900"
@endphp

<!--merge, une todos los atributos que le pasemos, como ser $classes y el href y especificamos que los de class lo va encontrar como $classes-->
    <a {{$attributes->merge(['class'=>$classes])}}
       >
        {{ $slot }} <!--Esto para poner el campo de forma dinamica "olvido su contra..-->
    </a>

