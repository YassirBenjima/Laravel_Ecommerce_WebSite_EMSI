<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        // Affiche la vue de connexion pour l'administrateur
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        // Validation des informations saisies pour la connexion
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // L'email est requis et doit être au format valide
            'password' => 'required' // Le mot de passe est requis
        ]);

        if ($validator->passes()) {
            // Tentative de connexion avec les informations fournies
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                // Si la connexion réussit, récupération des informations de l'administrateur connecté
                $admin = Auth::guard('admin')->user();

                // Vérification du rôle de l'administrateur
                if ($admin->role == 2) {
                    // Redirection vers le tableau de bord de l'administrateur si le rôle est celui attendu
                    return redirect()->route('admin.dashboard');
                } else {
                    // Déconnexion de l'administrateur si le rôle n'est pas autorisé et redirection vers la page de connexion avec un message d'erreur
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'Vous n\'êtes pas autorisé à vous connecter')->withInput($request->only('email'));
                }
            } else {
                // Redirection vers la page de connexion avec un message d'erreur en cas d'identifiants incorrects
                return redirect()->route('admin.login')->with('error', 'L\'email ou le mot de passe est incorrect')->withInput($request->only('email'));
            }
        } else {
            // Redirection vers la page de connexion avec les erreurs de validation affichées
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }
}
