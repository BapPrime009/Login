<?php
$DateAndTime = date('m-d-Y h:i:s a');  
$time = time();
    $alert = "";
    session_start();
    if(!empty($_SESSION['active']))
        {
            header('location: system/');
        }else{

    if(!empty($_POST)){
        if(empty($_POST['email']) || empty($_POST['password'])){
            $alert = '<p class="alert alert-danger"> Ingrese su Usuario y Contraseña </p>';
        }else{
            require_once "conexion.php";

            $user = mysqli_real_escape_string($conection,$_POST['email']);
            $pass = mysqli_real_escape_string($conection,$_POST['password']);
           

            $query = mysqli_query($conection,"SELECT * FROM users WHERE email = '$user' AND password = '$pass'");
            $result = mysqli_num_rows($query);

            if($result > 0){
                $data = mysqli_fetch_array($query);
                
                $_SESSION['active'] = true;
                $_SESSION['correo'] = $data['correo'];
                

                header('location: system/');
            }else{
                $alert = '<p class="alert alert-warning">Usuario o Contraseña incorrecta</p>';
                session_destroy();
            }
        }

    }
    if(($_SESSION['active'])){
        $querix = mysqli_query($conection,"INSERT into logs(email, fecha, hora) VALUES 
        ('$user','$DateAndTime','$time')");


    }
}
?>
<!DOCTYPE html>
<html>
    <head>
<title>Login</title>
    </head>
<body>
    <form method="post">
    <div class="Container">

        <div class="loginx">
            <h1>Login</h1>
            <input type="email" placeholder="Correo@xample.com" name="email"><br><br>
            <input type="password" placeholder="contrasena" name="password"><br><br>
            <input type="submit" name="Enviar">  
        </div>
    </div>
</form>
<style>
    .Container{
        background: rgb(0, 60, 255);
  height: 500px;
  width: 500px;
  display: flex;
  justify-content: center;
  align-items: center;
    }
    .loginx{
        background: rgb(210, 205, 224);
        width: 200px;
        padding: 3px;
        border-radius: 1px;
        
    }
    *{
    margin: 0;
    padding: 0;
    font-family: Arial;
    color: rgb(76, 0, 255);
}

</style>
</body>
    </html>