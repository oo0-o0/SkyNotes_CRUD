<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) 
{
    header("Location: ../index.html");
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['alterar_nome'])) 
    {
        $nome = !empty($_POST['nome']) ? $_POST['nome'] : null;

        if ($nome !== null) 
        {
            $check_query = "SELECT * FROM usuario WHERE nome = '$nome'";
            $check_result = $conn->query($check_query);

            if ($check_result->num_rows > 0) 
            {
                echo '<div class="mensagem-prompt"><p>Erro: O nome \'' . $nome . '\' já está em uso. Por favor, escolha outro nome.</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
                echo '<script>
                function fecharPrompt(elemento) 
                {
                    elemento.parentElement.style.display = "none";
                }
                </script>';
            } 
            else 
            {
                $sql = "UPDATE usuario SET nome = '$nome' WHERE id = {$_SESSION['id']}";

                if ($conn->query($sql) === TRUE) 
                {
                    $_SESSION['username'] = $nome;
                    header("Location: main.php");
                } 
                else 
                {
                    echo '<div class="mensagem-prompt"><p>Erro ao atualizar o nome: ' . $conn->error . '</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
                    echo '<script>
                    function fecharPrompt(elemento) 
                    {
                        elemento.parentElement.style.display = "none";
                    }
                    </script>';
                }
            }
        } 
        else 
        {
            echo '<div class="mensagem-prompt"><p>Por favor, forneça um nome válido.</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
            echo '<script>
            function fecharPrompt(elemento) 
            {
                elemento.parentElement.style.display = "none";
            }
            </script>';
        }
    }

    elseif (isset($_POST['alterar_senha'])) 
    {
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;

        if ($senha !== null) 
        {
            $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET senha = '$hashed_password' WHERE id = {$_SESSION['id']}";

            if ($conn->query($sql) === TRUE) 
            {
                header("Location: main.php");
            } 
            else 
            {
                echo '<div class="mensagem-prompt"><p>Erro ao atualizar a senha: ' . $conn->error . '</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
                echo '<script>
                function fecharPrompt(elemento) 
                {
                    elemento.parentElement.style.display = "none";
                }
                </script>';
            }
        } 
        else 
        {
            echo '<div class="mensagem-prompt"><p>Por favor, forneça uma senha válida.</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
            echo '<script>
            function fecharPrompt(elemento) 
            {
                elemento.parentElement.style.display = "none";
            }
            </script>';
        }
    }

    elseif (isset($_POST['alterar_nome_senha'])) 
    {
        $nome = !empty($_POST['nome']) ? $_POST['nome'] : null;
        $senha = !empty($_POST['senha']) ? $_POST['senha'] : null;

        if ($nome !== null && $senha !== null) 
        {
            $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET nome = '$nome', senha = '$hashed_password' WHERE id = {$_SESSION['id']}";

            if ($conn->query($sql) === TRUE) 
            {
                $_SESSION['username'] = $nome;
                header("Location: main.php");
            } 
            else 
            {
                echo '<div class="mensagem-prompt"><p>Erro ao atualizar o nome e senha: ' . $conn->error . '</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
                echo '<script>
                function fecharPrompt(elemento) 
                {
                    elemento.parentElement.style.display = "none";
                }
                </script>';
            }
        } 
        else 
        {
            echo '<div class="mensagem-prompt"><p>Por favor, forneça um nome e uma senha válidos.</p><button class="fechar-prompt" onclick="fecharPrompt(this)">Fechar</button></div>';
            echo '<script>
            function fecharPrompt(elemento) 
            {
                elemento.parentElement.style.display = "none";
            }
            </script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Conta - SkyNotes</title>
    <link rel="shortcut icon" type="image/png" href="../imgs/logoSKYNOTES.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" data-tag="font" />
    <style>
        :root 
        {
            --cor-primaria: #87bdd8;
            --cor-secundaria: #cfe0e8;
            --cor-fundo: #f3f3f3;
            --cor-texto: #333;
            --cor-erro: red;
            --cor-botao-disabled: #ccc;
            /* Cor para botões desativados */
        }

        body 
        {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--cor-fundo);
        }

        .container 
        {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form 
        {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        label 
        {
            display: block;
            margin-bottom: 10px;
            color: var(--cor-texto);
            text-align: left;
        }

        input[type="text"],
        input[type="password"] 
        {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        button 
        {
            background-color: var(--cor-primaria);
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: calc(100% - 24px);
            margin-bottom: 10px;
        }

        input[type="submit"]:hover,
        button:hover 
        {
            background-color: var(--cor-secundaria);
        }

        input[type="submit"]:disabled,
        button:disabled 
        {
            background-color: var(--cor-botao-disabled);
            cursor: not-allowed;
        }

        h1 
        {
            margin-bottom: 20px;
            font-size: 24px;
            color: var(--cor-texto);
        }

        #infoSenha 
        {
            color: #555;
            margin-bottom: 10px;
        }

        .mensagem-prompt 
        {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 300px;
        }

        .fechar-prompt 
        {
            background-color: var(--cor-primaria);
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 18px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .fechar-prompt:hover 
        {
            background-color: var(--cor-secundaria);
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Alterar Conta</h1>
            <label for="nome">Novo Nome:</label>
            <input type="text" id="nome" name="nome">
            <div class="mensagem-erro" id="mensagemNome"></div>

            <label for="senha">Nova Senha:</label>
            <input type="password" id="senha" name="senha">
            <div id="infoSenha">* Senha deve ter entre 8 e 30 caracteres.</div>
            <div class="mensagem-erro" id="mensagemSenha"></div>

            <input type="submit" name="alterar_nome" id="alterarNome" value="Alterar Nome" disabled>
            <input type="submit" name="alterar_senha" id="alterarSenha" value="Alterar Senha" disabled>
            <input type="submit" name="alterar_nome_senha" id="alterarNomeSenha" value="Alterar Nome e Senha" disabled>

            <button type="button" id="cancelarAlteracoes">Cancelar Alterações</button>
            <button type="button" id="limparCampos">Limpar Campos</button>
        </form>
    </div>

    <script>
        document.getElementById('senha').addEventListener('input', validateSubmit);
        document.getElementById('nome').addEventListener('input', validateSubmit);

        function validateSubmit() {
            var senha = document.getElementById('senha').value;
            var nome = document.getElementById('nome').value;
            var mensagemSenha = document.getElementById('mensagemSenha');
            var mensagemNome = document.getElementById('mensagemNome');
            var alterarSenhaButton = document.getElementById('alterarSenha');
            var alterarNomeButton = document.getElementById('alterarNome');
            var alterarNomeSenhaButton = document.getElementById('alterarNomeSenha');

            if (senha.length < 8 || senha.length > 30) {
                mensagemSenha.innerText = 'A senha deve ter entre 8 e 30 caracteres';
                alterarSenhaButton.disabled = true;
                alterarNomeSenhaButton.disabled = true;
            } else {
                mensagemSenha.innerText = '';
                alterarSenhaButton.disabled = false;
                alterarNomeSenhaButton.disabled = nome === '';
            }

            alterarNomeButton.disabled = nome === '';
            mensagemNome.innerText = nome === '' ? 'Por favor, forneça um nome.' : '';

            if (nome !== '' && senha !== '') {
                alterarNomeButton.disabled = true;
                alterarSenhaButton.disabled = true;
                alterarNomeSenhaButton.disabled = false;
            } else {
                alterarNomeSenhaButton.disabled = true;
            }
        }

        document.getElementById('limparCampos').addEventListener('click', function() {
            document.getElementById('nome').value = '';
            document.getElementById('senha').value = '';
            validateSubmit();
        });

        document.getElementById('cancelarAlteracoes').addEventListener('click', function() {
            window.location.href = 'main.php';
        });
    </script>
</body>

</html>