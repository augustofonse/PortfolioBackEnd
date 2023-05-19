<!DOCTYPE html>
<html>
<head>
    <title>Potfólio Backend</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <?php
    // Verifica se o formulário foi enviado
    if (isset($_POST['submit'])) {
        // Conecta ao banco de dados
        $conexao = mysqli_connect("localhost", "root", "", "cadastro-usuarios");

        // Verifica a conexão
        if (mysqli_connect_errno()) {
            echo "Falha na conexão com o MySQL: " . mysqli_connect_error();
            exit();
        }

        // Obtém os valores do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Valida o e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "E-mail inválido.";
            mysqli_close($conexao);
            exit();
        }

        // Encripta a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Insere os dados na tabela de usuários
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaCriptografada')";

        if (mysqli_query($conexao, $query)) {
            echo "Usuário cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar o usuário: " . mysqli_error($conexao);
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
    }
    ?>

    <form method="post" action="index.php">
    <h1>Login:</h1>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome:" required>
        <br><br>
        <input type="email" id="email" name="email" placeholder="Digite seu email:" required>
        <br><br>
        <input type="password" id="senha" name="senha" placeholder="Crie sua senha:" required>
        <br><br>
        <button type="submit" name="submit"> Cadastrar </button>
    </form>
    
</body>
</html>
