<?php  
require 'db.php';  
session_start();  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $email = $_POST['email'];  
    $senha = $_POST['senha'];  

    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');  
    $stmt->execute([$email]);  
    $usuario = $stmt->fetch();  

    if ($usuario && password_verify($senha, $usuario['senha'])) {  
        $_SESSION['user_id'] = $usuario['id'];  
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];  

        if ($usuario['tipo_usuario'] === 'admin') {  
            header('Location: pagina_admin.php');
            exit();  
        } else {  
            header('Location: pagina_usuario.php'); 
            exit();  
        }  
    } else {  
        echo "<p style='color: red;'>Email ou senha inválidos.</p>";  
    }  
}  
?>  

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;  
            margin: 0;  
            padding: 0;  
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            Email: <input type="email" name="email" required><br>  
            Senha: <input type="password" name="senha" required><br>  
            <input type="submit" value="Entrar">  
        </form>  
        <div class="register-link">
            <h4>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></h4>
        </div>
    </div>
</body>
</html>
