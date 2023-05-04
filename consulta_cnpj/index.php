<?php

if(isset($_POST['cnpj'])) {
    $cnpj = $_POST['cnpj'];
    $url = "https://www.receitaws.com.br/v1/cnpj/$cnpj";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Desativa a verificação do SSL
    $resultado = curl_exec($ch);
    curl_close($ch);

    $dados = json_decode($resultado, true);

    if($dados['status'] == 'ERROR') {
        echo "Erro: ".$dados['message'];
    } else {
        echo "Nome: ".$dados['nome']."<br>";
        echo "CNPJ: ".$dados['cnpj']."<br>";
        echo "Situação: ".$dados['situacao']."<br>";
    }
}

?>

<form method="post">
    <label for="cnpj">Coloque seu CNPJ:</label>
    <input type="text" name="cnpj" id="cnpj" required>
    <br><br>
    <input type="submit" value="Consultar">
</form>
