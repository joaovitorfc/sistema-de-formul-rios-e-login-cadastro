<?php  
require 'db.php';
session_start();  

if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {  
    header('Location: login.php');  
    exit();  
}  

$stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$admin = $stmt->fetch();
$nome_admin = $admin ? $admin['nome'] : 'Administrador';
?>  

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>  
    <style>
        body {
            font-family: Arial, sans-serif;  
            margin: 20px;  
            padding: 20px;  
            text-align: center;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .admin-info {
            font-size: 18px;
            margin-bottom: 20px;
            color: #007bff;
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }

        .logout {
            background-color: #dc3545;
        }

        .logout:hover {
            background-color: #c82333;
        }
    </style>
</head>  

<body>  
    <div class="container">
        <h1>Olá,<?php echo htmlspecialchars($nome_admin); ?>!</h1>  
        <p class="admin-info"></p>

        <a href="adicionar_formulario.php">Adicionar Formulário</a>
        <a href="visualizar_respostas.php">Visualizar Respostas</a>
        <a href="exibir_usuarios.php">Clientes</a>
        <a href="logout.php" class="logout">Sair</a>
    </div>
</body>  
</html>  
