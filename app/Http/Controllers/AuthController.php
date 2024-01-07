<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Affiche la vue pour la connexion
    public function login()
    {
        return view('front.account.login');
    }
    // Affiche la vue pour l'enregistrement
    public function register()
    {
        return view('front.account.register');
    }

    // Processus d'enregistrement d'un utilisateur
    public function processRegister(Request $request)
    {
        // Validation des données envoyées
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|same:confirm-password'
        ]);

        if ($validator->passes()) {
            // Insertion des données dans la table des utilisateurs
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            // Message de succès et réponse JSON
            session()->flash('success', 'You Have been registred successfully');
            return response()->json([
                'status' => true,
            ]);
        } else {
            // Retourne les erreurs de validation
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // Authentification de l'utilisateur
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            // Authentification de l'utilisateur
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                // Redirection après l'authentification réussie
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }
                return redirect()->route('account.profile');
            } else {
                // Redirection avec un message d'erreur si l'authentification échoue
                session()->flash('error', 'Email OR Password is incorrect');
                return redirect()->route('account.login')->withInput($request->only('email'))->with('error', 'Email OR Password is incorrect');
            }
        } else {
            // Retourne les erreurs de validation si la validation échoue
            return redirect()->route('account.login')->withErrors($validator)->withInput($request->only('email'));
        }
    }
    // Affiche la vue du profil utilisateur
    public function profile()
    {
        return view('front.account.profile');
    }
    // Déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')->with('success', 'You successfully logged out !');
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $data['orders'] = $orders;
        return view('front.account.order', $data);
    }
}
