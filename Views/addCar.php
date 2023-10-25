<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/CRUD/style.css">
    <title>Ajout de Voiture</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <form action="./Task.php?action=add_car" method="post" class="text-center mt-5" enctype="multipart/form-data">
        <h2 class="mb-4">Ajouter une voiture</h2>
        <div class="form-group">
            <input type="text" class="form-control" name="marque" placeholder="Marque" required value="<?= isset($_POST['marque']) ? $_POST['marque'] : '' ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="modele" placeholder="Modèle" required value="<?= isset($_POST['modele']) ? $_POST['modele'] : '' ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="couleur" placeholder="Couleur" required value="<?= isset($_POST['couleur']) ? $_POST['couleur'] : '' ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="prix_location" placeholder="prix_location" required value="<?= isset($_POST['prix_location']) ? $_POST['prix_location'] : '' ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="action" placeholder="Action" required value="<?= isset($_POST['action']) ? $_POST['action'] : '' ?>">
        </div>
        
                <div class='form-group'>
            <input type="file" class="btn btn-dark" name="file[]" multiple>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-info" name="add_car">
                Ajouter
            </button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script src="/js/scripts.js"></script>
</body>

</html>
