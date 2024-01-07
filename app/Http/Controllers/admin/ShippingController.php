<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipping;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function create()
    {
        // Récupération de la liste des pays
        $countries = Country::get(); // Récupère la liste des pays depuis la base de données
        $data['countries'] = $countries; // Stocke cette liste dans un tableau associatif nommé 'countries' pour l'utiliser dans la vue

        // Récupération des frais de livraison avec les noms des pays associés
        $shippingCharges = ShippingCharge::select('shipping_charges.*', 'countries.name')
            ->leftJoin('countries', 'countries.id', 'shipping_charges.country_id')
            ->get(); // Récupère les frais de livraison et les informations associées depuis la base de données
        $data['shippingCharges'] = $shippingCharges; // Stocke ces données dans un tableau associatif nommé 'shippingCharges' pour l'utiliser dans la vue

        // Retourne la vue pour créer un nouvel envoi avec les données récupérées
        return view('admin.shipping.create', $data); // Retourne la vue 'admin.shipping.create' en lui transmettant les données stockées dans '$data'
    }


    public function store(Request $request)
    {
        // Validation des données entrées
        $validator = Validator::make($request->all(), [
            'country' => 'required', // Le pays est requis
            'amount' => 'required|numeric' // Le montant est requis et doit être numérique
        ]);

        if ($validator->passes()) {
            // Compte le nombre de frais de livraison enregistrés pour le pays spécifique envoyé via la requête
            $count = ShippingCharge::where('country_id', $request->country)->count();

            // Vérifie s'il existe déjà des frais de livraison pour ce pays
            if ($count > 0) {
                // Si des frais de livraison existent déjà, un message d'erreur est créé dans la session
                session()->flash('error', 'Frais de livraison déjà ajoutés');

                // Retourne une réponse JSON avec le statut true
                return response()->json([
                    'status' => true
                ]);
            }

            // Si la validation réussit, enregistrement des informations de livraison
            $shipping = new ShippingCharge;
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            // Message de succès pour l'ajout des frais de livraison
            session()->flash('success', 'Frais de livraison ajoutés avec succès');

            // Réponse JSON en cas de succès
            return response()->json([
                'status' => true
            ]);
        } else {
            // En cas d'erreur de validation, retourne les erreurs au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id)
    {
        // Recherche des frais d'expédition en fonction de l'ID fourni
        $shippingCharge = ShippingCharge::find($id); // Récupère les frais d'expédition correspondant à l'ID donné depuis la base de données

        // Récupération de la liste complète des pays
        $countries = Country::get(); // Récupère la liste complète des pays depuis la base de données

        // Stockage des données dans un tableau associatif pour les transmettre à la vue
        $data['countries'] = $countries; // Stocke la liste des pays dans la clé 'countries' du tableau $data pour utilisation dans la vue
        $data['shippingCharge'] = $shippingCharge; // Stocke les frais d'expédition correspondant à l'ID dans la clé 'shippingCharges' du tableau $data pour utilisation dans la vue

        // Retourne la vue 'admin.shipping.edit' en transmettant les données stockées dans $data
        return view('admin.shipping.edit', $data); // Retourne la vue 'admin.shipping.edit' en transmettant les données stockées dans $data pour afficher les détails des frais d'expédition à modifier
    }

    public function update($id, Request $request)
    {
        $shipping = ShippingCharge::find($id);
        // Validation des données entrées
        $validator = Validator::make($request->all(), [
            'country' => 'required', // Le pays est requis
            'amount' => 'required|numeric' // Le montant est requis et doit être numérique
        ]);

        if ($validator->passes()) {
            // Vérifie si aucun frais de livraison n'a été trouvé
            if ($shipping == null) {
                // Si aucun frais de livraison n'est trouvé, un message de error est créé dans la session
                session()->flash('error', 'Frais de livraison non trouvé');

                // Retourne une réponse JSON avec le statut true pour indiquer qu'aucun frais de livraison n'a été trouvé
                return response()->json([
                    'status' => true
                ]);
            }
            // Si la validation réussit, enregistrement des informations de livraison
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            // Message de succès pour la modification des frais de livraison
            session()->flash('success', 'Frais de livraison modifiés avec succès');

            // Réponse JSON en cas de succès
            return response()->json([
                'status' => true
            ]);
        } else {
            // En cas d'erreur de validation, retourne les erreurs au format JSON
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destroy($id)
    {
        // Recherche des frais de livraison correspondant à l'identifiant donné
        $shippingCharge = ShippingCharge::find($id);

        // Vérifie si aucun frais de livraison n'a été trouvé pour cet identifiant
        if ($shippingCharge == null) {
            // Si aucun frais de livraison n'est trouvé, un message de succès est créé dans la session
            session()->flash('error', 'Frais de livraison non trouvé');

            // Retourne une réponse JSON avec le statut true pour indiquer qu'aucun frais de livraison n'a été trouvé
            return response()->json([
                'status' => true
            ]);
        }

        // Supprime les frais de livraison trouvés
        $shippingCharge->delete();

        // Crée un message de succès dans la session pour indiquer que les frais de livraison ont été supprimés avec succès
        session()->flash('success', 'Frais de livraison supprimés avec succès');

        // Retourne une réponse JSON avec le statut true pour indiquer que les frais de livraison ont été supprimés avec succès
        return response()->json([
            'status' => true
        ]);
    }
}
