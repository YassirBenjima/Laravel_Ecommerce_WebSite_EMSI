<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        // Vérification si un identifiant de catégorie est fourni dans la requête
        if (!empty($request->category_id)) {
            // Récupération des sous-catégories associées à l'identifiant de catégorie fourni, triées par nom
            $subCategories = SubCategory::where('category_id', $request->category_id)
                ->orderBy('name', 'ASC')
                ->get();

            // Renvoi d'une réponse JSON avec les sous-catégories trouvées
            return response()->json([
                'status' => true,
                'subCategories' => $subCategories
            ]);
        } else {
            // Si aucun identifiant de catégorie n'est fourni, renvoi d'un message d'erreur
            return response()->json([
                'status' => false,
                'message' => 'Aucun identifiant de catégorie fourni.'
            ]);
        }
    }
}
