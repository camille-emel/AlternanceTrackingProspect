<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EntrepriseController extends Controller
{
    private const ENTREPRISE_API = 'https://recherche-entreprises.api.gouv.fr/search';
    private const ALTERNANCE_API = 'https://labonnealternance.apprentissage.beta.gouv.fr/api/v1/jobs';

    public function index()
    {
        return view('home');
    }

    public function showSearchForm(Request $request)
    {
        $type = $request->query('type', 'entreprise');
        return view('search.form', ['type' => $type]);
    }

    public function search(Request $request)
    {
        \Log::info('Recherche démarrée', $request->all());

        // Validation des paramètres
        $validated = $request->validate([
            'type' => 'required|in:entreprise,alternance',
            'code_postal' => 'nullable|regex:/^[0-9]{5}$/',
            'activite_principale' => 'nullable|regex:/^[0-9]{2}\.[0-9]{2}[A-Z]$/',
            'radius' => 'nullable|integer|between:1,100',
        ]);

        try {
            $results = [];
            if ($validated['type'] === 'entreprise') {
                $results = $this->searchEntreprises($validated);
            } else {
                $results = $this->searchAlternances($validated);
            }

            return view('results', [
                'results' => $results['results'],
                'total' => $results['total'],
                'type' => $validated['type']
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur lors de la recherche', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la recherche.']);
        }
    }

    private function searchEntreprises($validated)
    {
        $client = new Client(['verify' => false]);
        
        $queryParams = array_filter([
            'code_postal' => $validated['code_postal'] ?? null,
            'activite_principale' => $validated['activite_principale'] ?? null,
            'radius' => $validated['radius'] ?? null,
            'etat_administratif' => 'A',
            'est_siege' => true,
            'page' => 1,
            'per_page' => 20,
        ]);

        $response = $client->get(self::ENTREPRISE_API, ['query' => $queryParams]);
        $data = json_decode($response->getBody(), true);

        $filteredResults = array_filter($data['results'] ?? [], function($result) use ($validated) {
            return 
                (!isset($validated['code_postal']) || $result['siege']['code_postal'] === $validated['code_postal']) &&
                (!isset($validated['activite_principale']) || $result['siege']['activite_principale'] === $validated['activite_principale']);
        });

        return [
            'results' => array_values($filteredResults),
            'total' => count($filteredResults)
        ];
    }

    private function searchAlternances($validated)
    {
        $client = new Client(['verify' => false]);
        
        $queryParams = array_filter([
            'zipcode' => $validated['code_postal'] ?? null,
            'radius' => $validated['radius'] ?? 10,
            'page' => 1,
            'limit' => 20,
        ]);

        $response = $client->get(self::ALTERNANCE_API, ['query' => $queryParams]);
        $data = json_decode($response->getBody(), true);

        return [
            'results' => $data['results'] ?? [],
            'total' => $data['total'] ?? 0
        ];
    }
}