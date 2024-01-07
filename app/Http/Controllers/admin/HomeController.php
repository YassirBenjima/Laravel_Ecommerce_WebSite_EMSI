<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
        // $admin = Auth::guard('admin')->user();
        // echo 'Welcome  ' . $admin->name . '<a href="'.route('admin.logout').'"> Logout</a>' ;
    }

    public function logout()
    {
        // Déconnexion de l'administrateur
        Auth::guard('admin')->logout();

        // Redirection vers la page de connexion pour les administrateurs
        return redirect()->route('admin.login');
    }
}
