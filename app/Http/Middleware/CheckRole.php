<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed ...$roles   Les rôles acceptés (ex: 'admin', 'agent', 'locataire')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            // Pas connecté, redirection vers login
            return redirect()->route('login');
        }

        // Vérifie que le rôle de l'utilisateur est dans la liste des rôles autorisés
        if (!in_array($user->role, $roles)) {
            // Accès refusé, tu peux soit abort(403) ou rediriger
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
