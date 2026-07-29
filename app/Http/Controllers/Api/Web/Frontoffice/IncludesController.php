<?php
// Namespace du contrôleur pour le frontoffice API
namespace App\Http\Controllers\Api\Web\Frontoffice;
// Importation du contrôleur de base personnalisé
use App\Http\Controllers\Api\BaseController;
// Importation des modèles utilisés
use App\Models\Category;
use App\Models\NewsLetter;
use App\Models\Tag;
use App\Models\Publication;
use App\Models\SenderMessage;
use App\Models\Message;
// Importation des classes nécessaires pour la requête et la validation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
 
// Définition du contrôleur IncludesController
class IncludesController extends BaseController
{


    /**
     * Fonction utilitaire pour remplacer des chaînes de caractères
     *
     * @param mixed $search   Valeur(s) à rechercher
     * @param mixed $replace  Valeur(s) de remplacement
     * @param mixed $subject  Chaîne cible
     * @return string
     */
    public function str_replace_all($search, $replace, $subject)
    {
        // Utilisation de la fonction native PHP str_replace
        return str_replace($search, $replace, $subject);
    }

    /**
     * Récupère les publications de Togo Actualité
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function togoActualiteRequestData()
    {
        // Récupération des publications correspondant aux catégories définies
        $togoactualiteData = Publication::where("status", 1)
            ->whereIn("category_id", [35, 1, 2, 27, 34])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        // Vérification si aucune donnée n'est trouvée
        if ($togoactualiteData->isEmpty()) {
            return $this->sendError(
                'Aucune publication sur togoactualité n\'est publiée.',
                [],
                404
            );
        }

        // Retour de la réponse avec succès
        return $this->sendResponse(
            $togoactualiteData,
            'Publications de togoactualité récupérées'
        );
    }

    /**
     * Récupère les publications de la rubrique
     */
    public function rubriquesRequestData()
    {
        $rubriquesData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 28]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($rubriquesData->isEmpty()) {
            return $this->sendError('Aucune publication de rubriques trouvée', [], 404);
        }

