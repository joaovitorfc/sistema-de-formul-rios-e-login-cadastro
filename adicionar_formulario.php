<?php  
require 'db.php';  
session_start();  


if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {  
    header('Location: login.php');  
    exit();  
}  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $titulo = $_POST['titulo'];  

    $stmt = $pdo->prepare('INSERT INTO formularios (titulo) VALUES (?)');  
    if ($stmt->execute([$titulo])) {  
        $form_id = $pdo->lastInsertId();
        $mensagem = "Formulário criado com sucesso!";
        $link_adicionar = "adicionar_pergunta.php?id=" . $form_id;
    } else {  
        $mensagem = "Erro ao criar o formulário.";
    }  
}  
?>  

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Criar Formulário</title>  
    <style>  
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .mensagem {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
        }

        .erro {
            color: #dc3545;
        }

        .link-adicionar {
            display: inline-block;
            margin-top: 15px;
            padding: 10px;
            background-color: #17a2b8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .link-adicionar:hover {
            background-color: #138496;
        }
    </style>  
</head>  

<body>  
    <div class="container">
        <h1>Criar Novo Formulário</h1>  
        
        <form method="POST">  
            <input type="text" name="titulo" placeholder="Título do Formulário" required>  
            <input type="submit" value="Criar Formulário">  
        </form>  

        <?php if (isset($mensagem)): ?>  
            <p class="mensagem <?php echo isset($link_adicionar) ? '' : 'erro'; ?>">
                <?php echo $mensagem; ?>
            </p>
            <?php if (isset($link_adicionar)): ?>
                <a href="<?php echo $link_adicionar; ?>" class="link-adicionar">Adicionar Perguntas</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>  
</html>
