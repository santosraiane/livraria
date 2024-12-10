<?php
function conecta_bd(){
    $PDO = new PDO('mysql:host=localhost;dbname=livraria;', 'root', '');
    return $PDO;
}
