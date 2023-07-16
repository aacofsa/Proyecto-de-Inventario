<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['usuario'] = Usuario::all();
        $empresas = Api\EmpresaApiController::index();
        return view('usuario.index', $datos, compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $empresas = Api\EmpresaApiController::index();
        return view('usuario.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $empresas = Api\EmpresaApiController::index();
        $datosUsuario = request()->except('_token');

        $restricciones = array(
            'email'=>'required|email|unique:usuario',
            'id_empresa'=>'required',
            'rut' => 'nullable',
            'nombre'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'apellido_paterno'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'apellido_materno'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 years|after_or_equal:-125 years',
            'clave'=>'required|string|max:60|min:8',
            'foto'=>'max:10000|mimes:jpg,jpeg,png',
            'rol'=>'required'
        );

        $mensajes = array(
            'email.unique' => 'El correo electrónico ya está en uso.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento debe ser menor a 125 años.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser mayor a 18 años.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'clave.required' => 'La clave es obligatoria.'
        );

        $validatorUsr = Validator::make($datosUsuario, $restricciones, $mensajes);

        if($validatorUsr->fails()){
            return redirect()->back()->withErrors($validatorUsr)->withInput();
        }
        
        $errores = [
            'rut' => []
        ];

        $errores = $this->validarRut($request->all()['rut'], $errores);

        if(isset($errores['rut']) && count($errores['rut']) > 0){
            return redirect()->back()->withErrors($errores)->withInput();
        }

        if($request->has('activo') && $request->get('activo') == false){
            $datosUsuario['activo'] = false;
        } else {
            $datosUsuario['activo'] = true;
        }

        if($request->hasFile('foto')) {
            $datosUsuario['foto'] = $request->file('foto')->store('uploads', 'public');
        } else {
            $datosUsuario['foto'] = 'uploads/default_user_image.png';
        }
        
        $datosUsuario['rut'] = $this->formatearRut($request->all()['rut']);

        Usuario::insert($datosUsuario);
        
        $empresas = Api\EmpresaApiController::index();
        return redirect('usuario')->with('msg_usuario_creado', 'Se ha creado correctamente el usuario.');
        //return response()->json($datosUsuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($email)
    {
        //
        $empresas = Api\EmpresaApiController::index();
        $usuario = Usuario::findOrFail($email);

        return view('usuario.edit', compact('empresas', 'usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        //
        $datosUsuario = request()->except(['_token', '_method']);

        $restricciones = array(
            'email'=>'required|email',
            'id_empresa'=>'required',
            'rut' => 'nullable',
            'nombre'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'apellido_paterno'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'apellido_materno'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 years|after_or_equal:-125 years',
            'clave'=>'required|string|max:60|min:8',
            'foto'=>'max:10000|mimes:jpg,jpeg,png',
            'rol'=>'required'
        );

        $mensajes = array(
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento debe ser menor a 125 años.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser mayor a 18 años.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'clave.required' => 'La clave es obligatoria.'
        );

        $validatorUsr = Validator::make($datosUsuario, $restricciones, $mensajes);
        
        if($validatorUsr->fails()){
            return redirect()->back()->withErrors($validatorUsr)->withInput();
        }
        
        $errores = [
            'rut' => []
        ];

        $errores = $this->validarRut($request->all()['rut'], $errores);

        if(isset($errores['rut']) && count($errores['rut']) > 0){
            return redirect()->back()->withErrors($errores)->withInput();
        }

        if($request->has('activo')){
            $datosUsuario['activo'] = true;
        } else {
            $datosUsuario['activo'] = false;
        }

        $usuario = Usuario::findOrFail($email);
        if($request->hasFile('foto')) {
            if($usuario->foto != 'uploads/default_user_image.png') {
                Storage::delete('public/'.$usuario->foto);
            }
            $datosUsuario['foto'] = $request->file('foto')->store('uploads', 'public');
        } else {
            if($usuario->email == null) {
                $datosUsuario['foto'] = 'uploads/default_user_image.png';
            }
        }

        $datosUsuario['rut'] = $this->formatearRut($request->all()['rut']);

        Usuario::where('email', '=', $email)->update($datosUsuario);
        $email = $datosUsuario['email'];

        return redirect('usuario')->with('msg_usuario_modificado', 'Se ha modificado el usuario.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($email)
    {
        //
        $usuario = Usuario::findOrFail($email);
        if($usuario->foto != 'uploads/default_user_image.png') {
            Storage::delete('public/'.$usuario->foto);
        }
        Usuario::destroy($email);

        return redirect('usuario')->with('msg_usuario_eliminado', 'Se ha eliminado el usuario.');
    }

    private function validarRut($rut, $errores){
        if($rut) {
            $rut = str_replace("-","",str_replace(".","", $rut));
            $digito_verificador = substr($rut, -1);
            $numero = intval(substr($rut, 0, -1));

            $contador = 0;
            $i = 0;
            while($numero != 0){
                $digito = $numero%10;
                $contador += $digito * ($i%6 + 2);
                $i++;
                $numero = intval(($numero/10));
            }
            $resultado_digito = 11 - $contador%11;

            if (strlen($rut) > 9) {
                $rut_valido = false;
            } else {
                if ($resultado_digito==11){
                    $rut_valido = "0" == $digito_verificador;
                } else {
                    if($resultado_digito==10){
                        $rut_valido = "k" == strtolower($digito_verificador);
                    } else {
                        $rut_valido = $resultado_digito == $digito_verificador;
                    }
                }
            }
            

            if(!$rut_valido){
                if(count(array_keys($errores,'rut')) == 0) {
                    $errores['rut'] = [];
                }
                array_push($errores['rut'], "El formato del campo RUT es inválido.");
            }

            return $errores;
        }
    }

    private function formatearRut($rut){
        $rut = str_replace("-","",str_replace(".","", $rut));
        $rut_formateado =  (strlen($rut) == 9 ? substr($rut,0,2) : substr($rut,0,1)) . substr($rut, -7, 3) . substr($rut, -4, 3) . "-" . substr($rut, -1);
        return strtolower($rut_formateado);
    }

    function login() {
        return view('auth.login');
    }

    function register() {
        return view('auth.register');
    }

    function createUser(Request $request) {
        //return $request->input();

        $datosUsuario = request()->except('_token');

        $restricciones = array(
            'email'=>'required|email|unique:usuario',
            'nombre'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'apellido_paterno'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'apellido_materno'=>'required|between:1,50|regex:/^[A-zÀ-ú\s]*$/',
            'fecha_nacimiento'=>'required|date|before_or_equal:-18 years|after_or_equal:-125 years',
            'clave'=>'required|string|max:60|min:8'
        );

        $mensajes = array(
            'email.unique' => 'El correo electrónico ya está en uso.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento debe ser menor a 125 años.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento debe ser mayor a 18 años.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'clave.required' => 'La clave es obligatoria.'
        );

        $validatorUsr = Validator::make($datosUsuario, $restricciones, $mensajes);

        if($validatorUsr->fails()){
            return redirect()->back()->withErrors($validatorUsr)->withInput();
        }

        $idempresa = DB::table('empresa')
            ->insertGetId([
                'rut' => "",
                'nombre' => 'Empresa de ' . $request->nombre,
                'telefono' => '999999999',
                'direccion' => 'Avenida Los Olivos 23, Concepción',
                'correo' => "",
                'rl_rut' => "",
                'rl_nombre' => $request->nombre,
                'rl_paterno' => $request->apellido_paterno,
                'rl_materno' => "",
                'rl_telefono' => '999999999',
                'rl_correo' => $request->email,
                'activo' => true
            ]);
        
        $queryUsuario = DB::table('usuario')
            ->insert([
                'email' => $request->email,
                'id_empresa' => $idempresa,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'clave' => Hash::make($request->clave),
                'foto' => "uploads/default_user_image.png",
                'rol' => "admin"
            ]);

        if($queryUsuario) {
            return redirect('home');
        } else {
            return back()->with('fail','Algo ha fallado.');
        }
    }

    function check(Request $request) {
        //return $request->input();

        $datosLogin = request()->except('_token');

        $restricciones = array(
            'email'=>'required|email',
            'clave'=>'required|string|max:60|min:8'
        );

        $mensajes = array(
            'email.required' => 'El correo electrónico es obligatorio.',
            'clave.required' => 'La clave es obligatoria.'
        );

        $validatorUsr = Validator::make($datosLogin, $restricciones, $mensajes);

        if($validatorUsr->fails()){
            return redirect()->back()->withErrors($validatorUsr)->withInput();
        }

        $usuario = DB::table('usuario')
            ->where('email', $request->email)
            ->first();

        if($usuario) {
            if(Hash::check($request->clave, $usuario->clave)) {
                $request->session()->put('LoggedUser', $usuario->email);
                return redirect('profile');
            } else {
                return back()->with('fail', 'Clave inválida.');
            }
        } else {
            return back()->with('fail', 'No se encontró una cuenta con este correo.');
        }
    }

    // function logout() {
    //     if(session()->has('LoggedUser')) {
    //         session()->pull('LoggedUser');
    //         return redirect('home');
    //     }
    // }
}
