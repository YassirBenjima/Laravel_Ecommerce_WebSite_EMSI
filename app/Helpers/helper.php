<?php

use App\Models\Category;

function getCategories()
{
    // Récupérer toutes les catégories actives configurées pour s'afficher sur la page d'accueil
    return Category::orderBy('name', 'ASC') // Ordonner les catégories par nom dans l'ordre croissant
        ->with('sub_category') // Charger de manière anticipée (eager load) les sous-catégories pour chaque catégorie
        ->where('status', 1) // Ne récupérer que les catégories actives (statut = 1)
        ->where('showHome', 'Yes') // Ne récupérer que les catégories configurées pour s'afficher sur la page d'accueil (showHome = 'Yes')
        ->get(); // Obtenir la collection de catégories correspondante
}
