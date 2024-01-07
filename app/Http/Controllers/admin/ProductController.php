<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Récupération des produits avec leurs images, triés par ordre décroissant d'identifiant
        $products = Product::latest('id')->with('product_images');

        // Filtrage des produits si un mot-clé de recherche est fourni
        if ($request->get('keyword') != "") {
            $products = $products->where('title', 'like', '%' . $request->get('keyword') . '%');
        }

        // Pagination des résultats
        $products = $products->paginate();

        // Passage des produits à la vue
        $data['products'] = $products;

        // Affichage de la vue listant les produits avec les résultats obtenus
        return view('admin.products.list', $data);
    }

    public function create()
    {
        // Initialisation d'un tableau de données
        $data = [];

        // Récupération des catégories et des marques pour la création d'un produit
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        // Passage des catégories et des marques à la vue
        $data['categories'] = $categories;
        $data['brands'] = $brands;

        // Affichage de la vue de création de produit avec les données récupérées
        return view('admin.products.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->image_array);
        // Définition des règles de validation pour les données du produit
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        // Ajout de règles conditionnelles en fonction des données fournies
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['quantity'] = 'required|numeric';
        }
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            // Création d'une nouvelle instance de produit
            $product = new Product;
            // Assignation des valeurs des champs du produit avec les données du formulaire
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->quantity;
            $product->status = $request->status;
            // Enregistrement du produit
            $product->save();
            // Enregistrement des images associées au produit depuis le formulaire
            if (!empty($request->image_array)) {
                foreach ($request->image_array as  $temp_image_id) {
                    // Manipulation des images et sauvegarde dans le répertoire approprié
                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray);
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();
                    $imageName = $product->id . '-' . $productImage->id . '-' . time() . '.' . $ext;
                    $productImage->image = $imageName;
                    $productImage->save();
                    //Generate Product Thumbnails
                    //Large Image
                    $sPath = public_path() . '/temp/' . $tempImageInfo->name;
                    $dPath = public_path() . '/uploads/product/large/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sPath);
                    $image->resize(width: 1400);
                    $image->toPng()->save($dPath);
                    //Small Image
                    $dPath = public_path() . '/uploads/product/small/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sPath);
                    $image->resize(300, 300);
                    $image->toPng()->save($dPath);
                }
            }
            // Flash message pour indiquer que le produit a été ajouté avec succès
            session()->flash('success', 'Product added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Product added successfully'
            ]);
        } else {
            // Si la validation échoue, renvoi des erreurs de validation au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        // fetch related products
        $relatedProducts = [];
        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->get();
        }
        $data = [];
        $data['product'] = $product;
        $data['subCategories'] = $subCategories;
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['productImages'] = $productImages;
        $data['relatedProducts'] = $relatedProducts;
        return view('admin.products.edit', $data);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id . ',id',
            'price' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id . ',id',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['quantity'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->quantity;
            $product->status = $request->status;
            $product->save();
            //Save Gallery Pics

            session()->flash('success', 'Product Updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Product Updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            session()->flash('error', 'Product Not Found');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }
        $productImages = ProductImage::where('product_id', $id)->get();
        if (!empty($productImages)) {
            foreach ($productImages as $productImage) {
                File::delete(public_path('uploads/product/large/' . $productImage->image));
                File::delete(public_path('uploads/product/small/' . $productImage->image));
            }
            ProductImage::where('product_id', $id)->delete();
        }
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function getProducts(Request $request)
    {
        $tempProduct = [];
        if ($request->term != "") {
            $products = Product::where('title', 'like', '%' . $request->term . '%')->get();
            if ($products != Null) {
                foreach ($products as $product) {
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
                }
            }
        }
        return response()->json([
            'tags' => $tempProduct,
            'status' => true
        ]);
    }
}
