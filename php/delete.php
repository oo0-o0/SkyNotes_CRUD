<?php
    include "config.php"; 

    if(isset($_GET['id'])) 
    {
        $idTarefa = $_GET['id'];

        $sql = "DELETE FROM tarefas WHERE id_tarefa=$idTarefa";

        if ($conn->query($sql) === FALSE) 
        {
            echo "Erro ao remover a tarefa: " . $conn->error;
        }

        $conn->close();
    }
     
    else 
    {
        echo "ID da tarefa não especificado.";
    }
?>