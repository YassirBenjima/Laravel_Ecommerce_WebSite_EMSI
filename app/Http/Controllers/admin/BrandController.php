<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        // Récupération des marques avec la dernière marque en premier
        $brands = Brand::latest('id');

        // Pagination des résultats (10 éléments par page)
        $brands = $brands->paginate(10);

        // Filtrage des marques si un mot-clé de recherche est fourni
        if (!empty($request->get('keyword'))) {
            $brands = $brands->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        // Affichage de la vue listant les marques avec les résultats obtenus
        return view('admin.brands.list', compact('brands'));
    }

    public function create()
    {
        // Affichage de la vue pour créer une nouvelle marque
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        // Validation des données pour la création d'une nouvelle marque
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        // Si la validation passe, création d'une nouvelle marque
        if ($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();
            session()->flash('success', 'Marque créée avec succès');
            return response()->json([
                'status' => true,
                'message' => 'Marque ajoutée avec succès'
            ]);
        } else {
            // Si la validation échoue, renvoi des erreurs de validation
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        // Recherche de la marque par son identifiant
        $brand = Brand::find($id);

        // Vérification si la marque existe
        if (empty($brand)) {
            // Message d'erreur si la marque n'est pas trouvée et redirection vers la liste des marques
            session()->flash('error', 'Enregistrement introuvable');
            return redirect()->route('brands.index');
        }

        // Passage des données de la marque à la vue d'édition
        $data['brand'] = $brand;
        return view('admin.brands.edit', $data);
    }

    public function update($id, Request $request)
    {
        // Recherche de la marque par son identifiant
        $brand = Brand::find($id);

        // Vérification si la marque existe
        if (empty($brand)) {
            // Message d'erreur si la marque n'est pas trouvée et réponse JSON indiquant qu'elle n'a pas été trouvée
            session()->flash('error', 'Enregistrement introuvable');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
            // return redirect()->route('brands.index');
        }

        // Validation des données pour la mise à jour de la marque
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $brand->id . ',id',
        ]);

        // Si la validation passe, mise à jour des informations de la marque
        if ($validator->passes()) {
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();
            session()->flash('success', 'Marque mise à jour avec succès');
            return response()->json([
                'status' => true,
                'message' => 'Marque mise à jour avec succès'
            ]);
        } else {
            // Si la validation échoue, renvoi des erreurs de validation au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request)
    {
        // Recherche de la marque par son identifiant
        $brand = Brand::find($id);

        // Vérification si la marque existe
        if (empty($brand)) {
            // Redirection vers la liste des catégories si la marque n'est pas trouvée
            return redirect()->route('categories.index');
        }

        // Suppression de la marque
        $brand->delete();
        session()->flash('success', 'Marque supprimée avec succès');

        // Réponse JSON indiquant que la marque a été supprimée avec succès
        return response()->json([
            'status' => true,
            'message' => 'Marque supprimée avec succès'
        ]);
    }
}
