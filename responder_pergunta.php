<?php  
require 'db.php';  
session_start();  


if (!isset($_SESSION['user_id'])) {  
    header('Location: login.php');  
    exit();  
}  

$stmt = $pdo->query('SELECT * FROM perguntas');  
$perguntas = $stmt->fetchAll();  
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        font-family: Arial, sans-serif;  
            margin: 20px;  
            padding: 20px;  
    }
</style>

<body>
<h1>Responda às Perguntas</h1>  

<form method="POST" action="processar_respostas.php">  
    <?php foreach ($perguntas as $pergunta): ?>  
        <h3><?php echo htmlspecialchars($pergunta['pergunta']); ?></h3>  
        <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="1" required>  
        <?php echo htmlspecialchars($pergunta['opcao1']); ?><br>  
        
        <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="2" required>  
        <?php echo htmlspecialchars($pergunta['opcao2']); ?><br>  
        
        <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="3" required>  
        <?php echo htmlspecialchars($pergunta['opcao3']); ?><br>  
        
        <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="4" required>  
        <?php echo htmlspecialchars($pergunta['opcao4']); ?><br>  
    <?php endforeach; ?>  
    <input type="submit" value="Enviar Respostas">  
</form>  
</body>
</html>
