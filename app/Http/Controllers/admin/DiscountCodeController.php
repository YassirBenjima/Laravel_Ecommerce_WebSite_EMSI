<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les coupons de réduction, triés par la date de création
        $discountCoupons = DiscountCoupon::latest();

        // Vérifier si une recherche par mot-clé est effectuée
        if (!empty($request->get('keyword'))) {
            // Si un mot-clé est présent, filtrer les coupons dont le nom correspond au mot-clé
            $discountCoupons = $discountCoupons->where('name', 'like', '%' . $request->get('keyword') . '%');
            $discountCoupons = $discountCoupons->orWhere('code', 'like', '%' . $request->get('keyword') . '%');
        }

        // Paginer les résultats par lot de 10 coupons par page
        $discountCoupons = $discountCoupons->paginate(10);

        // Renvoyer la vue de la liste des coupons avec les résultats paginés
        return view('admin.coupon.list', compact('discountCoupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }
    public function store(Request $request)
    {
        // Règles de validation pour les données de la requête entrante
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required', // Vérifiez la capitalisation de 'Status'
        ]);

        // Vérifie si la validation est réussie
        if ($validator->passes()) {
            if (!empty($request->starts_at)) {
                // Récupération de la date et heure actuelles
                $now = Carbon::now();
                // Création d'une instance Carbon à partir de la date de début fournie dans la requête
                $startAt = Carbon::parse($request->start_at);
                // Vérification si la date de début est ultérieure à la date et heure actuelles
                if ($startAt->lte($now) == true) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'La date de début ne peut pas être antérieure à la date et l\'heure actuelles']
                    ]);
                }
            }
            // Validation supplémentaire pour les dates de début et d'expiration
            if (!empty($request->starts_at) && !empty($request->expires_at)) {
                $expiresAt = Carbon::parse($request->expires_at);
                $startAt = Carbon::parse($request->start_at);
                // Vérifie si la date d'expiration est supérieure à la date de début
                if ($expiresAt->gt($startAt) == false) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'La date d\'expiration doit être postérieure à la date de début']
                    ]);
                }
            }

            // Crée une nouvelle instance de DiscountCoupon et définit ses propriétés
            $discountCode = new DiscountCoupon();
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->starts_at = $request->starts_at;
            $discountCode->expires_at = $request->expires_at;
            $discountCode->save(); // Enregistre le modèle DiscountCoupon

            $message = "Coupon de réduction ajouté avec succès.";
            session()->flash('success', $message); // Affiche un message de succès

            // Renvoie une réponse JSON en cas de succès
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            // Renvoie les erreurs de validation sous forme de JSON en cas d'échec de validation
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        // Trouver le coupon de réduction basé sur l'identifiant passé
        $coupon = DiscountCoupon::find($id);

        // Vérifier si le coupon n'existe pas
        if ($coupon == null) {
            // S'il n'existe pas, afficher un message d'erreur et rediriger vers la liste des coupons
            session()->flash('error', 'Record not found');
            return redirect()->route('coupons.index');
        }

        // Si le coupon existe, préparer les données pour la vue d'édition
        $data['coupon'] = $coupon;

        // Renvoyer la vue d'édition du coupon avec les données
        return view('admin.coupon.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Trouver le code de réduction basé sur l'identifiant
        $discountCode = DiscountCoupon::find($id);

        // Vérifier si le code de réduction est null (non trouvé)
        if ($discountCode == null) {
            // Si le code de réduction n'a pas été trouvé, définir un message d'erreur dans la session
            session()->flash('error', "Aucun Discount Trouvé");

            // Retourner une réponse JSON avec le statut true pour indiquer qu'aucun code n'a été trouvé
            return response()->json([
                'status' => true
            ]);
        }

        // Valider les données reçues dans la requête
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            // Vérifier si les dates de début et d'expiration sont définies et si la date d'expiration est postérieure à la date de début
            if (!empty($request->starts_at) && !empty($request->expires_at)) {
                $expiresAt = Carbon::parse($request->expires_at);
                $startAt = Carbon::parse($request->start_at);
                if ($expiresAt->gt($startAt) == false) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'La date d\'expiration doit être postérieure à la date de début']
                    ]);
                }
            }
            // Mettre à jour les propriétés du code de réduction avec les données de la requête
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->starts_at = $request->starts_at;
            $discountCode->expires_at = $request->expires_at;
            $discountCode->save();

            // Message de réussite pour la modification du coupon de réduction
            $message = "Coupon de réduction modifié avec succès.";
            session()->flash('success', $message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            // Retourner les erreurs de validation s'il y en a
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        // Trouver le code de réduction basé sur l'identifiant
        $discountCode = DiscountCoupon::find($id);

        // Vérifier si le code de réduction est null (non trouvé)
        if ($discountCode == null) {
            // Si le code de réduction n'a pas été trouvé, définir un message d'erreur dans la session
            session()->flash('error', "Aucun discount trouvé");

            // Retourner une réponse JSON avec le statut true pour indiquer qu'aucun code n'a été trouvé
            return response()->json([
                'status' => true
            ]);
        }
        // Supprimer le coupon de réduction spécifique
        $discountCode->delete();

        // Définir un message de succès dans la session pour indiquer que le coupon a été supprimé avec succès
        session()->flash('success', "Coupon de réduction supprimé avec succès");

        // Retourner une réponse JSON avec le statut true pour indiquer que la suppression s'est déroulée avec succès
        return response()->json([
            'status' => true // Indique que la suppression s'est déroulée avec succès
        ]);
    }
}
