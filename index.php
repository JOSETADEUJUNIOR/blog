<?php

//Arquivo index responsável pela inicialização do sistema
require 'vendor/autoload.php';

require 'rotas.php';
/* 
$sessao = new sistema\Nucleo\Sessao();

$sessao->criar('usuario', ['id'=>10, 'nome' => 'Junior']);

var_dump($sessao->carregar()->usuario->nome);
echo '<hr>';
var_dump($sessao->checar('usuario'));
echo '<hr>';
$sessao->limpar('usuario');
var_dump($sessao->checar('usuario')); */