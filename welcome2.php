<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";
 
// Define variables and initialize with empty values
$name = $lastname = $username = $password = $confirm_password = $email ="";
$name_err = $lastname_err = $username_err = $password_err = $confirm_password_err = $email_err = $dni_err = $pago_err = $tel_err = $art_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
     //Validate name
    if (empty($_POST["dni"])) {
        # code...
        $dni_err = "Pelase insert DNI.";
    } else{

        $name = trim($_POST["dni"]);
    }

    //Validate lastname
    if (empty($_POST["tel"])) {
        # code...
        $tel_err = "Pelase insert phone.";
    } else{

        $name = trim($_POST["phone"]);
    }

     //Validate pago
    if (empty($_POST["pago"])) {
        # code...
        $tel_err = "Pelase insert Metodo de pago.";
    } else{

        $name = trim($_POST["pago"]);
    }
      //Validate article
    if (empty($_POST["art"])) {
        # code...
        $tel_err = "Pelase insert article.";
    } else{

        $name = trim($_POST["art"]);
    }

}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <div class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</h2>
    </div>
      <div class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>. Welcome to our site.</h2>
    </div>
      <div class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["lastname"]); ?></b>. Welcome to our site.</h2>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

     <div class="container">
            

        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
      
          
       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

             <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($_SESSION["name"]); ?>">
                </div>
             </div>

             <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Apellido</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($_SESSION["lastname"]); ?>">
                </div>
             </div>

             <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>">
                </div>
             </div>

             <div class="form-group row">
                <label>Documento</label>
                <input type="text" name="dni" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $dni_err; ?></span>
            </div>  

            <div class="form-group row">
                <label>Telefono</label>
                <input type="text" name="tel" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $tel_err; ?></span>
            </div>    

            <div class="form-group row">
                <label>Medio de pago</label>
                <input type="text" name="pago" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $pago_err; ?></span>
            </div>  

            <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Consumidor Final
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2">
                  <label class="form-check-label" for="exampleRadios2">
                    Responsable Inscripto
                  </label>
            </div>

            <div class="form-group row">
                <label>Nombre del articulo</label>
                <input type="text" name="art" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $art_err; ?></span>
            </div> 
  
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
 
    </div>    
</body>
</html>