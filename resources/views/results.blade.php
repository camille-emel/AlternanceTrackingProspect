<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Résultats de la recherche</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">Nouvelle recherche</a>
    </div>

    <div class="alert alert-info">
        {{ $total }} entreprise(s) trouvée(s)
    </div>

    @foreach($results as $result)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $result['nom_complet'] }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Adresse :</strong> {{ $result['siege']['adresse'] }}</p>
                        <p class="mb-1"><strong>Code postal :</strong> {{ $result['siege']['code_postal'] }}</p>
                        <p class="mb-1"><strong>Ville :</strong> {{ $result['siege']['libelle_commune'] }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>SIREN :</strong> {{ $result['siren'] }}</p>
                        <p class="mb-1"><strong>Code NAF :</strong> {{ $result['siege']['activite_principale'] }}</p>
                        <p class="mb-1"><strong>État :</strong> {{ $result['siege']['etat_administratif'] === 'A' ? 'Actif' : 'Fermé' }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if($total === 0)
        <div class="alert alert-warning">
            Aucune entreprise ne correspond à vos critères de recherche.
        </div>
    @endif
</body>
</html>