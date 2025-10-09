<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Models\Evaluation;
use App\Models\Evoluation;
use App\Models\Note;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showResults(Request $request)
    {
        // Get the query and category from the request
        $query = $request->input('query');
        $category = $request->input('category');

        // Perform the search logic based on the query and category
        $results = $this->performSearch($query, $category);

        // Filter out the excluded categories
        $excludedCategories = ['emplois', 'classes'];

        // Check if $results is not null before filtering
        if ($results !== null) {
            $filteredResults = $results->whereNotIn('category', $excludedCategories);
        } else {
            $filteredResults = collect(); // Create an empty collection
        }

        // Return the view with the search results
        return view('search', [
            'results' => $filteredResults,
            'query' => $query,
            'category' => $category,
        ]);
    }

    private function performSearch($query, $category)
    {
        // Perform the actual search logic based on the query and category
        // Replace this with your custom search implementation

        // Example: Perform a database query using Laravel Eloquent
        $results = null;
        if ($category === 'etudiant') {
            $results = Etudiant::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nom', 'like', "%$query%")
                    ->orWhere('prenom', 'like', "%$query%")
                    ->orWhere('id_etudiant', 'like', "%$query%")
                    ->orWhere('telephone', 'like', "%$query%")
                    ->orWhere('date_naissance', 'like', "%$query%")
                    ->orWhere('adresse', 'like', "%$query%")->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                        $subQueryBuilder->where('niveau', 'like', "%$query%");
                    });
            })->with('classe')->get();
        } elseif ($category === 'enseignant') {
            $results = Enseignant::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nom', 'like', "%$query%")
                    ->orWhere('id_enseignant', 'like', "%$query%")
                    ->orWhere('telephone', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('matiere', 'like', "%$query%")
                    ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                        $subQueryBuilder->where('niveau', 'like', "%$query%");
                    });
            })->with('classe')->get();
        } elseif ($category === 'note') {
            $results = Note::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('note', 'like', "%$query%")
                    ->orWhere('type', 'like', "%$query%")
                    ->orWhere('notes.id_etudiant', 'like', "%$query%")
                    ->orWhere('matiere', 'like', "%$query%")
                    ->orWhereHas('etudiants', function ($subQueryBuilder) use ($query) {
                        $subQueryBuilder->where('nom', 'like', "%$query%");
                    });
            })->with('etudiants')->get();
        } elseif ($category === 'course') {
            $results = Cours::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('jour', 'like', "%$query%")
                    ->orWhere('date_debut', 'like', "%$query%")
                    ->orWhere('date_fin', 'like', "%$query%")
                    ->orWhere('academic.cours.id_classe', 'like', "%$query%")
                    ->orWhere('matiere', 'like', "%$query%")
                    ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                        $subQueryBuilder->where('niveau', 'like', "%$query%");
                    });
            })->with('classe')->get();
        } elseif ($category === 'evaluation') {
            $results = Evoluation::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('date', 'like', "%$query%")
                    ->orWhere('type', 'like', "%$query%")
                    ->orWhere('date_debut', 'like', "%$query%")
                    ->orWhere('date_fin', 'like', "%$query%")
                    ->orWhereHas('classe', function ($subQueryBuilder) use ($query) {
                        $subQueryBuilder->where('niveau', 'like', "%$query%");
                    })
                    ->orWhere('matiere', 'like', "%$query%");
            })->with('classe')->get();
        }

        return $results;
    }
}
