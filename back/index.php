<?php 
 
require "config.php"; 
 
$rota = $_GET["rota"] ?? ($_SERVER["REQUEST_METHOD"] === "POST" ? "clientes" : "teste"); 
 
function teste() { 
    echo"API respondendo com sucesso!"; 
} 
 
function listarClientes($con){ 
    header("Content-Type: application/json; charset=utf-8"); 
    $stmt = $con->query("SELECT * FROM Clientes"); 
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)); 
} 
 
function adicionarClientes($con) { 
    $nome = $_POST["Nome"] ?? ""; 
    $email = $_POST["Email"] ?? ""; 
    $telefone = $_POST["Telefone"] ?? ""; 
    $endereco = $_POST["Endereco"] ?? ""; 
 
    $stmt = $con->prepare("INSERT INTO Clientes (Nome, Email, Telefone, Endereco) VALUES (?, ?, ?, ?)"); 
    $stmt->execute([$nome, $email, $telefone, $endereco]); 
    
    header("location: ../front/index.html"); 
    
    exit; 
} 
 
if($_SERVER["REQUEST_METHOD"] === "POST") { 
    adicionarClientes($con); 
} elseif ($rota === "clientes") { 
    listarClientes($con); 
} else { 
    teste(); 
} 
 
?>