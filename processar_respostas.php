<?php  
require 'db.php';  
session_start();  

if (!isset($_SESSION['user_id'])) {  
    header('Location: login.php');  
    exit();  
}  

$formulario_id = isset($_GET['id']) ? intval($_GET['id']) : 0;  

$mensagem = "";
$erro = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $respostas = $_POST['resposta']; 
    $usuario_id = $_SESSION['user_id'];  

    if ($formulario_id > 0 && is_array($respostas)) {  
        foreach ($respostas as $pergunta_id => $resposta) {  
            $resposta = trim($resposta);  

            if (!empty($resposta)) {  
                
                $stmt = $conn->prepare("INSERT INTO respostas (usuario_id, formulario_id, pergunta_id, resposta) 
                                        VALUES (?, ?, ?, ?) 
                                        ON DUPLICATE KEY UPDATE resposta = VALUES(resposta)");  
                $stmt->bind_param("iiis", $usuario_id, $formulario_id, $pergunta_id, $resposta);  
                $stmt->execute();  
                $stmt->close();  
            }  
        }  

        
        $stmt = $conn->prepare("INSERT INTO formularios_respondidos (usuario_id, formulario_id) 
                                VALUES (?, ?) 
                                ON DUPLICATE KEY UPDATE respondido = 1");  
        $stmt->bind_param("ii", $usuario_id, $formulario_id);  
        $stmt->execute();  
        $stmt->close();  

        $mensagem = "Respostas enviadas com sucesso!";  
    } else {  
        $erro = "Erro ao processar o formulário.";  
    }  
}  

$perguntas = [];
if ($formulario_id > 0) {  
    $stmt = $conn->prepare("SELECT id, pergunta FROM perguntas WHERE formulario_id = ?");  
    $stmt->bind_param("i", $formulario_id);  
    $stmt->execute();  
    $result = $stmt->get_result();  
    while ($row = $result->fetch_assoc()) {  
        $perguntas[] = $row;  
    }  
    $stmt->close();  
}  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Formulário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        input[type="radio"], input[type="text"] {
            margin: 10px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
        }
        .mensagem {
            color: green;
        }
        .erro {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulário de Respostas</h2>

        <?php if ($mensagem): ?>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <?php if ($erro): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <?php if (count($perguntas) > 0): ?>
            <form action="formulario.php?id=<?php echo $formulario_id; ?>" method="POST">
                <?php foreach ($perguntas as $pergunta): ?>
                    <p><strong><?php echo $pergunta['pergunta']; ?></strong></p>

                    <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="Sim"> Sim
                    <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="Não"> Não
                    <input type="radio" name="resposta[<?php echo $pergunta['id']; ?>]" value="Talvez"> Talvez
                <?php endforeach; ?>

                <br><br>
                <button type="submit">Enviar Respostas</button>
            </form>
        <?php else: ?>
            <p>Nenhuma pergunta encontrada para este formulário.</p>
        <?php endif; ?>
    </div>
</body>
</html>
