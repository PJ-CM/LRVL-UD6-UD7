<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Obligar a iniciar sesión para acceder
        $this->middleware(['auth']);
    }

    protected $valores_tipo = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accion = null)
    {
        //devolviendo a una vista 'mostrar' que está dentro de una subcarpeta 'users'
        //es decir, users.mostrar
        //(físicamente, está en: resources/views/users/mostrar.blade.php)

        //SIN Paginación :: sacando todos los registros seguidos en la misma página
        ////$valores = User::all();
        //CON Paginación :: sacando X registros en cada página
        //      => Orden ASC
        ////$valores = User::paginate(5);
        //      => Orden DESC
        $valores = User::orderBy('id', 'desc')->paginate(5);

        //Debuggeando resultados
        //  >> con dd()
        ////dd('valores de usuario', $valores);
        //  >> con dump()
        ////dump('valores de usuario', $valores);

        //Devolviendo info a la vista correspondiente
        //----------------------------------------------------------
        return view('users.mostrar')->with([
            'vista_tipo' => 'listado',
            'vista_tit' => 'Listado',
            'valores_tipo' => $this->valores_tipo,
            'valores' => $valores,
            'valoresTOT' => count($valores),
            'accion' => $accion,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'activo' => 'required|in:0,1',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        //Validando petición
        $request->validate($reglas);

        //Insertando nuevo registro y recuperando el ID
        //------------------------------------------------
        /**
         * Como la contraseña del usuario debe ser encriptada (por ejemplo, con Hash)
         * no vale crear así el registro.
         * En este caso, hay que almacenar el nuevo registro con save()
         */
        //$dato = User::create($request->all());
        $dato = new User;
        $dato->name = $request->name;
        $dato->username = $request->username;
        $dato->direction = $request->direction;
        $dato->phone = $request->phone;
        $dato->country = $request->country;
        $dato->email = $request->email;
        $dato->password = Hash::make($request->password);
        $dato->activo = $request->activo;
        $dato->save();

        if(empty($dato->id)) {
            //Log::error('Failed to insert row into database.');
            dd('ERROR al insertar en la tabla ['.$this->valores_tipo.'s'.'] de la base de datos. ['. $dato->id.']');
        } else {
            //dd('Inserto efectuado. ['. $dato->id.']');

            //Redirigiendo al Listado
            //==========================================
            //  -> Redirigiendo hacia nombre de Ruta
            ////return redirect()->route('users_lista');
            $accion = 'insertar_'.$dato->id;
            return redirect()->route('users_lista', ['accion' => $accion]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    ////public function show(User $user)
    public function show($id)
    {
        $_arr_detalle = [];
        $_arr_detalle['vista_tipo'] = 'detalle';
        $_arr_detalle['vista_tit'] = 'Detalle';
        $_arr_detalle['valores_tipo'] = $this->valores_tipo;

        $valor = User::findOrFail($id);
        $_arr_detalle['valor'] = $valor;

        return view('users.mostrar')->with($_arr_detalle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    ////public function update(Request $request, User $user)
    public function update(Request $request)
    {
        //Demandar ser ADMIN para poder ACTUALIZAR
        ////$this->authorize('isAdmin');

        //Cuando el usuario sea de perfil ADMIN o AUTHOR
        if (Gate::allows('isAdmin') || Gate::allows('isAuthor')) {

            //Estableciendo reglas de validación
            /*$reglas = [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'activo' => 'required|in:0,1',
            ];*/
            $reglas = [
                'name' => 'required|string|max:255',
                //  >> Sin ignorar el valor del campo del registro [ID] pasado
                //      => [1d2]
                //'username' => ['required', 'string', 'max:255', 'unique:users'],
                //      => [2d2]
                //'username' => 'required|string|max:255|unique:users',
                //  >> Ignorando el valor del campo del registro [ID] pasado
                //      => [1d2]
                //          -> necesario importar la class de Rule (ver parte superior de este archivo)
                ////'username' => [
                ////    'required', 'string', 'max:255',
                ////    Rule::unique('users')->ignore($request->id),
                ////],
                //      => [2d2]
                //          -> |unique:tabla_nombre,nombre_campo_implicado,ID_registro_ignorar
                'username' => 'required|string|max:255|unique:users,username,' . $request->id,
                // ------------------------------------------------------------------------------
                //  >> Sin ignorar el valor del campo del registro [ID] pasado
                //      => [1d2]
                //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                //      => [2d2]
                //'email' => 'required|string|email|max:255|unique:users',
                //  >> Ignorando el valor del campo del registro [ID] pasado
                //      => [1d2]
                //          -> necesario importar la class de Rule (ver parte superior de este archivo)
                ////'email' => [
                ////    'required', 'string', 'email', 'max:255',
                ////    Rule::unique('users')->ignore($request->id),
                ////],
                //      => [2d2]
                //          -> |unique:tabla_nombre,nombre_campo_implicado,ID_registro_ignorar
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
                'activo' => 'required|in:0,1',
            ];
            //Validando petición
            $request->validate($reglas);

            //[1d2] Operación masiva contando con los campos especificados en el $fillable del modelo
            //User::where('id', $request->id)
            //        ->update($request->except('_token'));
            //[2d2] Operación detallada especificando, solamente, el o los campos a modificar
            $valor = User::findOrFail($request->id);
            $valor->name = $request->name;
            $valor->username = $request->username;
            $valor->direction = $request->direction;
            $valor->phone = $request->phone;
            $valor->country = $request->country;
            $valor->email = $request->email;
            $valor->activo = $request->activo;
            $valor->save();

            $accion = 'editar_' . $request->id;
            return redirect()->route('users_lista', ['accion' => $accion]);

        }//fin de es ADMIN o AUTHOR
    }

    /**
     * Editing the field of an specified register.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    ////public function update_campo(User $user)
    public function update_campo($id, $campo, $valor)
    {
        //Demandar ser ADMIN para poder ACTUALIZAR ESTE CAMPO
        $this->authorize('isAdmin');

        User::where('id', $id)
                ->update([
                    $campo => $valor,
                ]);
        //$accion = 'editar_'.$id;
        //return redirect()->route('users_lista', ['accion' => $accion]);
        return redirect()->route('users_lista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    ////public function destroy(User $user)
    public function destroy($id)
    {
        //Demandar ser ADMIN para poder ELIMINAR
        $this->authorize('isAdmin');

        User::where('id', $id)->delete();

        //Redirigiendo al Listado
        //==========================================
        //¡¡Así NO!!
        //$this->lista();
        //----------------------------
        //  -> Redirigiendo hacia método de Controlador
        ////return redirect()->action('UserController@lista');
        //----------------------------
        //  -> Redirigiendo hacia nombre de Ruta
        ////$accion = [
        ////    'tipo' => 'borrar',
        ////    'id' => $id,
        ////];
        $accion = 'borrar_'.$id;
        return redirect()->route('users_lista', ['accion' => $accion]);
    }
}
