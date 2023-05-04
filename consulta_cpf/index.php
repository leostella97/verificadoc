<?php

if(isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
    $url = "https://api.consultacpf.com/cpf/$cpf";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desativa a verificação do SSL
    $resultado = curl_exec($ch);
    curl_close($ch);

    $dados = json_decode($resultado, true);

    if($dados['status'] == 'error') {
        echo "Erro: ".$dados['message'];
    } else {
        echo "Nome: ".$dados['nome']."<br>";
        echo "CPF: ".$dados['cpf']."<br>";
        echo "Situação: ".$dados['situacao']."<br>";
    }
}

?>

<form method="post">
    <label for="cpf">Coloque seu CPF:</label>
    <input type="text" name="cpf" id="cpf" required>
    <br><br>
    <input type="submit" value="Consultar">
</form>
