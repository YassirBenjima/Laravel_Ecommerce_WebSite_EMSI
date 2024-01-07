<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        // Initialisation des variables pour stocker les filtres sélectionnés
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        // Récupération des marques sélectionnées (si elles existent)
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
        }

        // Récupération de toutes les catégories et marques disponibles pour les filtres
        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();

        // Construction de la requête principale pour récupérer les produits actifs
        $products = Product::where('status', 1);

        // Filtrage par catégorie si une catégorie est sélectionnée
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }

        // Filtrage par sous-catégorie si une sous-catégorie est sélectionnée
        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }

        // Filtrage par marque si des marques sont sélectionnées
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('brand_id', $brandsArray);
        }

        // Tri des produits selon le paramètre de tri spécifié dans la requête
        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'latest') {
                $products = $products->orderBy('id', 'DESC');
            } else if ($request->get('sort') == 'price_desc') {
                $products = $products->orderBy('price', 'ASC');
            } else {
                $products = $products->orderBy('price', 'DESC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }

        // Pagination des résultats pour afficher 9 produits par page
        $products = $products->paginate(9);

        // Préparation des données pour être transmises à la vue
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['sort'] = $request->get('sort');

        // Affichage de la vue front.shop avec les données préparées
        return view('front.shop', $data);
    }


    public function product($slug)
    {
        // Récupération du produit correspondant au slug avec ses images associées
        $product = Product::where('slug', $slug)->with('product_images')->first();

        // Vérification de l'existence du produit, sinon renvoi d'une erreur 404
        if ($product == null) {
            abort(404);
        }

        // Récupération des produits associés
        $relatedProducts = [];
        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->with('product_images')->get();
        }

        // Préparation des données pour être transmises à la vue
        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;

        // Affichage de la vue front.product avec les données préparées
        return view('front.product', $data);
    }
}
