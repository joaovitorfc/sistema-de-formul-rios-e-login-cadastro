<?php  
require 'db.php';  
session_start();  

if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {  
    header('Location: login.php');  
    exit();  
}  

$stmt = $pdo->query('  
    SELECT u.nome, p.pergunta, r.resposta, r.data_resposta   
    FROM respostas r  
    JOIN usuarios u ON r.usuario_id = u.id  
    JOIN perguntas p ON r.pergunta_id = p.id  
    ORDER BY r.data_resposta DESC  
');  

$respostas = $stmt->fetchAll();  
?>  

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas ao Formulário</title>
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
            width: 90%;
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Respostas</h1>  

        <table>
            <tr>  
                <th>Usuário</th>  
                <th>Pergunta</th>  
                <th>Resposta</th>  
                <th>Data</th>  
            </tr>  
            <?php foreach ($respostas as $resposta): ?>  
                <tr>  
                    <td><?php echo htmlspecialchars($resposta['nome']); ?></td>  
                    <td><?php echo htmlspecialchars($resposta['pergunta']); ?></td>  
                    <td><?php echo htmlspecialchars($resposta['resposta']); ?></td>  
                    <td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($resposta['data_resposta']))); ?></td>  
                </tr>  
            <?php endforeach; ?>  
        </table>  

        <a href="logout.php" class="logout">Sair</a>
    </div>
</body>
</html>
