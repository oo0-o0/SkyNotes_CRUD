<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Página Principal - SkyNotes </title>
    
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="../js/profile.js" defer></script> 
    <link rel="shortcut icon" type="imagex/png" href="../imgs/logoSKYNOTES.png">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    data-tag="font" />
</head>
<body>
    <header>
        <h1>Bem-vindo ao SkyNotes</h1>
    </header>
    
    <aside class="sidebar">
        <div class="user-profile">
            <img src="../imgs/avatar_placeholder.png" alt="Imagem do Perfil" class="profile-image">
            <?php
            session_start();
            
            if (isset($_SESSION['username'])) 
            {
                $username = $_SESSION['username'];
                echo "<h2>$username</h2>";
            } 
            
            else 
            {
                header("Location: ../index.html");
                exit(); 
            }
            ?>
            <a href="../index.html" class="edit-profile"> Sair </a>
            <br>
            <a href="alterar_conta.php" class="edit-profile"> Alterar Conta </a> <!-- Novo botão -->
        </div>
    </aside>

    <main>
        <section>
            <h2>Adicionar Tarefa</h2>
            <p>Clique no botão abaixo para adicionar uma nova tarefa:</p>
            <a href="../html/form.html" class="button">Adicionar Tarefa</a>
        </section>
        
        <section>
            <h2>Visualizar Tarefas</h2>
            <p>Clique no botão abaixo para visualizar suas tarefas:</p>
            <a href="tasks.php" class="button">Visualizar Tarefas</a>
        </section>
    </main>
</body>
</html>
