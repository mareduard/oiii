<?php
// Definindo as variáveis de conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "bd_contato";

// Conexão com o banco de dados
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Capturando os dados do formulário e escapando caracteres especiais
$nome = $conn->real_escape_string($_POST['nome']);
$email = $conn->real_escape_string($_POST['email']);
$mensagem = $conn->real_escape_string($_POST['mensagem']);

// Inserindo os dados no banco de dados usando prepared statements para evitar SQL injection
$stmt = $conn->prepare("INSERT INTO contato (nome, email, mensagem) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $mensagem);

// Verificando se os dados foram inseridos corretamente
if ($stmt->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro ao enviar mensagem: " . $stmt->error;
}

// Fechando a conexão
$stmt->close();
$conn->close();
?>
