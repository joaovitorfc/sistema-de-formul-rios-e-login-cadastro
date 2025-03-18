<?php  
session_start();  
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'usuario') {  
    header('Location: login.php');  
    exit();  
}  

$user_id = $_SESSION['user_id'];

$sql_user = "SELECT nome FROM usuarios WHERE id = ?";  
$stmt_user = $pdo->prepare($sql_user);
$stmt_user->execute([$user_id]);
$usuario = $stmt_user->fetch();

$nome_usuario = $usuario ? $usuario['nome'] : 'Usuário';

$sql = "SELECT id, titulo FROM formularios ORDER BY id DESC";  
$stmt = $pdo->prepare($sql);
$stmt->execute();
$formularios = $stmt->fetchAll();
?>

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <title>Página do Usuário</title>  
    <style>
        body {
            font-family: Arial, sans-serif;  
            margin: 20px;  
            padding: 20px;  
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .form-list {
            list-style-type: none;
            padding: 0;
        }
        .form-list li {
            background: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #aaa;
        }
        .form-list a {
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }
        .form-list a:hover {
            text-decoration: underline;
        }
        .logout {
            display: inline-block;
            margin-top: 20px;
            background: red;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .logout:hover {
            background: darkred;
        }
    </style>
</head>  
<body>  
    <div class="container">
    <h1>Olá, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>  
        <p>Aqui você pode ver os formulários disponíveis para você responder.</p>

        <h2>Formulários Disponíveis:</h2>
        <ul class="form-list">
            <?php  
            if ($formularios) {  
                foreach ($formularios as $form) {  
                    echo "<li><a href='responder_formulario.php?id=" . $form['id'] . "'>" . htmlspecialchars($form['titulo']) . "</a></li>";  
                }  
            } else {  
                echo "<p>Nenhum formulário disponível no momento.</p>";  
            }  
            ?>
        </ul>

        <br>
        <a class="logout" href="logout.php">Sair</a>
    </div>
</body>  
</html>
