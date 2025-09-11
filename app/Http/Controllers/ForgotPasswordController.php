<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

        $user = User::where('email', $request->input('email'))->first();
        if ($user){
            $response = Password::sendResetLink(
                $request->only('email')
            );
            return $response === Password::RESET_LINK_SENT
                ? back()->with('passwordresetSuccess', __($response))
                : back()->with('passwordresetError' , __($response));
        }
        return back()->with('passwordresetError' , "E-mail inválido");

        
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
        //return back()->with('status', 'Senha alterada com sucesso. Faça login para acessa o sistema');
        
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[^A-Za-z0-9]/|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60)
                ])->save();
                if (!$user->hasVerifiedEmail()) { 
                    $user->markEmailAsVerified(); 
                }
            } 
        );

        return $status == Password::PASSWORD_RESET
            ? back()->with('status', 'Senha alterada com sucesso. Faça login para acessa o sistema')
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    
}