        return $this->sendResponse($rubriquesData, 'Publications de rubriques récupérées');
    }

    /**
     * Récupère les publications de la diplomatie
     */
    public function diplomatieRequestData()
    {
        $diplomatieData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 11]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($diplomatieData->isEmpty()) {
            return $this->sendError('Aucune publication de diplomatie trouvée', [], 404);
        }

        return $this->sendResponse($diplomatieData, 'Publications de diplomatie récupérées');
    }

    /**
     * Récupère les publications de chroniques
     */
    public function chroniquesRequestData()
    {
        $chroniquesData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 5]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($chroniquesData->isEmpty()) {
            return $this->sendError('Aucune publication de chroniques trouvée', [], 404);
        }

        return $this->sendResponse($chroniquesData, 'Publications de chroniques récupérées');
    }

    /**
     * Récupère les publications économiques
     */
    public function economieRequestData()
    {
        $economieData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 12]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($economieData->isEmpty()) {
            return $this->sendError('Aucune publication de économie trouvée', [], 404);
        }

        return $this->sendResponse($economieData, 'Publications de économie récupérées');
    }

    /**
     * Récupère les publications de la diaspora
     */
    public function diasporaRequestData()
    {
        $diasporaData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 10]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($diasporaData->isEmpty()) {
            return $this->sendError('Aucune publication de diaspora trouvée', [], 404);
        }

        return $this->sendResponse($diasporaData, 'Publications de diaspora récupérées');
    }

    /**
     * Récupère les publications "Fenêtre sur l'Afrique"
     */
    public function fenetreSurLAfriqueRequestData()
    {
        $fenetreSurLAfriqueData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 16]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($fenetreSurLAfriqueData->isEmpty()) {
            return $this->sendError('Aucune publication de fenêtre sur l\'afrique trouvée', [], 404);
        }

        return $this->sendResponse($fenetreSurLAfriqueData, 'Publications de fenêtre sur l\'afrique récupérées');
    }

    /**
     * Récupère les publications internationales
     */
    public function internationalRequestData()
    {
        $internationalData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 20]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($internationalData->isEmpty()) {
            return $this->sendError('Aucune publication de international trouvée', [], 404);
        }

        return $this->sendResponse($internationalData, 'Publications de international récupérées');
    }

    /**
     * Récupère les publications du monde
     */
    public function mondeRequestData()
    {
        $mondeData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 24]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($mondeData->isEmpty()) {
            return $this->sendError('Aucune publication de monde trouvée', [], 404);
        }

        return $this->sendResponse($mondeData, 'Publications de monde récupérées');
    }

    /**
     * Récupère les publications africaines
     */
    public function afriqueRequestData()
    {
        $afriqueData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 3]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($afriqueData->isEmpty()) {
            return $this->sendError('Aucune publication de afrique trouvée', [], 404);
        }

        return $this->sendResponse($afriqueData, 'Publications de afrique récupérées');
    }

    /**
     * Récupère les publications sportives
     */
    public function sportsRequestData()
    {
        $sportsData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 31]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($sportsData->isEmpty()) {
            return $this->sendError('Aucune publication de sports trouvée', [], 404);
        }

        return $this->sendResponse($sportsData, 'Publications de sports récupérées');
    }

    /**
     * Récupère les publications CAN
     */
    public function canRequestData()
    {
        $canData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 4]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($canData->isEmpty()) {
            return $this->sendError('Aucune publication de can trouvée', [], 404);
        }

        return $this->sendResponse($canData, 'Publications de can récupérées');
    }

    /**
     * Récupère les publications du Togo
     */
    public function togoRequestData()
    {
        $togoData = Publication::where([
            ["status", 1],
            ["type_publication_id", 1],
            ["category_id", 34]
        ])
            ->latest('date_publish')
            ->take(4)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "image_cover_url"
            ]);

        if ($togoData->isEmpty()) {
            return $this->sendError('Aucune publication de togo trouvée', [], 404);
        }

        return $this->sendResponse($togoData, 'Publications de togo récupérées');
    }

    /**
     * Enregistrement d'un email pour la newsletter
     */
    public function newsletterStoreRequest(Request $request)
    {
        // Validation des données envoyées
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255', 'unique:news_letters,email'],
        ], [
            'email.required' => 'Votre email est obligatoire.',
            'email.email' => 'Veuillez entrer un email valide.',
            'email.unique' => 'Cet email est déjà enregistré.',    
        ]);

        // Si validation échoue
        if ($validator->fails()) {
            return $this->sendError(
                'Erreur de validation',
                $validator->errors(),
                422
            );
        }

         // 🛡️ HONEYPOT (champ caché pour bots)
        if (!empty($request->input('website'))) {
            return $this->sendError('Bot détecté', [], 403);
        }

        // 🛡️ ANTI BOT - User Agent
        $userAgent = $request->header('User-Agent');
        if (preg_match('/bot|crawl|spider|curl|wget|python/i', $userAgent)) {
            return $this->sendError('Bot détecté', [], 403);
        }

        // 🛡️ ANTI BOT - temps humain
        $formTime = (int) $request->input('form_time');
        if ((time() - $formTime) < 1) {
            return $this->sendError('Action trop rapide détectée.', [], 422);
        }

        // Création de l'entrée newsletter
        $newsletter = NewsLetter::create([
            'email' => $request->email,
            'slug' => Str::slug($request->email),
        ]);

        // Vérifie si la création a échoué
        if (!$newsletter) {
            return $this->sendError(
                'Impossible d\'enregistrer cet email.',
                [],
                500
            );
        }

        // Retour succès
        return $this->sendResponse(
            $newsletter,
            'Email enregistré avec succès.'
        );
    }

    /**
     * Récupère les tags populaires
     */
    public function tagsRequestData()
    {
        $tags = Tag::orderByDesc('count_publications')
            ->take(20)
            ->get();

        if ($tags->isEmpty()) {
            return $this->sendError(
                'Aucun mot clé disponible.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $tags,
            'Liste des mots clés populaires'
        );
    }

    /**
     * Récupère les catégories populaires
     */
    public function categoryRequestData()
    {
        $categories = Category::orderByDesc('count_publications')
            ->take(8)
            ->get();

        if ($categories->isEmpty()) {
            return $this->sendError(
                'Aucune catégorie disponible.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $categories,
            'Liste des catégories populaires'
        );
    }

    /**
     * Récupère les publications populaires récentes
     */
    public function publicationsRequestData()
    {
        $publications = Publication::where([
            ['status', 1],
            ['type_publication_id', 1],
        ])
            ->whereDate('date_publish', '>', '2025-12-31') // Filtre sur les publications après cette date
            ->orderByDesc('views_count') // Tri par nombre de vues décroissant
            ->take(2)
            ->get([
                "id",
                "content",
                "truncate_content",
                "title",
                "slug",
                "date_publish",
                "author_name",
                "author_slug",
                "category_name",
                "category_slug",
                "image_cover_url"
            ]);

        if ($publications->isEmpty()) {
            return $this->sendError(
                'Aucune publication populaire trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $publications,
            'Liste des publications populaires'
        );
    }
}