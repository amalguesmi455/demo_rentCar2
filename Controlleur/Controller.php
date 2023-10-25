<?php
class Controller
{
    private $userModel;

    public function __construct()
    {
        require_once 'Model/UserModel.php';
        $this->userModel = UserModel::class;
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST["Nom"];
            $Prenom = $_POST["Prenom"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role = $_POST["role"];
            $photo_profil =uniqid().'-'. $_FILES["photo_profil"]["name"];
           $directory='Views/' ;
           $tempname = $_FILES["photo_profil"]["tmp_name"];
           move_uploaded_file($tempname,$directory.$photo_profil);

            // Validate input data (e.g., check for empty fields, valid email format, etc.)
            if ($this->userModel::getUserByEmail($email)) {
                // User with the same email already exists
                echo '<script>alert("User with this email already exists.")</script>';


            } else {
                // Create a new user
                if ($this->userModel::createUser($email, $password, $username, $Prenom, $role, $photo_profil)) {
                    // Registration successful, you can redirect to a success page or login page

                    header('Location:./Task.php?action=login');


                } else {
                    // Registration failed, show an error message
                    echo '<script>alert("registration failed please try again")</script>';
                }
            }
        } else {
            // Load the registration form view
            include 'Views/signup.php';

        }
    }
    
    public function add_car(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marque = $_POST["marque"];
            $modele = $_POST["modele"];
            $couleur = $_POST["couleur"];
            $action = $_POST["action"];
            $prix_location = $_POST["prix_location"];


   
            
            $carid=$this->userModel::createCar($marque, $modele, $couleur, $prix_location,$action ) ;
            
                       /** uploading picture  */
        $uploadDirectory = './Views/carPhoto/';
    //    var_dump ($_FILES);die;
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }
        if(count($_FILES['file'])>0)
         
