<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'entreprise' ? 'Recherche d\'entreprises' : 'Recherche d\'alternances' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $type === 'entreprise' ? 'Recherche d\'entreprises' : 'Recherche d\'alternances' }}</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">Retour à l'accueil</a>
    </div>
    
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('search.results') }}" method="GET" class="mb-4">
        <input type="hidden" name="type" value="{{ $type }}">
        
        <div class="row g-3">
            <!-- Code postal -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="code_postal" class="form-label">Code postal :</label>
                    <input type="text" 
                           class="form-control" 
                           id="code_postal" 
                           name="code_postal" 
                           placeholder="Ex : 75001" 
                           value="{{ old('code_postal') }}"
                           maxlength="5">
                </div>
            </div>

            <!-- Code NAF (uniquement pour la recherche d'entreprises) -->
            @if($type === 'entreprise')
            <div class="col-md-4">
                <div class="form-group">
                    <label for="activite_principale" class="form-label">Code NAF :</label>
                    <input type="text" 
                           class="form-control" 
                           id="activite_principale" 
                           name="activite_principale" 
                           placeholder="Ex : 62.01Z" 
                           value="{{ old('activite_principale') }}"
                           maxlength="6">
                </div>
            </div>
            @endif

            <!-- Rayon -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="radius" class="form-label">Rayon (km) :</label>
                    <input type="number" 
                           class="form-control" 
                           id="radius" 
                           name="radius" 
                           min="1" 
                           max="100" 
                           value="{{ old('radius', 10) }}">
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Aide à la recherche</h5>
            <p class="card-text">
                <strong>Code postal :</strong> Code postal sur 5 chiffres<br>
                @if($type === 'entreprise')
                <strong>Code NAF :</strong> Format XX.XXZ (ex: 62.01Z pour Programmation informatique)<br>
                @endif
                <strong>Rayon :</strong> Distance de recherche en kilomètres (1-100)
            </p>
        </div>
    </div>
</body>
</html> 