<?php 

// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
/////conection
require_once "config.php";

// Define variables and initialize with empty values
$id = $name = $lastname = $username = $password = $confirm_password = $email = $dni = $pago = $cons1 = $tel = $art = $art_anch = $cant = $n_pedido = $uploadfile = "";
$name_err = $lastname_err = $username_err = $password_err = $confirm_password_err = $email_err = $dni_err = $pago_err = $tel_err = $art_err = $art_anch_err = $pic_err = "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->

 <!--   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

<?php 

  		if ($_POST["rec_status"]) {

  			echo $_POST["rec_status"];

  			$sql = "UPDATE pedido SET status = '2'";

  			$result = $link->query($sql) or trigger_error(mysql_error()." in ".$sql);

			//$res = mysql_query($link, $sql) or trigger_error(mysql_error()." in ".$sql);
  		
  		}


  		?>	

</body>
</html>