            {
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    $fileName = $_FILES['file']['name'][$i];
                    $fileTmpName = $_FILES['file']['tmp_name'][$i];
                 
                       
                    $uploadfile = uniqid(). basename($fileName);
  
                 move_uploaded_file($fileTmpName,$uploadDirectory . $uploadfile);
                 $this->userModel::createphoto($carid, $uploadfile);
 
        
             }
            
            }
            header('Location:./list_Car.php');

           
}
     
           
    else {
            // Load the registration form view
            include 'Views/addCar.php';

        }
    }

    public function editUser($id_user)
    {
      
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newEmail = $_POST['new_email'];
        $newPassword = $_POST['new_password'];

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if (UserModel::getUserByEmail($newEmail)) {
            echo '<script>alert("This email is already in use")</script>';
        } else {
            if (UserModel::updateUser($id_user, $newEmail, $newPassword)) {
                setcookie('user', serialize(UserModel::getUserByEmail($newEmail)), time() + 3600, '/');
                echo '<script>alert("Profile updated successfully")</script>';
                header('Location: ./Views/homeAdmin.php');
                return;
            } else {
                echo '<script>alert("Failed to update profile")</script>';
            }
        }
    } else {
        include './Views/edit.php';
    }
}


    public function editCar($id_voiture)
    {
       
        require_once('checkLogin.php');
        require_once('checkAdmin.php');
        $car=$this->userModel::getCarById($id_voiture);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission and update the car's info
            $modele = filter_input(INPUT_POST, 'modele', FILTER_SANITIZE_STRING);
            $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_STRING);
            $prix_location = filter_input(INPUT_POST, 'prix_location', FILTER_SANITIZE_STRING);
          
            if(count($_FILES['file'])>0)
              
            { 
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    $fileName = $_FILES['file']['name'][$i];
                    $fileTmpName = $_FILES['file']['tmp_name'][$i];
                  
                        
             $uploadfile = uniqid(). basename($fileName);

             try {
                 move_uploaded_file($fileTmpName,$this->uploaddir . $uploadfile);
                 $this->userModel::createCarPhoto($carId, $uploadfile);

             } catch(Exception) {
                 echo "error while uploading file\n";}
             }
            }
            if ($this->userModel::updatecar($carId,$model, $marque, $prix_location)) {
                  
                header('Location: index.php?action=admin&whereTo=cars');
                } else {
                    // Registration failed, show an error message
                    echo '<script>alert("failed to update the profile")</script>';
                }
            
        } else {
            include './Views/editCar.php';
        }
    }
    

    public function adminEdit($id)
    {
        require_once('checkLogin.php');
        require_once('checkAdmin.php');
        $user=$this->userModel::getUserById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            // Handle form submission and update the user's profile
            
            $newEmail = $_POST['email'];
            if($_POST['password']=="") $newPassWord=$user['password'] ;
            else $newPassWord = password_hash($_POST['password'], PASSWORD_DEFAULT);


                // Create a new user
                $this->userModel::updateUser($id, $newEmail, $newPassWord);

                    echo '<script>alert("profile updated successfully")</script>';

                    header('Location: Task.php?action=allUsers');



        } else {
            include './Views/edit.php';
        }
    }
    // public function delete($id)
    // {
    //     require_once('checkLogin.php');


    //     if ($this->userModel::deleteUser($id)) {
    //         if (unserialize($_COOKIE["user"])["role"] == "admin")
    //             header('Location: Task.php?action=admin');
    //         else if (unserialize($_COOKIE["user"])["id"] == $id) {
    //             setcookie('user', '', time() + 3600, '/');
    //             header('Location: Task.php?action=login');
    //         } else 
    //        header('Location: ./views/accessDinied.php');

    //     } else {
    //         echo '<script>alert("user deleted successfully")</script>';

    //     }


    // }
    public function deleteUser($userId) {
        // Vérifiez ici si l'utilisateur actuel a les autorisations pour supprimer un utilisateur

        $userModel =  UserModel::class;
        $success = $userModel::deleteUser($userId);

        if ($success) {
            // Suppression réussie, redirigez vers la liste des utilisateurs
            header("Location: Task.php?action=allUsers");
            exit();
        } else {
            // Erreur lors de la suppression
            $errorMessage = "Erreur lors de la suppression de l'utilisateur.";
            echo $errorMessage;
            die($errorMessage);
        }
    }
    public function deleteCar($id_voiture) {
        // Vérifiez ici si l'utilisateur actuel a les autorisations pour supprimer un utilisateur
        $userModel =  UserModel::class;
        $success = $userModel::deleteCars($id_voiture);

        if ($success) {
            // Suppression réussie, redirigez vers la liste des utilisateurs
            header("Location: Task.php?action=allCars");
          
        } else {
            // Erreur lors de la suppression
            $errorMessage = "Erreur lors de la suppression du voiture";
            echo $errorMessage;
            die($errorMessage);
        }
    }

    public function allUsers()
    {
        require_once('checkLogin.php');
        require_once('checkAdmin.php');

        $usersList = $this->userModel::getAllUser();
        include 'Views/tab_users.php';

      
    }
    public function allCars()
    {
     
        $carsList = $this->userModel::getAllCars();
        include 'Views/list_Car.php';

      
    }

    public function admin()
    {
        require_once('checkLogin.php');
        require_once('checkAdmin.php');
        
        $usersList = $this->userModel::getAllUser();
        include './Views/homeAdmin.php';
        
    }

    public function uploadpic($id){

        $user = $this->UserModel->getUserById($id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           $photo_profil =uniqid().'-'. $_FILES["photo_profil"]["name"];
           $directory='photo_profil/' ;
           $tempname = $_FILES["photo_profil"]["tmp_name"];
           move_uploaded_file($tempname,$directory.$photo_profil);
       if($this->userModel->updateUser($photo_profil)){
                   header('Location: Task.php?action=profil');
       
           echo('<p class="success"> Your update are done! </p>');
                   exit;
           
               }else{
                   echo "Error: unable to update user, please verifier.";
               }
               } else {
                   include 'view/update.php';
               }
    }
    public function getCarPhotos($carId)
    {
        require_once('checkLogin.php');

        $carsPhotosList = $this->userModel::getAllPhotos($carId);
        include './Views/Galerie.php';
    }  
}