<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'entreprises</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Recherche d'entreprises</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('search') }}" method="GET" class="mb-4">
        <div class="row g-3">
            <!-- Département -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="departement" class="form-label">Département :</label>
                    <input type="text" 
                           class="form-control" 
                           id="departement" 
                           name="departement" 
                           placeholder="Ex : 75" 
                           value="{{ old('departement') }}"
                           maxlength="3">
                    <small class="text-muted">Numéro du département (2 ou 3 chiffres)</small>
                </div>
            </div>

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

            <!-- Code NAF -->
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

            <!-- Rayon de recherche -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="radius" class="form-label">Rayon de recherche (km) :</label>
                    <input type="number" 
                           class="form-control" 
                           id="radius" 
                           name="radius" 
                           min="1" 
                           max="100" 
                           value="{{ old('radius') }}">
                    <small class="text-muted">Optionnel - De base 5 km et 50 km MAX</small>
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
                <strong>Département :</strong> Entrez le numéro du département (ex: 75 pour Paris)<br>
                <strong>Code postal :</strong> Code postal complet sur 5 chiffres<br>
                <strong>Code NAF :</strong> Format XX.XXX ou XX.XXZ (ex: 62.01Z pour Programmation informatique)<br>
                <strong>Rayon :</strong> Distance de recherche autour du code postal (en kilomètres)
            </p>
        </div>
    </div>
</body>
</html>