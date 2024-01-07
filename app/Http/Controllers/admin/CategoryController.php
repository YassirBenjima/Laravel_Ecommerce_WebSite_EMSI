<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Récupération des catégories, triées par ordre décroissant de création
        $categories = Category::latest();

        // Filtrage des catégories si un mot-clé de recherche est fourni
        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        // Pagination des résultats (10 éléments par page)
        $categories = $categories->paginate(10);

        // Affichage de la vue listant les catégories avec les résultats obtenus
        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        // Affichage de la vue pour créer une nouvelle catégorie
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // Validation des données pour la création d'une nouvelle catégorie
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
            // D'autres règles de validation peuvent être ajoutées ici
        ]);

        if ($validator->passes()) {
            // Si la validation passe, création d'une nouvelle catégorie
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;

            $category->save();

            // Sauvegarde de l'image si une image est associée à la catégorie
            if (!empty($request->image_id)) {
                // Manipulation de l'image et sauvegarde dans le répertoire approprié
                // (Le code pour la gestion des images et leur manipulation se trouve ici)
            }

            session()->flash('success', 'Catégorie créée avec succès');

            return response()->json([
                'status' => true,
                'message' => 'Catégorie ajoutée avec succès'
            ]);
        } else {
            // Si la validation échoue, renvoi des erreurs de validation au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($categoryId, Request $request)
    {
        // Recherche de la catégorie par son identifiant
        $category = Category::find($categoryId);

        // Vérification si la catégorie existe
        if (empty($category)) {
            // Redirection vers la liste des catégories si la catégorie n'est pas trouvée
            return redirect()->route('categories.index');
        }

        // Affichage de la vue d'édition avec les données de la catégorie
        return view('admin.category.edit', compact('category'));
    }

    public function update($categoryId, Request $request)
    {
        // Recherche de la catégorie par son identifiant
        $category = Category::find($categoryId);
        // Vérification si la catégorie existe
        if (empty($category)) {
            // Message d'erreur si la catégorie n'est pas trouvée et réponse JSON indiquant qu'elle n'a pas été trouvée
            session()->flash('error', 'Category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }
        // Validation des données pour la mise à jour de la catégorie
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id . ',id',
        ]);
        if ($validator->passes()) {
            // Mise à jour des informations de la catégorie
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();
            $oldImage = $category->image;
            // Sauvegarde de la nouvelle image si une nouvelle image est associée à la catégorie
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);
                $newImageName = $category->id . '-' . time() . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/category/thumb/' . $newImageName;
                File::copy($sPath, $dPath);
                //Generate Image
                // $dPath = public_path() . '/uploads/category/thumb/' . $newImageName;
                // $img = Image::make($sPath);
                // $img->resize(450, 600);
                // $img->save($dPath);
                $category->image = $newImageName;
                $category->save();
                //Delete Old Image
                File::delete(public_path() . '/uploads/category/thumb/' . $oldImage);
                File::delete(public_path() . '/uploads/category/' . $oldImage);
            }
            session()->flash('success', 'Category Updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category Updated successfully'
            ]);
        } else {
            // Si la validation échoue, renvoi des erreurs de validation au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId)
    {
        // Recherche de la catégorie à supprimer par son identifiant
        $category = Category::find($categoryId);

        // Vérification si la catégorie existe
        if (empty($category)) {
            // Redirection vers la liste des catégories si la catégorie n'est pas trouvée
            return redirect()->route('categories.index');
        }

        // Suppression des fichiers d'image associés à la catégorie depuis le serveur
        File::delete(public_path() . '/uploads/category/thumb/' . $category->image);
        File::delete(public_path() . '/uploads/category/' . $category->image);

        // Suppression de la catégorie
        $category->delete();

        // Message de succès indiquant que la catégorie a été supprimée avec succès
        session()->flash('success', 'Catégorie supprimée avec succès');

        return response()->json([
            'status' => true,
            'message' => 'Catégorie supprimée avec succès'
        ]);
    }
}
