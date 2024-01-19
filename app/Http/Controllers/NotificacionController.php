<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        ///con la funcion unreadNotifications traemos las notificaciones que un no se ha leido
        $notificaciones = auth()->user()->unreadNotifications;

        //Limpiar notificaciones
        auth()->user()->unreadNotifications->markAsRead();
        return view('notificaciones.index',[
            'notificaciones' => $notificaciones //pasando la variable a la vista
        ]);
    }
}
