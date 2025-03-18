<?php  
require 'db.php';  
session_start();  


if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {  
    header('Location: login.php');  
    exit();  
}  


$formulario_id = isset($_GET['id']) ? intval($_GET['id']) : 0;  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $pergunta = $_POST['pergunta'];  
    $opcao1 = $_POST['opcao1'];  
    $opcao2 = $_POST['opcao2'];  
    $opcao3 = $_POST['opcao3'];  
    $opcao4 = $_POST['opcao4'];  

    $stmt = $pdo->prepare('INSERT INTO perguntas (pergunta, opcao1, opcao2, opcao3, opcao4, formulario_id) VALUES (?, ?, ?, ?, ?, ?)');  
    if ($stmt->execute([$pergunta, $opcao1, $opcao2, $opcao3, $opcao4, $formulario_id])) {  
        $message = "Pergunta adicionada com sucesso!";
    } else {
        $error = "Erro ao adicionar a pergunta.";
    }
}  
?>

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Adicionar Pergunta</title>  
    <style>
    body{
        font-family: Arial, sans-serif;  
            margin: 20px;  
            padding: 20px;  
    }
</style>
</head>  
<body>  
    <h2>Adicionar Pergunta ao Formulário</h2>  

    <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>  
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>  

    <form method="POST">  
        <label for="pergunta">Pergunta:</label><br>  
        <input type="text" id="pergunta" name="pergunta" required><br><br>  

        <label for="opcao1">Opção 1:</label><br>  
        <input type="text" id="opcao1" name="opcao1" required><br><br>  

        <label for="opcao2">Opção 2:</label><br>  
        <input type="text" id="opcao2" name="opcao2" required><br><br>  

        <label for="opcao3">Opção 3:</label><br>  
        <input type="text" id="opcao3" name="opcao3" required><br><br>  

        <label for="opcao4">Opção 4:</label><br>  
        <input type="text" id="opcao4" name="opcao4" required><br><br>  

        <button type="submit">Adicionar Pergunta</button>  
    </form>  

    <br>  
    <a href="pagina_admin.php">Voltar ao Painel Administrativo</a>  
</body>  
</html>
