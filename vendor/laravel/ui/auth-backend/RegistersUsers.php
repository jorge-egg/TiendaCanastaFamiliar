<?php

namespace Illuminate\Foundation\Auth;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $modelo = new Usuarios;
        $modelo -> nombre = $request->input('name');
        $modelo -> telefono = $request->input('telefono');
        $modelo -> direccion = $request->input('direccion');
        $modelo -> correo = $request->input('email');
        $modelo -> save();

        $this->guard()->login($user);

        $usuario = Usuarios::orderBy('idUsuario', 'desc')->first();
        $user = User::findOrFail($usuario -> idUsuario);
        $user -> assignRole('Cliente');

        (!$request -> file('imgPerfil'))
            ? $guardar = ""
            :
            $img = $request -> file('imgPerfil'); //traer archivo
            $url = public_path('img/perfil'); //crear url para guardar la imagen
            copy($img -> getRealPath(), $url."/".$usuario -> idUsuario.".".$img->guessExtension());
            $guardar = $usuario -> idUsuario.".".$img -> guessExtension();
        $modelo -> update(['fotoPerfil' => $guardar]);
        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
