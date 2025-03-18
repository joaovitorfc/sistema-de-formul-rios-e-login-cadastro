<?php  
require 'db.php';  
session_start();  


if (!isset($_SESSION['user_id'])) {  
    header('Location: login.php');  
    exit();  
}  

$formulario_id = isset($_GET['id']) ? intval($_GET['id']) : 0;  


$stmt = $pdo->prepare('SELECT * FROM perguntas WHERE formulario_id = ?');  
$stmt->execute([$formulario_id]);  
$perguntas = $stmt->fetchAll();  
?>  

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Responder Perguntas</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            margin: 20px;  
            padding: 20px;  
        }  
        h3 {  
            margin: 15px 0;  
        }  
    </style>  
</head>  
<body>  

<h1>Responda às Perguntas do Formulário</h1>  

<form method="POST" action="processar_respostas.php?id=<?php echo $formulario_id; ?>">  
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
        <hr>  
    <?php endforeach; ?>  
    <input type="submit" value="Enviar Respostas">  
</form>  

</body>  
</html>  