<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/CRUD/style.css">
    <title>Ajout</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <form action="./Task.php?action=register" method="post" class="text-center mt-5" enctype="multipart/form-data">
        <h2 class="mb-4">Ajouter un Utilisateur</h2>
        <div class="form-group">
          <input type="text" class="form-control" name="Nom" placeholder="Nom" required value="<?= isset($_POST['Nom']) ? $_POST['Nom'] : '' ?>">
           
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="Prenom" placeholder="Prenom" required value="<?= isset($_POST['Prenom']) ? $_POST['Prenom'] : '' ?>">
           
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email" required value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
          
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" required placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="role" required placeholder="Role">
        </div>
       <div class='form-group'>
          <input type="file" class="btn btn-dark" name="photo_profil" > 
       </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-info" name="signup">
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
