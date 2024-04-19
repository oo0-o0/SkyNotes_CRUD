<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Tarefas - SkyNotes</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
    <link rel="stylesheet" href="../css/tasks.css">
    <link rel="shortcut icon" type="imagex/png" href="../imgs/logoSKYNOTES.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../imgs/logoSKYNOTES.png" alt="SkyNotes Logo">
        </div>
        <h1>Visualizar Tarefas</h1>
        <a href="../html/form.html" class="add-task-button">Adicionar Tarefa</a>
        <a href="../php/logout.php" class="logout-button">Sair</a>
    </header>
    
    <main>
        <div class="kanban">
            <?php
            session_start();

            if (!isset($_SESSION['username'])) 
            {
                header("Location: ../html/erroLogin.html");
                exit();
            }

            include "../php/config.php"; 

            $username = $_SESSION['username'];
            $get_user_id_query = "SELECT id FROM usuario WHERE nome = ?";
            $stmt = $conn->prepare($get_user_id_query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $user_id = $row['id'];

            // Array com os status das tarefas
            $statuses = array("Nao_iniciada", "iniciada", "andamento", "concluida");
            $formatted_statuses = array("Não Iniciada", "Iniciada", "Em Andamento", "Concluída");

            // Loop para exibir as colunas para cada status
            foreach ($statuses as $index => $status) 
            {
                echo "<div class='column'>";
                echo "<h2>" . $formatted_statuses[$index] . "</h2>";
                echo "<div class='tasks'>";

                $sql_tasks = "SELECT * FROM tarefas WHERE status_tarefa=? AND id_usuario=?";
                $stmt_tasks = $conn->prepare($sql_tasks);
                $stmt_tasks->bind_param("si", $status, $user_id);
                $stmt_tasks->execute();
                $result_tasks = $stmt_tasks->get_result();

                if ($result_tasks->num_rows > 0) 
                {
                    while ($task = $result_tasks->fetch_assoc()) 
                    {
                        echo "<div class='task'>";
                        echo "<h3>" . $task["nome_da_tarefa"] . "</h3>";
                        echo "<p><strong>Descrição:</strong> " . $task["descricao_tarefa"] . "</p>";
                        echo "<p><strong>Categoria:</strong> " . $task["categoria_tarefa"] . "</p>";
                        echo "<p><strong>Prazo:</strong> " . $task["prazo_tarefa"] . "</p>";
                        echo "<p><strong>Prioridade:</strong> " . $task["prioridade_tarefa"] . "</p>";
                        echo "<div class='buttons'>";
                        echo "<button class='delete' data-task-id='" . $task["id_tarefa"] . "'>Remover</button>";
                        echo "</div>";

                        echo "</div>"; 
                    }
                } 
                else 
                {
                    echo "<p>Sem tarefas neste status.</p>";
                }
                echo "</div>"; 
                echo "</div>"; 
            }

            $conn->close(); 
            ?>
        </div>
    </main>

    <script>
        document.querySelectorAll('.delete').forEach(button => 
        {
            button.addEventListener('click', function() 
            {
                var idTarefa = this.dataset.taskId;
                console.log("ID da tarefa clicada:", idTarefa);

                var abrirPHP = new XMLHttpRequest();
                abrirPHP.open("GET", "../php/delete.php?id=" + idTarefa, true);
                abrirPHP.send();

                window.location.reload();
            });
        });
    </script>
</body>
</html>