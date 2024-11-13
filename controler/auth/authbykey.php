<?php
    require_once '../../model/auth.class.php'; // inclui o arquivo da classe Auth

    // verifica se os dados do form foram enviados
    if(isset($_POST["name"]) && isset($_POST["passwordRecoveryKey"])) {

        $name = $_POST["name"];
        $passwordRecoveryKey = $_POST["passwordRecoveryKey"];
        echo "vai tomar no cu corona";


        // cria uma instância da class auth
        $auth = new Auth();
        // chama o método auth da class auth
        $auth->authByKey($name, $passwordRecoveryKey);
    }
?>
