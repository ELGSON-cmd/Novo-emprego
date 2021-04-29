<?php

namespace App\Classes;

class Jogo
{
    /**
     * O vencedor do jogo
     * 
     * @var int $vencedor 
     */
    public $vencedor;

    public $lances_por_jogador = 4;
    public $diferenca_pontuacao_vencedor = 2;

    /**
     * Retorna se o jogo continua ou nao
     * Caso retorne nao, seta o vencedor do jogo
     *
     * @param Jogador $jogador1 O jogador 1
     * @param Jogador $jogador2 O jogador 2
     *
     * @return bool
     */
    public function jogoEstaRolando(Jogador $jogador1, Jogador $jogador2)
    {
        $pontuacao_jogador_1 = $jogador1->pontuacao;
        $pontuacao_jogador_2 = $jogador2->pontuacao;

        if($pontuacao_jogador_1 && $pontuacao_jogador_2 <= 21) {
            return true;
        } else {

            $diferenca_jogador_1 = $pontuacao_jogador_1 - $pontuacao_jogador_2;

            if($diferenca_jogador_1 >= $this->diferenca_pontuacao_vencedor) {

                $this->setVencedor($jogador1->id);
                return false;

            } else {
                $diferenca_jogador_2 = $pontuacao_jogador_2 - $pontuacao_jogador_1;

                if($diferenca_jogador_2 >= $this->diferenca_pontuacao_vencedor) {

                    $this->setVencedor($jogador2->id);
                    return false;

                }

                return true;
            }

        }
    }
    
    /**
     * Retorna o id do jogador da vez
     *
     * @param Jogador $jogador1 
     * @param Jogador $jogador2 
     *
     * @return int
     */
    public function getJogadorDaVez(Jogador $jogador1, Jogador $jogador2)
    {
        if($this->getQtdLancesJogador1() < $this->lances_por_jogador) {

            $this->addLanceJogador1();

            // $_SESSION["qtd_lances_jogador_2"] = 0;

            return $jogador1->id;

        } else {

            if($this->getQtdLancesJogador2() < $this->lances_por_jogador) {

                $this->addLanceJogador2();

                return $jogador2->id;

            } else {

                // $_SESSION["qtd_lances_jogador_1"] = 0;
                return $jogador1->id;

            }
      
        }

    }

        
    /**
     * Define o vencedor do jogo
     *
     * @param int $vencedor_id - O id do jogador vencedor
     *
     * @return void
     */
    public function setVencedor(int $vencedor_id)
    {
        $this->vencedor = $vencedor_id;
    }
    
    /**
     * Obtem o ID do jogador vencedor
     *
     * @return void
     */
    public function getVencedor()
    {
        return $this->vencedor;
    }

    public function addLanceJogador1()
    {
        $qtd_lances_atual = $this->getQtdLancesJogador1();

        return $this->setQtdLancesJogador1($qtd_lances_atual + 1);
    }

    public function addLanceJogador2()
    {
        $qtd_lances_atual = $this->getQtdLancesJogador2();

        return $this->setQtdLancesJogador2($qtd_lances_atual + 1);
    }

    public function getQtdLancesJogador1()
    {
        if(isset($_SESSION["qtd_lances_jogador_1"]) == false) {
            $_SESSION["qtd_lances_jogador_1"] = 0;
        }

        return $_SESSION["qtd_lances_jogador_1"];
    }

    public function getQtdLancesJogador2()
    {
        if(isset($_SESSION["qtd_lances_jogador_2"]) == false) {
            $_SESSION["qtd_lances_jogador_2"] = 0;
        }

        return $_SESSION["qtd_lances_jogador_2"];
    }

    public function setQtdLancesJogador1(int $qtd)
    {
        return $_SESSION["qtd_lances_jogador_1"] = $qtd;
    }

    public function setQtdLancesJogador2(int $qtd)
    {
        return $_SESSION["qtd_lances_jogador_2"] = $qtd; 
    }


}

?>
