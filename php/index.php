<?php
session_start();
require_once "config.php";
//<!--actividad 3 creada  por jordi sala sanglas-->

if (isset($_SESSION["username"])) {
    header("location:home.php");
    exit;
}

if (isset($_POST["login"])) {
  $username = mysqli_real_escape_string($connection, $_POST["username"]);
  $password = $_POST["password"]; 

  $query = "SELECT * FROM usuarios WHERE username = ?";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result)) {
      
      if (password_verify($password, $row["password"])) {
          $_SESSION["username"] = $username;
          header("location:home.php");
          exit;
      } else {
          echo "<script>alert('Error en el login: Contraseña incorrecta');</script>";
      }
  } else {
      echo "<script>alert('Error en el login: Usuario no encontrado');</script>";
  }
}

if (isset($_POST["register"])) {
  
  if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["repeat_password"])) {
      echo '<script>alert("¡Todos los campos son obligatorios!");</script>';
  }
  
  else if ($_POST["password"] != $_POST["repeat_password"]) {
      echo '<script>alert("¡Las contraseñas no coinciden!");</script>';
  }
  else {
      
      $username = mysqli_real_escape_string($connection, $_POST["username"]);
      $password = mysqli_real_escape_string($connection, $_POST["password"]);
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      
      $query = "SELECT * FROM usuarios WHERE username = ?";
      $stmt = mysqli_prepare($connection, $query);
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) > 0) {
          echo '<script>alert("Error: ¡El nombre de usuario ya existe!");</script>';
      } else {
          
          $query = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
          $stmt = mysqli_prepare($connection, $query);
          mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

          if (mysqli_stmt_execute($stmt)) {
              echo '<script>alert("¡Registro exitoso! Ya puedes iniciar sesión."); window.location.href = "index.php";</script>';
          } else {
              echo '<script>alert("Error: El registro falló.");</script>';
          }
      }
  }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<div class="vh-100-center">
        <div class="title">Actividad 3: PHP y conexión a SQL</div>

<div class="container d-flex justify-content-center align-items-center vh-100" >
    <div class="form-background text-white">
      
        
        <img src="img/logo.svg" alt="Logo Universitat Carlemany" style="width: 100%; height: 100%; display: block; margin: auto;" >

        <?php
        if (isset($_GET["action"]) && $_GET["action"] == "register") {
        ?>
        <form action="" method="POST">
            <h3 class="text-center mb-4">Register</h3>
            <div class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control" required />
                <label class="form-label" for="username">Username</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" required />
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="repeat_password" name="repeat_password" class="form-control" required />
                <label class="form-label" for="repeat_password">Repeat Password</label>
            </div>
            <button type="submit" name="register" class="btn btn-primary btn-block mb-4">Register</button>
            <div class="text-center">
                <p>Already a member? <a href="index.php" class="text-danger">Login</a></p>
            </div>
        </form>
        <?php
        } else {
        ?>
        <form action="" method="POST">
            <h3 class="text-center mb-4">Login</h3>
            <div class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control" required />
                <label class="form-label" for="username">Username</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" required />
                <label class="form-label" for="password">Password</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>
            <div class="text-center">
                <p>Not a member? <a href="index.php?action=register" class="text-danger">Register</a></p>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>
</html>
