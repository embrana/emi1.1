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
$rec_status = $rowID = $id = $name = $lastname = $username = $password = $confirm_password = $email = $dni = $pago = $cons1 = $tel = $art = $art_anch = $cant = $n_pedido = $uploadfile = "";
$name_err = $lastname_err = $username_err = $password_err = $confirm_password_err = $email_err = $dni_err = $pago_err = $tel_err = $art_err = $art_anch_err = $pic_err = "";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

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
<div class="row">
  <div class="col-4">

	<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

<?php

$sql = "SELECT * FROM pedido";  
$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) { ?>
<div class="card" style="width: 18rem;">
<div class="card-body"> 
<h5 class="card-title"> <?php  echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. " " . $row["lastname"]; ?> </h5>
<h6 class="card-subtitle mb-2 text-muted"><?php echo " N Pedido:  " . $row["n_pedido"];?></h6>
<p class="card-text"><?php 

	echo " email: " . $row["email"]."<br>";
	echo " dni:" . $row["dni"]."<br>";
	echo "Tel: " . $row["tel"]."<br>";
	echo " Tipo de pago: " . $row["pago"]."<br>";
	echo " Articulo: " .$row["art"]."<br>";
	echo "Ancho articulo: " .$row["art_anch"]."<br>";
	echo " Cantidad: " . $row["cant"]."<br>";
	echo "Numero de pedido: ".$row["n_pedido"]."<br>";
	echo " Estado:" . $row["status"]. "<br>";
?></p>

<?php 
switch ($row["status"]) {
	case '0':
			$st0 = "btn btn-danger";
			$st1 = "PENDIENTE";
		break;
	case '1':
			$st0 = "btn btn-warning";
			$st1 = "EN PREPARACION";
		break;
	case '2':
			$st0 = "btn btn-success";
			$st1 = "PARA ENTREGAR";
			break;
	case '3':
			$st0 = "btn btn-primary";
			$st1 = "ENTREGADO";
		break;
}
?>

 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<input type="hidden" id="rowID" value="<?php echo $row["id"];?>" name="rowID" >
	<input type="hidden" id="rowSTATUS" value="<?php echo $row["status"];?>" name="rowSTATUS">
<button type="button" class="<?php echo $st0; ?>" name="f_status" value="0"><?php echo $st1; ?></button>
<button type="submit" class="btn btn-outline-primary" name="" value=""> VER</button>
</form>
</div>
</div>
<?php
}
} else {
  echo "0 results";
}
?>


</div>
  <div class="col-8">

<?php 
switch ($_POST["rowSTATUS"]) {
	case '0':
			$sta = "btn btn-danger";
			$stb = "PENDIENTE";
		break;
	case '1':
			$sta = "btn btn-warning";
			$stb = "EN PREPARACION";	
		break;
	case '2':
			$sta = "btn btn-success";
			$stb = "PARA ENTREGAR";
			break;
	case '3':
			$sta = "btn btn-primary";
			$stb = "ENTREGADO";
		break;
}  ?>

<div class="jumbotron" style="position: fixed; margin-right: 70px; margin-top: 90px;">
  <h1 class="display-4"><?php echo $id = trim($_POST["rowID"]);?></h1>
  <button type="button" class="<?php echo $sta; ?>" name="" value="" onclick="refresh()"><?php echo $stb;?></button>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <button type="submit" class="btn btn-primary" name="edit" value="" onclick="document.getElementById('editDIV').style.display = 'block'"> EDITAR</button>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
<button type="submit" class="btn btn-dark" name="edit" value="" onclick="refresh()"> GRABAR CAMBIOS</button>
  
  	<div style="padding-top: 20px; display: none;" id="editDIV">
  		 
  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="0" name="rec_status" >
  		<button type="submit" class="btn btn-danger" value="" name="" onclick="refresh()">PENDIENTE</button>
  		</form>

  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="1" name="rec_status" >
  		<button type="submit" class="btn btn-warning" value="" name="" onclick="refresh()" >EN PREPARACION</button>
  		</form>

  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="2" name="rec_status" >
  		<button type="submit" class="btn btn-success" value="" name="" onclick="refresh()">PARA ENTREGAR</button>
  		</form>
  		
  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="3" name="rec_status" >
  		<button type="submit" class="btn btn-primary" value="" name="" onclick="refresh()" >ENTREGADO</button>
  		</form>
  		
  		<?php 

  		if(isset($_POST["rec_status"])) {

  			$id = $_POST["rowID"];
  			$status = $_POST["rec_status"];
  			echo $id;
  			echo $status;

			  		$sql = "UPDATE pedido SET status = '$status' WHERE id='$id'";
			if(mysqli_query($link, $sql)){
			    echo "Records were updated successfully.";
			    unset($GLOBALS ['$_POST["rowID"]']);
				unset($GLOBALS['$_POST["rec_status"]']);
			} else {
			    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
		}

  		// Close connection
			mysqli_close($link);

  		?>	

</div>
</div>


  	<button type="button" class="btn btn-primary">Primary</button>
	<button type="button" class="btn btn-success">Success</button>
	<button type="button" class="btn btn-danger">Danger</button>
	<button type="button" class="btn btn-warning">Warning</button>
	<button type="button" class="btn btn-info">Info</button>
	<button type="button" class="btn btn-light">Light</button>
	<button type="button" class="btn btn-dark">Dark</button>




  </div>
</div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
     <div class="jumbotron">
  <h1 class="display-4"><?php echo $id = trim($_POST["rowID"]);?></h1>
  <button type="button" class="<?php echo $sta; ?>" name="" value=""><?php echo $stb;?></button>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <button type="submit" class="btn btn-primary" name="edit" value="" onclick="document.getElementById('editDIV1').style.display = 'block'"> EDITAR</button>


  	<div style="padding-top: 20px; display: none;" id="editDIV1">
  		 
  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="0" name="rec_status" >
  		<button type="submit" class="btn btn-danger" value="" name="" onclick="refresh()">PENDIENTE</button>
  		</form>

  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="1" name="rec_status" >
  		<button type="submit" class="btn btn-warning" value="" name="" onclick="refresh()" >EN PREPARACION</button>
  		</form>

  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="2" name="rec_status" >
  		<button type="submit" class="btn btn-success" value="" name="" onclick="refresh()">PARA ENTREGAR</button>
  		</form>
  		
  		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  		 	<input type="hidden" id="" value="<?php echo $id;?>" name="rowID" >
  		 	<input type="hidden" id="" value="3" name="rec_status" >
  		<button type="submit" class="btn btn-primary" value="" name="" onclick="refresh()">ENTREGADO</button>
  		</form>
  		</div>
		</div>
      
    </div>
  </div>
</div>


</body>
</html>

<script type="text/javascript"> 	
	function refresh() {    
		setTimeout(function () {
			window.location.reload(true)
			    }, 900);
			    // alert("button clicked");
			 }
</script>