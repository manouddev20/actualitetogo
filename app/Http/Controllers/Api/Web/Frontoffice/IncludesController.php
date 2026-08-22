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
// Importation des classes nécessaires pour la requête et la validation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

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

        
        $togoactualiteData = Cache::remember(
            'togoactualite_publications_header',
            now()->addMinutes(10),
            function () {

                return Publication::query()
                    ->where('status', 1)
                    ->where('type_publication_id', 1)

                    /*
                |--------------------------------------------------------------------------
                | Filtrer les publications appartenant aux catégories
                |--------------------------------------------------------------------------
                */

                    ->whereHas('categories', function ($query) {
                        $query->whereIn('categories.id', [
                            35,
                            1,
                            2,
                            27,
                            34,
                        ]);
                    })

                    /*
                |--------------------------------------------------------------------------
                | Relations nécessaires
                |--------------------------------------------------------------------------
                */

                    ->with([
                        'author:id,name,slug',
                        'coverMediaFile:id,file_name,file_url,file_slug',
                    ])

                    ->latest('date_publish')

                    ->take(4)

                    ->get([
                        'id',
                        'author_id',
                        'cover_media_file_id',
                        'content',
                        'truncate_content',
                        'title',
                        'slug',
                        'date_publish',
                    ])->toArray();
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Vérification si aucune publication n'est trouvée
        |--------------------------------------------------------------------------
        */

        if (empty($togoactualiteData)) {
            return $this->sendError(
                'Aucune publication sur Togo Actualité n\'est publiée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $togoactualiteData,
            'Publications de Togo Actualité récupérées avec succès.'
        );
    }

    /**
     * Relation utilisée pour toutes les requêtes :
     *
     * - Publication active.
     * - Type de publication = Article (ID 1).
     * - Filtrage via la relation many-to-many categories().
     * - Chargement de l'auteur.
     * - Chargement du média de couverture.
     */
    private function getCategoryPublications(int $categoryId, string $cacheKey)
    {
        
       

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(10),
            function () use ($categoryId) {
                return Publication::query()
                    ->where('status', 1)
                    ->where('type_publication_id', 1)

                    /*
                |--------------------------------------------------------------------------
                | Filtrage par catégorie
                |--------------------------------------------------------------------------
                |
                | On utilise categories.id et non publications.category_id,
                | car la relation est maintenant many-to-many.
                |
                */
                    ->whereHas('categories', function ($query) use ($categoryId) {
                        $query->where('categories.id', $categoryId);
                    })

                    /*
                |--------------------------------------------------------------------------
                | Relations
                |--------------------------------------------------------------------------
                */
                    ->with([
                        'author:id,name,slug',
                        'coverMediaFile:id,file_name,file_slug,file_url',
                    ])

                    /*
                |--------------------------------------------------------------------------
                | Dernières publications
                |--------------------------------------------------------------------------
                */
                    ->latest('date_publish')
                    ->take(4)

                    /*
                |--------------------------------------------------------------------------
                | Champs nécessaires
                |--------------------------------------------------------------------------
                */
                    ->get([
                        'id',
                        'author_id',
                        'cover_media_file_id',
                        'content',
                        'truncate_content',
                        'title',
                        'slug',
                        'date_publish',
                    ])->toArray();
            }
        );
    }


    /**
     * Récupère les publications de la rubrique.
     *
     * Identifiant de catégorie conservé : 28
     */
    public function rubriquesRequestData()
    {
        $rubriquesData = $this->getCategoryPublications(
            28,
            'rubriques_publications_header'
        );

        if (empty($rubriquesData)) {
            return $this->sendError(
                'Aucune publication de rubriques trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $rubriquesData,
            'Publications de rubriques récupérées.'
        );
    }


    /**
     * Récupère les publications de la diplomatie.
     *
     * Identifiant de catégorie conservé : 11
     */
    public function diplomatieRequestData()
    {
        $diplomatieData = $this->getCategoryPublications(
            11,
            'diplomatie_publications_header'
        );

        if (empty($diplomatieData)) {
            return $this->sendError(
                'Aucune publication de diplomatie trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $diplomatieData,
            'Publications de diplomatie récupérées.'
        );
    }


    /**
     * Récupère les publications de chroniques.
     *
     * Identifiant de catégorie conservé : 5
     */
    public function chroniquesRequestData()
    {
        $chroniquesData = $this->getCategoryPublications(
            5,
            'chroniques_publications_header'
        );

        if (empty($chroniquesData)) {
            return $this->sendError(
                'Aucune publication de chroniques trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $chroniquesData,
            'Publications de chroniques récupérées.'
        );
    }


    /**
     * Récupère les publications économiques.
     *
     * Identifiant de catégorie conservé : 12
     */
    public function economieRequestData()
    {
        $economieData = $this->getCategoryPublications(
            12,
            'economie_publications_header'
        );

        if (empty($economieData)) {
            return $this->sendError(
                'Aucune publication économique trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $economieData,
            'Publications économiques récupérées.'
        );
    }


    /**
     * Récupère les publications de la diaspora.
     *
     * Identifiant de catégorie conservé : 10
     */
    public function diasporaRequestData()
    {
        $diasporaData = $this->getCategoryPublications(
            10,
            'diaspora_publications_header'
        );

        if (empty($diasporaData)) {
            return $this->sendError(
                'Aucune publication de la diaspora trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $diasporaData,
            'Publications de la diaspora récupérées.'
        );
    }


    /**
     * Récupère les publications "Fenêtre sur l'Afrique".
     *
     * Identifiant de catégorie conservé : 16
     */
    public function fenetreSurLAfriqueRequestData()
    {
        $fenetreSurLAfriqueData = $this->getCategoryPublications(
            16,
            'fenetre_sur_l_afrique_publications_header'
        );

        if (empty($fenetreSurLAfriqueData)) {
            return $this->sendError(
                'Aucune publication de Fenêtre sur l’Afrique trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $fenetreSurLAfriqueData,
            'Publications de Fenêtre sur l’Afrique récupérées.'
        );
    }


    /**
     * Récupère les publications internationales.
     *
     * Identifiant de catégorie conservé : 20
     */
    public function internationalRequestData()
    {
        $internationalData = $this->getCategoryPublications(
            20,
            'international_publications_header'
        );

        if (empty($internationalData)) {
            return $this->sendError(
                'Aucune publication internationale trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $internationalData,
            'Publications internationales récupérées.'
        );
    }


    /**
     * Récupère les publications du monde.
     *
     * Identifiant de catégorie conservé : 24
     */
    public function mondeRequestData()
    {
        $mondeData = $this->getCategoryPublications(
            24,
            'monde_publications_header'
        );

        if (empty($mondeData)) {
            return $this->sendError(
                'Aucune publication du monde trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $mondeData,
            'Publications du monde récupérées.'
        );
    }


    /**
     * Récupère les publications africaines.
     *
     * Identifiant de catégorie conservé : 3
     */
    public function afriqueRequestData()
    {
        $afriqueData = $this->getCategoryPublications(
            3,
            'afrique_publications_header'
        );

        if (empty($afriqueData)) {
            return $this->sendError(
                'Aucune publication africaine trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $afriqueData,
            'Publications africaines récupérées.'
        );
    }


    /**
     * Récupère les publications sportives.
     *
     * Identifiant de catégorie conservé : 31
     */
    public function sportsRequestData()
    {
        $sportsData = $this->getCategoryPublications(
            31,
            'sports_publications_header'
        );

        if (empty($sportsData)) {
            return $this->sendError(
                'Aucune publication sportive trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $sportsData,
            'Publications sportives récupérées.'
        );
    }


    /**
     * Récupère les publications CAN.
     *
     * Identifiant de catégorie conservé : 4
     */
    public function canRequestData()
    {
        $canData = $this->getCategoryPublications(
            4,
            'can_publications_header'
        );

        if (empty($canData)) {
            return $this->sendError(
                'Aucune publication CAN trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $canData,
            'Publications CAN récupérées.'
        );
    }


    /**
     * Récupère les publications du Togo.
     *
     * Identifiant de catégorie conservé : 34
     */
    public function togoRequestData()
    {
        $togoData = $this->getCategoryPublications(
            34,
            'togo_publications_header'
        );

        if (empty($togoData)) {
            return $this->sendError(
                'Aucune publication du Togo trouvée.',
                [],
                404
            );
        }

        return $this->sendResponse(
            $togoData,
            'Publications du Togo récupérées.'
        );
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
            'Email enregistré.'
        );
    }
   /**
 * Récupère les tags les plus populaires.
 *
 * Le nombre de publications est calculé dynamiquement
 * à partir de la relation entre les tags et les publications.
 *
 * Les résultats sont mis en cache pendant 10 minutes.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function tagsRequestData()
{
    $tags = Cache::remember(
        'popular_tags_footer',
        now()->addMinutes(10),
        function () {
            return Tag::query()

                /*
                |--------------------------------------------------------------------------
                | Compter les publications liées à chaque tag
                |--------------------------------------------------------------------------
                */
                ->withCount('publications')

                /*
                |--------------------------------------------------------------------------
                | Trier les tags selon le nombre de publications
                |--------------------------------------------------------------------------
                */
                ->orderByDesc('publications_count')

                /*
                |--------------------------------------------------------------------------
                | Limiter aux 10 tags les plus populaires
                |--------------------------------------------------------------------------
                */
                ->take(10)

                /*
                |--------------------------------------------------------------------------
                | Champs nécessaires
                |--------------------------------------------------------------------------
                |
                | publications_count est ajouté automatiquement
                | par withCount('publications').
                |--------------------------------------------------------------------------
                */
                ->get([
                    'id',
                    'name',
                    'slug',
                ])->toArray();
        }
    );

    /*
    |--------------------------------------------------------------------------
    | Vérification de l'existence des tags
    |--------------------------------------------------------------------------
    */
    if (empty($tags)) {
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
     * Récupère les catégories les plus populaires.
     *
     * Les catégories sont classées selon le nombre de publications
     * auxquelles elles sont associées.
     *
     * Les résultats sont mis en cache pendant 10 minutes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryRequestData()
    {
        Cache::forget('popular_categories_footer');
        $categories = Cache::remember(
            'popular_categories_footer',
            now()->addMinutes(10),
            function () {

                return Category::query()
                 ->withCount('publications')
                    /*
                |--------------------------------------------------------------------------
                | Trier les catégories par nombre de publications
                |--------------------------------------------------------------------------
                */
                    ->orderByDesc('publications_count')

                    /*
                |--------------------------------------------------------------------------
                | Limiter la liste aux 8 catégories les plus populaires
                |--------------------------------------------------------------------------
                */
                    ->take(8)


                    /*
                |--------------------------------------------------------------------------
                | Sélectionner uniquement les données nécessaires
                |--------------------------------------------------------------------------
                */
                    ->get([
                        'id',
                        'name',
                        'slug',
                        'publications_count',
                    ])->toArray();
            }
        );

        /*
    |--------------------------------------------------------------------------
    | Vérification de l'existence des catégories
    |--------------------------------------------------------------------------
    */
        if (empty($categories)) {
            return $this->sendError(
                'Aucune catégorie disponible.',
                [],
                404
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Retour de la réponse
    |--------------------------------------------------------------------------
    */
        return $this->sendResponse(
            $categories,
            'Liste des catégories populaires'
        );
    }


    /**
     * Récupère les publications populaires et récentes.
     *
     * La sélection respecte les critères suivants :
     *
     * - Publication active.
     * - Type de publication : article.
     * - Date de publication postérieure au 31 décembre 2025.
     * - Classement selon le nombre de vues.
     * - Récupération des relations auteur, catégories et image
     *   de couverture.
     *
     * Les résultats sont mis en cache pendant 10 minutes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publicationsRequestData()
    {
        Cache::forget('popular_publications_footer');
        $publications = Cache::remember(
            'popular_publications_footer',
            now()->addMinutes(10),
            function () {

                return Publication::query()

                    /*
                |--------------------------------------------------------------------------
                | Récupérer uniquement les publications actives
                |--------------------------------------------------------------------------
                */
                    ->where('status', 1)

                    /*
                |--------------------------------------------------------------------------
                | Récupérer uniquement les publications de type Article
                |
                | ID = 1
                |--------------------------------------------------------------------------
                */
                    ->where('type_publication_id', 1)

                    /*
                |--------------------------------------------------------------------------
                | Récupérer uniquement les publications récentes
                |--------------------------------------------------------------------------
                */
                    ->whereDate(
                        'date_publish',
                        '>',
                        '2026-04-31'
                    )

                    /*
                |--------------------------------------------------------------------------
                | Charger les relations
                |--------------------------------------------------------------------------
                |
                | author :
                |   Informations de l'auteur de la publication.
                |
                | categories :
                |   Une publication peut appartenir à plusieurs catégories.
                |
                | coverMediaFile :
                |   Média utilisé comme image de couverture.
                |--------------------------------------------------------------------------
                */
                    ->with([
                        'author:id,name,slug',

                        'categories:id,name,slug',

                        'coverMediaFile:id,file_name,file_slug,file_url',
                    ])

                    /*
                |--------------------------------------------------------------------------
                | Trier par nombre de vues décroissant
                |--------------------------------------------------------------------------
                */
                    ->orderByDesc('views_count')

                    /*
                |--------------------------------------------------------------------------
                | Récupérer les 2 publications les plus populaires
                |--------------------------------------------------------------------------
                */
                    ->take(2)

                    /*
                |--------------------------------------------------------------------------
                | Sélectionner les champs nécessaires
                |--------------------------------------------------------------------------
                */
                    ->get([
                        'id',

                        /*
                     * Relations
                     */
                        'author_id',
                        'cover_media_file_id',

                        /*
                     * Contenu
                     */
                        'content',
                        'truncate_content',
                        'title_truncate',
                        'title',
                        'slug',

                        /*
                     * Statistiques
                     */
                        'views_count',

                        /*
                     * Date de publication
                     */
                        'date_publish',
                    ])->toArray();
            }
        );

        /*
    |--------------------------------------------------------------------------
    | Vérification de l'existence des publications
    |--------------------------------------------------------------------------
    */
        if (empty($publications)) {
            return $this->sendError(
                'Aucune publication populaire trouvée.',
                [],
                404
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Retour de la réponse avec succès
    |--------------------------------------------------------------------------
    */
        return $this->sendResponse(
            $publications,
            'Liste des publications populaires'
        );
    }
}
