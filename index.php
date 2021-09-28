<?php
//connecting to db
include "connection.php";
?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php

$succ = false;
$err = false;


if($_SERVER['REQUEST_METHOD'] == 'POST') {
   $fullName = $_POST['fname'];
   $email = $_POST['email1'];
   $password = $_POST['password1'];
   $hash = password_hash($password, PASSWORD_DEFAULT);
   
   if(strlen($fullName) < 2){
       $errMsg = "must have more then 2 char.";
   }

  else if(strlen($password) < 6){
    $errMsg2 = "must have more then 6 char.";
   }
else{
   $existsql = $existSql = "SELECT * FROM `customers` WHERE email='$email' OR password='$password'";
   $result = mysqli_query($conn, $existSql);
   $row = mysqli_num_rows($result);
   if($row > 0){
       $err = true;
   }
   else{
   $sql = "INSERT INTO `customers` (`name`, `email`, `password`, `timestamp`) VALUES ('$fullName', '$email', '$hash', current_timestamp());";
   $result1 = mysqli_query($conn, $sql);
   if($result1){
       $succ = true;
       header("location:welcome.php");
   }
}
}
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Error Technologies</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Error Technologies</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
      </ul>
  </div>
</nav>
<?php
if ($succ) {
      echo '<div class="alert alert-success fade show" role="alert">
          <strong>Success!</strong> Record Inserted Successfully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if ($err) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> Email or Password already exists.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    ?>

<div class="container mt-4 mx-auto" style="width: 400px;">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div class="mb-3">
    
    Full Name  <span><?php echo $errMsg ?></span><input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" maxlength="25" required name="fname">
    
  </div>
  <div class="mb-3">
    Email<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required maxlength="30" name="email1">
  </div>
  <div class="mb-3">
    Password <span><?php echo $errMsg2 ?><input type="password" class="form-control" id="exampleInputPassword1" required maxlength="20" name="password1">
  </div>
  <button type="submit" class="btn btn-primary" name="enterbutton">Submit</button>
</form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>