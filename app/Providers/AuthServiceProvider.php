<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        // VerifyEmail::toMailUsing(function($notifiable, $url){
        //     return (new MailMessage)
        //         ->subject("Verifcação de E-mail")
        //         ->line("Por favor clique no link abaixo para verificar seu e-mail")
        //         ->action("Verifique seu e-mail", $url)
        //         ->line('Se você não criou nenhuma conta, basta ignorar esse e-mail');
        // });

        // ResetPassword::toMailUsing(function($notifiable, $url){
        //     $expires = config('auth.passwords'.config('auth.defaults.passwords').'.expire');

        //     return (new MailMessage)
        //         ->subject('Redefinição de senha')
        //         ->line('Você está recebendo esse e-mail para redefinição de senha')
        //         ->action('Redefinir senha', $url)
        //         ->line('Esse link de redifição de senha expirará em '. $expires . ' minutos.')
        //         ->line('Se você não fez essa solicitação, basta ignorar esse e-mail');
        // });
    }
}
