<?php
// Déclaration du namespace correspondant à l'organisation des contrôleurs API Frontoffice
namespace App\Http\Controllers\Api\Web\Frontoffice;
// Importation du contrôleur de base personnalisé
use App\Http\Controllers\Api\BaseController;
// Importation des modèles nécessaires
use App\Models\Category;
use App\Models\Publication;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;


// Définition du contrôleur HomeController qui hérite de BaseController
class HomeController extends BaseController
{
    /**
     * Méthode principale pour afficher la page d'accueil
     *
     * @return \Illuminate\View\View
     */
   
    /**
     * Affiche la page d'accueil.
     *
     * La méthode :
     *
     * 1. Vérifie l'existence de publications actives.
     * 2. Récupère les publications récentes.
     * 3. Charge les relations nécessaires.
     * 4. Met les résultats en cache pendant 10 minutes.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        /*
    |--------------------------------------------------------------------------
    | Vérification de l'existence des publications actives
    |--------------------------------------------------------------------------
    |
    | exists() est plus performant que get() ou count()
    | lorsqu'on souhaite uniquement savoir si des données existent.
    |
    | Cette vérification est également mise en cache.
    |
    */
        $hasPublications = Cache::remember(
            'home_has_active_publications_a_la_une',
            now()->addMinutes(10),
            function () {
                return Publication::query()
                    ->where('status', 1)
                    ->exists();
            }
        );

        /*
    |--------------------------------------------------------------------------
    | Aucune publication active
    |--------------------------------------------------------------------------
    */
        if (!$hasPublications) {
            return view('errors.HomePageControlEmpty');
        }

        /*
    |--------------------------------------------------------------------------
    | Récupération des publications de la page d'accueil
    |--------------------------------------------------------------------------
    |
    | Seules les publications :
    |
    | - actives
    | - de type publication ID 1
    |
    | sont récupérées.
    |
    | Les relations sont chargées en avance afin d'éviter
    | le problème N+1.
    |
    */
        $alaUne = Cache::remember(
            'home_ala_une_publications',
            now()->addMinutes(10),
            function () {

                return Publication::query()

                    /*
                |--------------------------------------------------------------------------
                | Publication active
                |--------------------------------------------------------------------------
                */
                    ->where('status', 1)

                    /*
                |--------------------------------------------------------------------------
                | Type de publication
                |
                | ID 1 = Articles
                |--------------------------------------------------------------------------
                */
                    ->where('type_publication_id', 1)

                    /*
                |--------------------------------------------------------------------------
                | Chargement des relations
                |--------------------------------------------------------------------------
                */
                    ->with([

                        /*
                     * Auteur de la publication.
                     */
                        'author:id,name,slug',

                        /*
                     * Catégories de la publication.
                     *
                     * Une publication peut appartenir
                     * à plusieurs catégories.
                     */
                        'categories:id,name,slug',

                        /*
                     * Média utilisé comme image de couverture.
                     */
                        'coverMediaFile:id,file_name,file_slug,file_url',
                    ])

                    /*
                |--------------------------------------------------------------------------
                | Trier par date de publication
                |--------------------------------------------------------------------------
                */
                    ->latest('date_publish')

                    /*
                |--------------------------------------------------------------------------
                | Limiter à 13 publications
                |--------------------------------------------------------------------------
                */
                    ->take(13)

                    /*
                |--------------------------------------------------------------------------
                | Exécution de la requête
                |--------------------------------------------------------------------------
                */
                    ->get();
            }
        );

        /*
    |--------------------------------------------------------------------------
    | Retour de la vue
    |--------------------------------------------------------------------------
    */
        return view(
            'welcome',
            compact('alaUne')
        );
    }
}
