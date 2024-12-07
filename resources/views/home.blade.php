<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Recherche d'entreprises et alternances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <div class="text-center my-5">
        <h1 class="display-4 mb-4">Bienvenue sur notre plateforme de recherche</h1>
        <p class="lead mb-5">Choisissez le type de recherche que vous souhaitez effectuer</p>

        <div class="row justify-content-center g-4">
            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Recherche d'entreprises</h5>
                        <p class="card-text">Trouvez des entreprises par localisation et secteur d'activité</p>
                        <a href="{{ route('search.form', ['type' => 'entreprise']) }}" class="btn btn-primary">
                            Rechercher des entreprises
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Recherche d'alternances</h5>
                        <p class="card-text">Trouvez des offres d'alternance près de chez vous</p>
                        <a href="{{ route('search.form', ['type' => 'alternance']) }}" class="btn btn-primary">
                            Rechercher des alternances
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 