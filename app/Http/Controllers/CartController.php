<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharge;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Recherche du produit dans la base de données en fonction de l'identifiant reçu.
        $product = Product::with('product_images')->find($request->id);

        // Vérification si le produit existe.
        if ($product == null) {
            // Si le produit n'est pas trouvé, renvoyer un message d'erreur.
            return response()->json([
                'status' => false,
                'message' => "Product Not Found"
            ]);
        }

        // Vérification si le panier n'est pas vide.
        if (Cart::count() > 0) {
            // Si le panier n'est pas vide, vérification si ce produit existe déjà dans le panier.
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            // Parcours des produits dans le panier pour vérifier l'existence du produit.
            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                    break; // Arrête la boucle si le produit est déjà dans le panier.
                }
            }

            // Si le produit n'existe pas dans le panier, l'ajouter.
            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
                $status = true;
                $message = $product->title . ' Added in Cart';
            } else {
                // Si le produit existe déjà dans le panier, renvoyer un message.
                $status = false;
                $message = $product->title . ' Already Added in Cart';
            }
        } else {
            // Si le panier est vide, ajouter le produit au panier.
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
            $status = true;
            $message = $product->title . ' Added in Cart';
        }

        // Renvoyer une réponse JSON indiquant le statut et un message.
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart()
    {
        // Récupération du contenu actuel du panier.
        $cartContent = Cart::content();

        // Passage des données du panier à la vue front.cart.
        $data['cartContent'] = $cartContent;

        // Retourne la vue front.cart avec les données du panier.
        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {
        // Récupération de l'identifiant de la ligne dans le panier et la quantité à mettre à jour.
        $rowId = $request->rowId;
        $qty = $request->qty;

        // Vérification de la quantité disponible en stock pour cet article.
        $itemInfo = Cart::get($rowId); // Informations sur l'article dans le panier.
        $product = Product::find($itemInfo->id); // Recherche du produit dans la base de données.

        // Vérification si le suivi de la quantité est activé pour ce produit.
        if ($product->track_qty == 'Yes') {
            // Vérification si la quantité demandée est disponible en stock.
            if ($qty <= $product->qty) {
                // Si la quantité est disponible, met à jour la quantité dans le panier.
                Cart::update($rowId, $qty);
                $status = true;
                $message = 'Cart updated successfully';
                session()->flash('success', $message); // Message de succès pour la session.
            } else {
                // Si la quantité demandée n'est pas disponible en stock.
                $status = false;
                $message = "Requested quantity $qty is not available.";
                session()->flash('danger', $message); // Message d'avertissement pour la session.
            }
        } else {
            // Si le suivi de la quantité n'est pas activé pour ce produit, met à jour la quantité dans le panier.
            Cart::update($rowId, $qty);
            $status = true;
            $message = 'Cart updated successfully';
            session()->flash('success', $message); // Message de succès pour la session.
        }

        // Retourne une réponse JSON avec le statut et le message résultant de l'opération.
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function removeFromCart(Request $request)
    {
        // Récupère les informations sur l'article dans le panier à partir de son identifiant de ligne.
        $itemInfo = Cart::get($request->rowId);

        // Vérifie si l'article est déjà supprimé du panier.
        if ($itemInfo == null) {
            $errorMessage = 'This item has already been removed from your cart.';
            session()->flash('error', $errorMessage); // Envoie un message d'erreur à la session.
            return response()->json([
                'status' => false,
                'message' => $errorMessage,
            ]);
        }

        // Supprime l'article du panier.
        Cart::remove($request->rowId);

        // Message de succès pour la session.
        $message = 'Product removed from the cart successfully';
        session()->flash('success', $message);

        // Retourne une réponse JSON confirmant la suppression de l'article.
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }


    public function checkout()
    {
        // Vérifie si le panier est vide et redirige vers la page du panier le cas échéant.
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        // Vérifie si l'utilisateur n'est pas connecté et le redirige vers la page de connexion.
        if (Auth::check() == false) {
            // Enregistre l'URL actuelle dans la session pour une redirection après connexion.
            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('account.login');
        }

        // Récupère l'adresse du client à partir de l'ID de l'utilisateur actuellement connecté.
        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        // Supprime l'URL prévue de la session après vérification.
        session()->forget('url.intended');

        // Récupère la liste des pays par ordre alphabétique pour le formulaire de commande.
        $countries = Country::orderBy('name', 'ASC')->get();

        if ($customerAddress != '') {
            //Calculer les frais de livraison
            $userCountry = $customerAddress->country_id; // Récupère l'identifiant du pays de l'utilisateur à partir de son adresse

            // Récupère les informations d'expédition en fonction du pays de l'utilisateur
            $shippingInfo = ShippingCharge::where('country_id', $userCountry)->first();
            $totalQty = 0; // Initialise la variable de quantité totale
            $totalShippingCharge = 0; // Initialise la variable de frais de port total
            $grandTotal = 0;
            // Parcours chaque élément dans le panier et calcule la quantité totale
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty; // Accumule la quantité de chaque article
            }

            // Calcule les frais de port totaux en fonction de la quantité totale et du montant des frais de port pour ce pays
            $totalShippingCharge = $totalQty * $shippingInfo->amount;

            $grandTotal = Cart::subtotal(2, '.', '') + $totalShippingCharge;
        } else {
            // Calcule les frais de port totaux
            $totalShippingCharge = 0;

            $grandTotal = Cart::subtotal(2, '.', '');
        }
        // Retourne la vue du processus de paiement avec les informations nécessaires.
        return view('front.checkout', [
            'countries' => $countries,
            'customerAddress' => $customerAddress,
            'totalShippingCharge' => $totalShippingCharge,
            'grandTotal' => $grandTotal
        ]);
    }

    public function processCheckout(Request $request)
    {
        // Valide les données du formulaire de paiement.
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'address' => 'required|min:15',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',
        ]);
        // Si la validation échoue, retourne les erreurs.
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please Fix The Errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // step - Save User Address
        // Enregistre ou met à jour l'adresse de livraison de l'utilisateur.
        $user = Auth::user();
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,

            ]
        );
        //step - Store Data In Orders Table
        // Enregistre la commande dans la table des commandes.
        if ($request->payment_method == 'cod') {
            $shipping = 0;
            $discount = 0;
            $subTotal = Cart::subTotal(2, '.', '');
            // Calcul des totaux et des frais de livraison.
            $shippingInfo = ShippingCharge::where('country_id', $request->country)->first();
            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }
            if ($shippingInfo != null) {
                $shipping = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shipping;
            }
            // Crée une nouvelle commande.
            $order = new Order;
            // Initialise les attributs de la commande.
            $order->subTotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->payement_status = 'not paid';
            $order->status = 'pending';
            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->country_id = $request->country;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->notes = $request->notes;
            // Enregistre la commande dans la base de données.
            $order->save();
            // Step - Store Order Items In Order Items Table
            // Enregistre les éléments de la commande dans la table des éléments de commande.
            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                // Initialise les attributs de l'élément de commande.
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                // Enregistre l'élément de commande dans la base de données.
                $orderItem->save();
            }
            // Affiche un message de succès et vide le panier après l'enregistrement de la commande.
            session()->flash('success', 'You Have Successfully Placed Your Order.');
            Cart::destroy();
            return response()->json([
                'message' => 'Order Saved Successfully',
                'orderId' => $order->id,
                'status' => true,
            ]);
        } else {
        }
    }
    public function thankyou($id)
    {
        // Cette fonction renvoie une vue de remerciement avec l'identifiant de la commande
        return view('front.thanks', [
            'id' => $id // L'identifiant de la commande est passé à la vue pour afficher des détails spécifiques à cette commande
        ]);
    }
    public function getOrderSummary(Request $request)
    {
        // Calculate the subtotal of the cart
        $subTotal = Cart::subtotal(2, '.', '');

        // Check if a country ID is provided in the request
        if ($request->country_id > 0) {
            // Retrieve shipping information based on the country ID
            $shippingInfo = ShippingCharge::where('country_id', $request->country_id)->first();

            // Initialize the total quantity of items in the cart
            $totalQty = 0;

            // Calculate the total quantity of items in the cart
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            // Check if shipping information is available
            if ($shippingInfo != null) {
                // Calculate the shipping charge based on the total quantity and shipping amount
                $shippingCharge = $totalQty * $shippingInfo->amount;

                // Calculate the grand total by adding the subtotal and shipping charge
                $grandTotal = $subTotal + $shippingCharge;

                // Return the JSON response with status, grand total, and shipping charge
                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'shippingCharge' => number_format($shippingCharge, 2)
                ]);
            }
        } else {
            // If no country ID is provided, return the JSON response with only the subtotal
            return response()->json([
                'status' => true,
                'grandTotal' => number_format($subTotal, 2),
                'shippingCharge' => number_format(0, 2)
            ]);
        }
    }
}
