<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('forgotPassword');
    }

    public function link(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];

        $customMessages = [
            'email.required' => 'E-mail é obrigatório.',
            'email.email' => 'E-mail inválido.'
        ];
        
        $request->validate($rules, $customMessages);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response === Password::RESET_LINK_SENT
            ? back()->with('passwordresetSuccess', __($response))
            : back()->with('passwordresetError' , __($response));
    }

    public function resetPassword(Request $request)
    {
        //print $token." ".$email;
        /*
        $tokenData = DB::table('password_reset_tokens')->where('token', $token)->first();

        dd($tokenData);

        if ( !$tokenData ) 
            return redirect()->to('login'); //redirect them anywhere you want if the token does not exist.
        */

        $token = $request->token;

        return view('resetPassword')->with(
            ['token' => $token, 'email' => $request->email]
        );
        //return view ('resetPassword', compact("token"));
    }

    public function reset(Request $request)
    {
        return back()->with('status', 'Senha alterada com sucesso. <Br> Faça login para acessa o sistema');
        
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? back()->with('status', 'Senha alterada com sucesso. <Br> Faça login para acessa o sistema')
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    
}
