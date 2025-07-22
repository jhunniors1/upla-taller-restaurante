<?php

include("bd.php");

if(isset($_POST['send'])) {

    if(
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['password']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['phone']) >=1
    ){
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $feha = date("d/m/y");
        $consulta = "INSERT INTO datos(nombre, contraseña, email, telefono, fecha)
        VALUES ('$name' , '$password' , '$email' , '$phone' , '$feha')";
        $resultado = mysqli_query($bd, $consulta);
        if($resultado){
            ?>
                <h3 class="success">Tu registro se a completado</h3>
            <?php
        }else{
            ?>
                <h3 class="success">Ocurrio un Error</h3>
            <?php
        }
    }else{
            ?>
                <h3 class="success">Llenar todos los datos</h3>
            <?php
        }
    }

?>