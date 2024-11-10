<?php
//<!--actividad 3 creada  por jordi sala sanglas-->
require_once "config.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("location:index.php");
    exit;
}


$query = "SELECT * FROM usuarios";
$result = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Bienvenido, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <h2 class="text-center mb-4">Usuarios Registrados</h2>
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row["username"]) . '</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Created:' . htmlspecialchars($row["created_at"]) . '</h6>
                            <p class="card-text">Este usuario ' . htmlspecialchars($row["username"]) . ' tiene la id ' . htmlspecialchars($row["id"]) . ' . Aquí también podríamos poner más datos. Por ejemplo, el correo podriamos decir que es: ' . htmlspecialchars($row["username"]) . '@carlemany.com </p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                ';
            }
        } else {
            echo '<p class="text-center">No hay usuarios registrados.</p>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js?v=<?php echo time(); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js?v=<?php echo time(); ?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
</body>
</html>
