<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // ===============================
        // 1️ VALIDAÇÃO DE DOMÍNIO
        // ===============================

        $email = strtolower(trim($googleUser->getEmail()));

        $allowedDomains = array_map(
            'trim',
            explode(',', env('ALLOWED_EMAIL_DOMAINS', 'ctjj.org'))
        );

        $domain = substr(strrchr($email, "@"), 1);

        if (! in_array($domain, $allowedDomains)) {
            abort(403, 'Domínio não autorizado.');
        }

        // ===============================
        // 2️ BUSCAR USUÁRIO
        // ===============================

        $user = User::where('email', $email)->first();

        if (! $user) {
            abort(
                403,
                'Usuário não cadastrado no sistema. Procure a secretaria.'
            );
        }

        // ===============================
        // 3️ BLOQUEAR USUÁRIO ARQUIVADO
        // ===============================

        if ($user->archived) {
            abort(403, 'Usuário desativado no sistema.');
        }

        // ===============================
        // 4 BLOQUEAR USUÁRIO SEM PERFIL DEFINIDO
        // ===============================

        if (! $user->role) {
            abort(403, 'Usuário sem perfil definido. Procure a secretaria.');
        }

        $allowedRoles = [
            'administrador',
            'gestor',
            'professor',
            'aluno',
            'apoio',
        ];

        if (! in_array($user->role, $allowedRoles)) {
            abort(403, 'Perfil de usuário inválido.');
        }

        // ===============================
        // 5 ATUALIZAR PROVIDER (1ª VEZ)
        // ===============================

        if ($user->auth_provider !== 'google') {
            $user->update([
                'auth_provider' => 'google',
                'provider_id'   => $googleUser->getId(),
            ]);
        }

        // ===============================
        // 6 LOGIN
        // ===============================

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}
