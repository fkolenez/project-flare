<?php
    require_once 'Conexao.class.php';

    class Auth extends Conexao {
        public function auth($name, $password) {
            $pdo = parent::getInstance();

            $sql = "SELECT id, password FROM users WHERE name = :name AND password = :password";
            $statement = $pdo->prepare($sql);

            $statement->bindParam(':name', $name);
            $statement->bindParam(':password', $password);

            $statement->execute();

            $vetor = $statement->fetchAll();

            // ve se achou o registro no banco
            if(count($vetor) > 0) {
                // compara se a senha informou 
                // é a mesma do banco, q agr ta hashada

                    // aqui cria a sessão
                    // redireciona se o usuário for encontrado

                    session_start();
                    $_SESSION['id'] = $vetor[0]['id'];
                    $_SESSION['user'] = date('Y/m/d');
                    header('Location: ../../view/pages/inicio.php');
            } else {
                // mensagem de erro se nenhum usuário for encontrado
                // tem q fazer uma pagina de erro ou um alert
                header('Location: ../../view/pages/login.php');
                $_SESSION['auth'] = "Usuário ou senha errados";
            }
        }

        public function authByKey($name, $passwordRecoveryKey) {
            $pdo = parent::getInstance();
        
            $sql = "SELECT id, password FROM users WHERE name = :name AND passwordRecoveryKey = :passwordRecoveryKey";
            $statement = $pdo->prepare($sql);
        
            $statement->bindParam(':name', $name);
            $statement->bindParam(':passwordRecoveryKey', $passwordRecoveryKey);
        
            $statement->execute();
        
            $vetor = $statement->fetchAll();
        
            // verifica se o registro foi encontrado
            if (count($vetor) > 0) {
                // cria a sessão e redireciona se o usuário for encontrado
                session_start();
                $_SESSION['id'] = $vetor[0]['id'];
                header('Location: ../../view/pages/changepassword.php');
            } else {
                // mensagem de erro se nenhum usuário for encontrado
                session_start();
                $_SESSION['auth'] = "Erro na autenticação";
                header('Location: ../../view/pages/login.php');
            }
        }
    }
?>
