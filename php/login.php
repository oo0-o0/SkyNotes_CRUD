<?php
include 'config.php';
session_start();

// Registro
if (isset($_POST['register'])) 
{
    // Registro de usuário
    $username = $_POST['usuario'];
    $password = $_POST['senha'];

    // Verificar se o usuário já existe
    $check_user_sql = "SELECT * FROM usuario WHERE nome='$username'";
    $result = $conn->query($check_user_sql);

    if ($result->num_rows > 0) 
    {
        header("Location: ../html/userExistente.html");
        exit();
    } 
    else 
    {
        // Hash da senha
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Inserir novo usuário no banco de dados
        $insert_user_sql = "INSERT INTO usuario (nome, senha) VALUES ('$username', '$hashed_password')";
        if ($conn->query($insert_user_sql) === TRUE) 
        {
            $_SESSION['username'] = $username;
            $user_id = $conn->insert_id;

            $_SESSION['id'] = $user_id;
            header("Location: main.php");
        } 
        else 
        {
            header("Location: ../html/erroRegistro.html");
            exit();
        }
    }
} 
elseif (isset($_POST['login'])) 
{
    $username = $_POST['usuario'];
    $password = $_POST['senha'];

    // Verificar se o usuário existe
    $check_user_sql2 = "SELECT * FROM usuario WHERE nome='$username'";
    $result = $conn->query($check_user_sql2);

    if ($result->num_rows == 1) 
    {
        // O usuário existe, verificar a senha
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data['senha'])) 
        {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $user_data['id'];
            header("Location: main.php");
            exit();
        } 
        else 
        {
            header("Location: ../html/erroLogin.html");
            exit();
        }
    } 
    else 
    {
        header("Location: ../html/erroNaoExiste.html");
        exit();
    }
} 
$conn->close();
?>