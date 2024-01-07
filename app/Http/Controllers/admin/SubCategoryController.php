<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        // Récupération de toutes les sous-catégories avec les détails de leur catégorie associée.
        // Filtrage des résultats en fonction du mot-clé de recherche fourni dans la requête.
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
            ->latest('id')
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');

        if (!empty($request->get('keyword'))) {
            $subCategories = $subCategories->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%')
                ->orWhere('categories.name', 'like', '%' . $request->get('keyword') . '%');
        }

        // Pagination des résultats
        $subCategories = $subCategories->paginate(10);

        // Affichage de la vue listant les sous-catégories avec les résultats obtenus
        return view('admin.sub_category.list', compact('subCategories'));
    }


    public function create()
    {
        // Récupération de toutes les catégories pour utiliser dans le formulaire de création de sous-catégorie
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;

        // Affichage de la vue de création de sous-catégorie avec les données récupérées
        return view('admin.sub_category.create', $data);
    }


    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required'
        ]);

        // Si la validation réussit, crée une nouvelle sous-catégorie
        if ($validator->passes()) {
            // Création d'une nouvelle instance de sous-catégorie
            $subCategory = new SubCategory();

            // Assignation des valeurs des champs de la sous-catégorie avec les données du formulaire
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->showHome = $request->showHome; // Il semble manquer cette variable dans les règles de validation
            $subCategory->category_id = $request->category;

            // Enregistrement de la sous-catégorie
            $subCategory->save();

            // Flash message pour indiquer que la sous-catégorie a été ajoutée avec succès
            session()->flash('success', 'Sous-catégorie créée avec succès');

            // Retourne une réponse JSON indiquant le succès de l'opération
            return response()->json([
                'status' => true,
                'message' => 'Sous-catégorie ajoutée avec succès'
            ]);
        } else {
            // Si la validation échoue, retourne les erreurs de validation au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit($id, Request $request)
    {
        // Récupération de la sous-catégorie à éditer en fonction de l'ID fourni.
        $subCategory = SubCategory::find($id);

        // Vérification si la sous-catégorie existe
        if (empty($subCategory)) {
            // Si la sous-catégorie n'est pas trouvée, flash d'un message d'erreur et redirection vers la liste des sous-catégories
            session()->flash('error', 'Enregistrement non trouvé');
            return redirect()->route('sub_categories.index');
        }

        // Récupération de toutes les catégories pour utiliser dans le formulaire
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $data['subCategory'] = $subCategory;

        // Affichage de la vue d'édition de sous-catégorie avec les données récupérées
        return view('admin.sub_category.edit', $data);
    }


    public function update($id, Request $request)
    {
        // Récupération de la sous-catégorie à mettre à jour en fonction de l'ID fourni.
        $subCategory = SubCategory::find($id);

        // Vérification si la sous-catégorie existe
        if (empty($subCategory)) {
            // Si la sous-catégorie n'est pas trouvée, flash d'un message d'erreur et retourne une réponse JSON indiquant que l'enregistrement n'a pas été trouvé.
            session()->flash('error', 'Enregistrement non trouvé');
            return response([
                'status' => false,
                'notFound' => true
            ]);
            // return redirect()->route('sub_categories.index');
        }

        // Validation des données du formulaire.
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,' . $subCategory->id . ',id',
            'category' => 'required',
            'status' => 'required'
        ]);

        // Si la validation réussit, met à jour la sous-catégorie.
        if ($validator->passes()) {
            // Assignation des nouvelles valeurs des champs de la sous-catégorie avec les données du formulaire
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->showHome = $request->showHome; // Il semble manquer cette variable dans les règles de validation
            $subCategory->category_id = $request->category;

            // Enregistrement de la sous-catégorie mise à jour
            $subCategory->save();

            // Flash message pour indiquer que la sous-catégorie a été mise à jour avec succès
            session()->flash('success', 'Sous-catégorie mise à jour avec succès');

            // Retourne une réponse JSON indiquant le succès de l'opération
            return response()->json([
                'status' => true,
                'message' => 'Sous-catégorie mise à jour avec succès'
            ]);
        } else {
            // Si la validation échoue, retourne les erreurs de validation au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy($id, Request $request)
    {
        // Récupération de la sous-catégorie à supprimer en fonction de l'ID fourni.
        $subCategory = SubCategory::find($id);

        // Vérification si la sous-catégorie existe
        if (empty($subCategory)) {
            // Si la sous-catégorie n'est pas trouvée, flash d'un message d'erreur et retourne une réponse JSON indiquant que l'enregistrement n'a pas été trouvé.
            session()->flash('error', 'Enregistrement non trouvé');
            return response([
                'status' => false,
                'notFound' => true
            ]);
        }

        // Suppression de la sous-catégorie
        $subCategory->delete();

        // Flash message pour indiquer que la sous-catégorie a été supprimée avec succès
        session()->flash('success', 'Sous-catégorie supprimée avec succès');

        // Retourne une réponse JSON indiquant le succès de la suppression de la sous-catégorie
        return response()->json([
            'status' => true,
            'message' => 'Sous-catégorie supprimée avec succès'
        ]);
    }
}
