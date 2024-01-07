<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class TempImagesController extends Controller
{
    public function create(Request $request)
    {
        // Récupération de l'image depuis la requête
        $image = $request->image;

        // Vérification si une image a été envoyée
        if (!empty($image)) {
            // Récupération de l'extension de l'image et création d'un nouveau nom de fichier basé sur le timestamp
            $ext = $image->getClientOriginalExtension();
            $newName = time() . '.' . $ext;

            // Création d'une nouvelle instance de TempImage et sauvegarde du nom de l'image dans la base de données temporaire
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            // Déplacement de l'image téléchargée vers le répertoire temporaire
            $image->move(public_path() . '/temp', $newName);

            // Création d'une miniature (thumbnail) de l'image pour affichage
            $sourcePath = public_path() . '/temp/' . $newName;
            $destPath = public_path() . '/temp/thumb/' . $newName;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($sourcePath);
            $image->resize(300, 275);
            $image->toPng()->save($destPath);

            // Retourne une réponse JSON avec des informations sur l'image téléchargée
            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('/temp/thumb/' . $newName),
                'message' => 'Image téléchargée avec succès'
            ]);
        }
    }
}
