<?php
include 'config.php';
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) 
{
    header("Location: ../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Recuperando os dados do formulário
    $nomeTarefa = $_POST['name'];
    $descricaoTarefa = $_POST['descricao']; 
    $categoriaTarefa = $_POST['categoria']; 
    $prazoTarefa = $_POST['prazo']; 
    $statusTarefa = $_POST['status_tarefa']; 
    $prioridadeTarefa = $_POST['prioridade']; 

    // ID do usuário logado na sessão
     $username = $_SESSION['username'];
     $getUserIDQuery = "SELECT id FROM usuario WHERE nome = ?";
     $stmt = $conn->prepare($getUserIDQuery);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();
     $userID = $row['id'];

    $sql = "INSERT INTO tarefas (nome_da_tarefa, descricao_tarefa, categoria_tarefa, prazo_tarefa, status_tarefa, prioridade_tarefa, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) 
    {
        $stmt->bind_param("ssssssi", $nomeTarefa, $descricaoTarefa, $categoriaTarefa, $prazoTarefa, $statusTarefa, $prioridadeTarefa, $userID);

        if ($stmt->execute()) 
        {
            header("Location: ../php/tasks.php");
            exit();
        } 
        else 
        {
            header("Location: ../html/form.html");
            exit();
        }
        $stmt->close();
    } 
    else 
    {
        echo "Erro ao preparar a declaração: " . $conn->error;
    }
} 
else 
{
    header("Location: ../html/erroFormulario.php");
}

$conn->close();
?>