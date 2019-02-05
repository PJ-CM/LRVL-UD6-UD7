<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieSessionController extends Controller
{
    /**
     * Guardando COOKIE sobre permiso de gestión de cookies
     * para la navegación por la página
     *
     * @return void
     */
    public function storeCookie(Request $request)
    {
        $this->validate($request, [
            'chck_cookie_ok' => 'required'
        ]);
        return redirect('/')
            ->withCookie(cookie('chck_cookie_ok', $request->chck_cookie_ok, 60 * 24 * 365));
    }

    /**
     * Guardando SESSION para guardar preferencias
     * de estilos para la página elegidos por el usuario
     *
     * @return void
     */
    public function storeSession()
    {
        //
    }
}
