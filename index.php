<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ping Pong</title>
</head>

<body>
    <h1>
        <?php 
            if(! isset($_SESSION["vencedor"])) {
                if(! isset($_SESSION["jogador_da_vez"])) {
                    echo "Jogador da Vez: Jogador 1";
                } else {
                    echo "Jogador da Vez: " . $_SESSION["jogador_da_vez"];
                }
            } else {
                echo "Vencedor " . $_SESSION["vencedor"];
            }
        ?>
       
    </h1>

    <form action="#" method="GET">

        <label>Defina o placar</label>
        <input type="text" name="placar">

        <input type="submit" value="Enviar">

    </form>
</body>

</html>

<?php

include("vendor/autoload.php");

use App\Classes\Jogo;
use App\Classes\Jogador;

if(isset($_GET["placar"])) {
    $placar = $_GET["placar"];

    $placar = explode(":", $placar);

    $jogador1 = new Jogador(1, (int) $placar[0]);
    $jogador2 = new Jogador(2, (int) $placar[1]);
    
    $jogo = new Jogo([
        $jogador1,
        $jogador2
    ]);
    
    if($jogo->jogoEstaRolando($jogador1, $jogador2)) {
        $jogador_da_vez_id = $jogo->getJogadorDaVez($jogador1, $jogador2);

        if($jogador_da_vez_id == $jogador1->id) {
            $_SESSION["jogador_da_vez"] = "Jogador 1";
        } else {
            $_SESSION["jogador_da_vez"] = "Jogador 2";
        }

    } else {
        $vencedor_id = $jogo->getVencedor();

        if($vencedor_id == $jogador1->id) {
            $_SESSION["vencedor"] = "Jogador 1";
        } else {
            $_SESSION["vencedor"] = "Jogador 2";
        }
    }

    echo $_SESSION["qtd_lances_jogador_1"];


}


?>
