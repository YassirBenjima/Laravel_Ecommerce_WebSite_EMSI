<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // Récupère les produits en vedette qui sont actifs
        $featuredProducts = Product::where('is_featured', 'Yes')->where('status', 1)->get();

        // Stocke les produits en vedette dans les données à passer à la vue
        $data['featuredProducts'] = $featuredProducts;

        // Récupère les derniers produits ajoutés (les plus récents) qui sont actifs (limite à 12 produits)
        $latestProducts = Product::orderBy('id', 'DESC')->where('status', 1)->take(12)->get();

        // Stocke les derniers produits dans les données à passer à la vue
        $data['latestProducts'] = $latestProducts;

        // Retourne la vue de la page d'accueil avec les données des produits en vedette et des derniers produits
        return view('front.home', $data);
    }
}
