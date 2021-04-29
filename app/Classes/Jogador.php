<?php

namespace App\Classes;

class Jogador
{
    public $id, $pontuacao;

    public function __construct(
        int $id,
        int $pontuacao
    ) {
        $this->id = $id;
        $this->pontuacao = $pontuacao;
    }
}