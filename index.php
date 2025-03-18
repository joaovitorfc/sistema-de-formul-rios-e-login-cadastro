<?php  
session_start();  
?>  

<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Painel de Controle</title>  
    <style>  
   body{
        font-family: Arial, sans-serif;  
            margin: 20px;  
            padding: 20px;  
    }
        nav {  
            margin-bottom: 20px;  
        }  
        nav a {  
            margin-right: 15px;  
            text-decoration: none;  
            color: #007BFF;  
        }  
        nav a:hover {  
            text-decoration: underline;  
        }  
    </style>  
</head>  
<body>  

<h1>Painel de Controle</h1>  

<nav>  
    <a href="login.php">Login</a>  
    <a href="cadastro.php">Cadastrar</a>  
    <?php if (isset($_SESSION['user_id'])): ?>  
        <?php if ($_SESSION['tipo_usuario'] === 'admin'): ?>  
            <a href="adicionar_pergunta.php">Adicionar Pergunta</a>  
            <a href="visualizar_respostas.php">Visualizar Respostas</a>  
        <?php endif; ?>  
        <a href="responder_pergunta.php">Responder Perguntas</a>  
        <a href="logout.php">Sair</a>  
    <?php endif; ?>  
</nav>  

<?php if (isset($_SESSION['user_id'])): ?>  
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['tipo_usuario'] === 'admin' ? 'Administrador' : 'Usuário'); ?>!</h2>  
<?php else: ?>  
    <h2>Por favor, faça login ou crie uma conta.</h2>  
<?php endif; ?>  

</body>  
</html>  