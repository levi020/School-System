<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
session_start();
include "conn.php";

if ($conn->connect_error) {
    echo json_encode(['error' => 'Erro de conexão com o banco de dados']);
    exit;
}

$numFuncionario = $_SESSION['user'] ?? '';
if (empty($numFuncionario)) {
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

try {

    $stmt = $conn->prepare("SELECT `numTurma` FROM `turmas` WHERE `profResponsavel` = ?");
    $stmt->bind_param('s', $numFuncionario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $turmas = [];
        while ($row = $result->fetch_assoc()) {
            $turmas[] = $row['numTurma'];
        }
        echo json_encode($turmas);
    } else {
        echo json_encode(['error' => 'Nenhuma turma encontrada']);
    }

    $stmt->close();
} catch (Exception $e) {
    
    echo json_encode(['error' => 'Erro inesperado. Tente novamente mais tarde.']);
}

// Fechar conexão
$conn->close();
?>