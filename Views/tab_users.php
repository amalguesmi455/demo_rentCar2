

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste utilisateurs Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  

  </head>

<body>
    <div class="container">
        <?php if(!empty($_SESSION['erreur'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <!-- <?= $contenu ?> -->
    </div>
  
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="homeAdmin.php">RentCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="homeAdmin.php">Accueil</a>
               
                <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
              Voitures
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="addCar.php">Ajouter voiture</a>
                <a class="dropdown-item" href="list_Car.php">Liste voitures </a>
                <a class="dropdown-item" href="Galerie.php">Galerie </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                routerLink="add-match"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
              Utilisateur
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="addUser.php">Ajouter Utilisateur</a>
                <a class="dropdown-item" href="tab_users.php">Liste Utilisateurs </a>
              </div>
            </li>
            <li class="nav-item dropdown">
             
                
                <a
                class="nav-link dropdown-toggle"
                routerLink="add-match"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
              Location
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="addContrat.php">Ajouter contrat</a>
                <a class="dropdown-item" href="listContrat.php">Liste contrats </a>
              </div>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="Galerie.php">Galerie</a>
                </li>   
            </ul>

            <!-- Moved the </ul> here -->
            <ul class="navbar-nav">
            
            <li class="nav-item">
                    <a class="nav-link" href="./Profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    
   



    
        <table class="table table-striped" id="myTable" class="display">
       
    
        <thead>
        
            <tr>
              
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Non</th>
                <th scope="col">Prenom</th>
                <th scope="col">Email</th>
                
                <th scope="col">Role</th>
                <th scope="col">Date creation </th>
                <th scope="col">photo_profil</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
                
                
            </tr>
        </thead>


        
        <tbody>
             <?php 
            $servername = "localhost";
            $usernameDB = "root";
            $passwordDB = "";
            $database = "projet";
            
            $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);
            $sql = "SELECT * FROM users";

            $result = $conn->query($sql);
    
     
    
            if ($result->num_rows > 0) {
    
                $users = array();
    
                while ($row = $result->fetch_assoc()) {
    
                    $users[] = $row;
    
                }
            } 
            foreach ($users as $user): ?> 
               
               <tr>
               <div id="color-div" onmouseenter="onMouseEnter()" onmouseleave="onMouseLeave()">
                    <!-- <th scope="row"><?= $user['id_user'] ?></th> -->
                    <td><?= $user['nom'] ?></td>
                    <td><?= $user['prenom'] ?></td>
                    <td><?= $user['email'] ?></td>
                    
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['created_at'] ?></td>
                    <td><img src="<?php echo $user['photo_profil']?$user['photo_profil']:"default.png"; ?>" alt="" width='100' height='100'></td>
                    
                    <td>
                    <a href="Task.php?action=edit&id=<?= $user['id_user'] ?>" class="btn btn-success" role="button" >UPDATE</a><BR></BR>
                    </td>
                        <td>
                    <a href="Task.php?action=deleteUser&id=<?= $user['id_user'] ?>" class="btn btn-danger" role="button">DELETE</a> 
                    

                    </td>
                </tr>
            <?php endforeach;            
                  ?>
        </tbody>
    </table>


    


  <footer
          class="text-center text-lg-start text-dark"
          style="background-color: #ECEFF1"
          >
    <!-- Section: Social media -->
    <section
             class="d-flex justify-content-between p-4 text-white"
             style="background-color: #21D192"
             >
      <!-- Left -->
      <div class="me-5">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">Company name</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              Here you can use rows and columns to organize your footer
              content. Lorem ipsum dolor sit amet, consectetur adipisicing
              elit.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Products</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-dark">MDBootstrap</a>
            </p>
            <p>
              <a href="#!" class="text-dark">MDWordPress</a>
            </p>
            <p>
              <a href="#!" class="text-dark">BrandFlow</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Bootstrap Angular</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Useful links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-dark">Your Account</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Become an Affiliate</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Shipping Rates</a>
            </p>
            <p>
              <a href="#!" class="text-dark">Help</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
            <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2020 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/"
         >MDBootstrap.com</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<script>

$(document).ready(function () {

    $('#myTable').DataTable();

});

</script>
</body>

</html>