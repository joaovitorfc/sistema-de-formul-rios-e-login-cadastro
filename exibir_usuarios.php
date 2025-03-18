<?php  
session_start();  
require 'db.php';  

if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {  
    header('Location: login.php');  
    exit();  
}  

$sql = "SELECT id, nome, email FROM usuarios WHERE tipo_usuario = 'usuario' ORDER BY nome ASC";  
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>  

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <title>Usuários Cadastrados</title>  
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
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
        <h1>Clientes DPOnet</h1>  

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
            <?php  
            if ($usuarios) {  
                foreach ($usuarios as $usuario) {  
                    echo "<tr>";
                    echo "<td>" . $usuario['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                    echo "</tr>";
                }  
            } else {  
                echo "<tr><td colspan='3'>Nenhum usuário encontrado.</td></tr>";  
            }  
            ?>
        </table>

        <br>
        <a class="logout" href="pagina_admin.php">Voltar</a>
    </div>
</body>  
</html>
