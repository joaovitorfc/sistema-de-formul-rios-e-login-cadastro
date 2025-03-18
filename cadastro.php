<?php  
require 'db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $nome = $_POST['nome'];  
    $email = $_POST['email'];  
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha  
    $tipo_usuario = $_POST['tipo_usuario'];  


    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');  
    $stmt->execute([$email]);  
    $usuarioExistente = $stmt->fetch();  

    if ($usuarioExistente) {  
        echo "<script>alert('Erro: Este e-mail já está cadastrado.');</script>";  
    } else {  
       
        $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)');  
        if ($stmt->execute([$nome, $email, $senha, $tipo_usuario])) {  
            echo "<script>alert('Usuário cadastrado com sucesso! Redirecionando para login...');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
            exit(); 
        } else {  
            echo "<script>alert('Erro ao cadastrar usuário.');</script>";  
        }  
    }  
}  
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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

        input[type="text"], input[type="email"], input[type="password"], select {
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

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <form method="POST">
            Nome: <input type="text" name="nome" required><br>  
            Email: <input type="email" name="email" required><br>  
            Senha: <input type="password" name="senha" required><br>  
            Tipo de Usuário:   
            <select name="tipo_usuario">  
                <option value="admin">Administrador</option>  
                <option value="usuario">Usuário</option>  
            </select><br>  
            <input type="submit" value="Cadastrar">  
        </form>
        <div class="login-link">
            <h4>Já tem uma conta? <a href="login.php">Entre</a></h4>
        </div>
    </div>
</body>
</html>
