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
$name = $lastname = $username = $password = $confirm_password = $email = $dni = $pago = $cons1 = $tel = $art = $art_anch = $cant = $n_pedido = $uploadfile = "";
$name_err = $lastname_err = $username_err = $password_err = $confirm_password_err = $email_err = $dni_err = $pago_err = $tel_err = $art_err = $art_anch_err = $pic_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    /////////////
    //declaring variables
$filename = $_FILES['uploadfile']['name'];
$filetmpname = $_FILES['uploadfile']['tmp_name'];
//folder where images will be uploaded
$folder = 'imagesuploadedf/';
//function for saving the uploaded images in a specific folder
move_uploaded_file($filetmpname, $folder.$filename);
//inserting image details (ie image name) in the database
$sql = "INSERT INTO `uploadedimage` (`imagename`) VALUES ('$filename')";
$qry = mysqli_query($link, $sql);
if( $qry) {
echo "</br>image uploaded";
}

//////////
 
 $imagename = trim($filename);

 // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
                    $email = trim($_POST["email"]);
    }
    
 // Validate DNI 
    if(empty(trim($_POST["dni"]))){
        $dni_err = "Please insert only numbers";
    } elseif (strlen(trim($_POST["dni"])) < 8) {
        $dni_err = "DNI must hace atleast 8 numbers";
    } else{
            $dni = trim($_POST["dni"]);
    } 

  // Validate pago
    if(empty(trim($_POST["pago"]))){
        $pago_err = "Please fill the box";
    } else{
            $pago = trim($_POST["pago"]);
    } 

 // Validate tel
    if(empty(trim($_POST["tel"]))){
        $tel_err = "Please insert only numbers";
    } else{
            $tel = trim($_POST["tel"]);
    } 

   // // Validate articulo
    if(empty(trim($_POST["art"]))){
        $art_err = "Please fill the box";
    } else{
            $art = trim($_POST["art"]);
    } 

     // // Validate ancho articulo
    if(empty(trim($_POST["art_anch"]))){
        $art_anch_err = "Please fill the box";
    } else{
            $art_anch = trim($_POST["art_anch"]);
    }     


    
    $name = trim($_POST["name"]);
    $lastname = trim($_POST["lastname"]);
    // $email = trim($_POST["email"]);
    // $dni = trim($_POST["dni"]);
    // $pago = trim($_POST["pago"]);
      $cons1 = trim($_POST["cons1"]); 
    // $tel = trim($_POST["tel"]);
    // $art = trim($_POST["art"]);
      $cant = trim($_POST["cant"]);
      $n_pedido = trim($_POST["n_pedido"]);


    // Check input errors before inserting in database
    // if(empty($email_err) && empty($dni_err)&& empty($pago_err) && empty($tel_err) && empty($art_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO pedido (name, lastname, email, dni, tel, pago, cons1, art, art_anch, cant, imagename, n_pedido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_name, $param_lastname, $param_email, $param_dni, $param_tel, $param_pago, $param_cons1, $param_art, $param_art_anch, $param_cant, $param_imagename, $param_n_pedido);
            
            // Set parameters
            $param_name = $name;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_dni  = $dni;
            $param_pago = $pago;
            $param_cons1 = $cons1;
            $param_tel = $tel;
            $param_art = $art;
            $param_art_anch = $art_anch;
            $param_cant = $cant;
            $param_imagename = $imagename;
            $param_n_pedido = $n_pedido;

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    // }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="es">
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

    <div class="container">
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
    </div>

    <div class="container">
        <div class="row">
        <div class="col-md-4 col-md-offset-4">
      <!--   <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p> -->
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >

         <!--    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" value="">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Apellido</label>
                <input type="text" name="lastname" class="form-control" value="">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>  -->

            <!-- <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  -->

            <!-- <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="">
                 <span class="help-block"><?php echo $email_err; ?></span>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>   
            </div> 
 -->          <!--   <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div> -->

            <!-- ////////////////////// -->
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($_SESSION["name"]); ?>" name="name" >
                </div>
             </div>

             <div class="form-group row ">
                <label for="staticEmail" class="col-sm-2 col-form-label">Apellido</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($_SESSION["lastname"]); ?>" name="lastname">
                </div>
             </div>

             <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>" name="email">
                </div>
             </div>

            <div class="form-group <?php echo (!empty($dni_err)) ? 'has-error' : ''; ?>">
                <label>Documento</label>
                <input type="text" name="dni" class="form-control" value="">
                <span class="help-block"><?php echo $dni_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($tel_err)) ? 'has-error' : ''; ?>">
                <label>Telefono</label>
                <input type="txt" name="tel" class="form-control" value="">
                <span class="help-block"><?php echo $tel_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($pago)) ? 'has-error' : ''; ?>">
                <label>Medio de Pago</label>
                <input type="text" name="pago" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $pago_err; ?></span>
            </div>  

            <div class="form-group">
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="cons1" id="exampleRadios1" value="1" checked>
                Consumidor Final
              </label>
            </div>
           
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="cons1" id="exampleRadios2" value="2">
                Responsable inscripto
              </label>
            </div>
            </div>  

            <div class="form-group <?php echo (!empty($art_err)) ? 'has-error' : ''; ?>">
                <label>Nombre del articulo</label>
                <input type="text" name="art" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $art_err; ?></span>
            </div>

             <div class="form-group <?php echo (!empty($art_anch_err)) ? 'has-error' : ''; ?>">
                <label>Ancho del articulo</label>
                <input type="text" name="art_anch" class="form-control form-control-sm" value="">
                <span class="help-block"><?php echo $art_anch_err; ?></span>
            </div>  


            <div class="form-group">
                <label>Cantidad------</label>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="cant" id="cant1" value="1" checked>
                Kg
              </label>
            </div>
           
            
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="cant" id="cant2" value="2">
                Metros
              </label>
            </div>
            </div>  


               <!--  <div class="form-group">
                    <label>INSERTE IMAGEN</label>
                <input type="file" name="uploadfile" />
                </div> -->
                <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="uploadfile">
                  <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                </div>
                </div>



                <div class="form-group">
                <?php
                date_default_timezone_set("America/Montevideo");
                echo "SU NUMERO DE PEDIDO ES ";
                ?>
                <input type="text" readonly class="form-control-plaintext" id="n_pedido" value="                            <?php echo date("Ymdhis"); ?>" name="n_pedido">
                </div>
          

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Finalizar pedido">

               <!--  <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
        </form>
        </div>
       </div> 
    </div>  
</body>
</html>