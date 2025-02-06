<?php

require_once ("modelo/Bebida.php");
require_once ("modelo/Calcool.php");
require_once ("modelo/Refrigerante.php");
require_once ("modelo/Suco.php");
require_once ("util/Conexao.php");
require_once ("dao/BebidaDAO.php");
//Teste da conexão
// require_once("util/Conexao.php");
// $con = Conexao::getCon();
// print_r($con);
$opcao = 0;

do {
    echo "\n--------------BEBIDARIA DO DAN--------------\n";
    echo "1- Inserir bebida\n";
    echo "2- Listar Bebidas\n";
    echo "3- Buscar Bebidas\n";
    echo "4- Excluir Bebidas\n";
    echo "5- Vender Bebidas\n";
    echo "6- Reabastecer Bebidas\n";
    echo "0- Sair\n";

    $opcao = readline("Escolha a opção que deseja: ");

    switch ($opcao) {
        case 1:
            $opcao2 = readline("Qual tipo de bebida deseja inserir? (A -> Alcoolica | R -> Refrigerante | S -> Suco):  ");
            if ($opcao2 === "A"){
            // Criar o objeto a ser persistido
            $bebida = new Calcool();
            $bebida->setNome(readline("Informe o nome: "));
            $bebida->setMl(readline("Informe o volume(ML): "));
            $bebida->setQuantidade(readline("Informe a Quantiade: "));
            $bebida->setPctAlcool(readline("Informe a % de alcool: "));
            // Chamar o método do DAO para persistir o objeto
            $bebidaDAO = new BebidaDAO();
            $bebidaDAO->inserirBebida($bebida);

            echo "Bebida cadastrada com sucesso!\n";
            }else if($opcao2 === "R"){
                $bebida = new Refrigerante();
                $bebida->setNome(readline("Informe o nome: "));
                $bebida->setMl(readline("Informe o volume(ML): "));
                $bebida->setQuantidade(readline("Informe a Quantiade: "));
                $bebida->setSabor(readline("Informe o sabor: "));
                // Chamar o método do DAO para persistir o objeto
                $bebidaDAO = new BebidaDAO();
                $bebidaDAO->inserirBebida($bebida);
    
                echo "Bebida cadastrada com sucesso!\n";
            }
            else if($opcao2 === "S"){
                $bebida = new Suco();
                $bebida->setNome(readline("Informe o nome: "));
                $bebida->setMl(readline("Informe o volume(ML): "));
                $bebida->setQuantidade(readline("Informe a Quantiade: "));
                $bebida->setSabor(readline("Informe o sabor: "));
                // Chamar o método do DAO para persistir o objeto
                $bebidaDAO = new BebidaDAO();
                $bebidaDAO->inserirBebida($bebida);
    
                echo "Bebida cadastrada com sucesso!\n";
            }
            break;

        case 2:
            $bebidaDAO = new BebidaDAO();
            $bebidas = $bebidaDAO->listarBebidas();

            break;


        case 3:
             // Buscar bebidas pelo id
             $id = readline("Informe o id do bebida que deseja buscar: ");
             $bebidaDAO = new BebidaDAO();
             $bebida = $bebidaDAO->buscarPorID($id);

             if ($bebida != null) {
                 echo $bebida;
             } else {
                 echo "Bebida não encontrado!\n";
             }
             break;

           
        case 4:
            // Excluir bebida
            $bebidaDAO = new BebidaDAO();
            $bebidas = $bebidaDAO->listarBebidas();

             $id = readline("Informe o ID do bebida que deseja excluir: ");


             $bebida = $bebidaDAO->buscarPorID($id);
             if ($bebida) { 
                $resultado = $bebidaDAO->excluirBebida($id);
                 echo "Cliente excluído com sucesso!\n";
             } else {
                echo "Erro ao excluir bebida!\n";
             }
             break;

             case 5:
                $bebidas = $bebidaDAO->listarBebidas();
                $id = readline("Informe o ID da bebida que deseja vender: ");
                $quantidade = readline("Informe a quantidade a vender: ");
                $bebidaDAO = new BebidaDAO();
                if ($bebidaDAO->venderBebida($id, $quantidade)) {
                    echo "Venda realizada com sucesso!\n";
                } else {
                    echo "Erro: Estoque insuficiente!\n";
                }
                break;
            
            
            case 6:
                $bebidas = $bebidaDAO->listarBebidas();
                $id = readline("Informe o ID da bebida para reabastecer: ");
                $quantidade = readline("Informe a quantidade a adicionar ao estoque: ");
                $bebidaDAO = new BebidaDAO();
                $bebidaDAO->reabastecerBebida($id, $quantidade);
                echo "Estoque atualizado com sucesso!\n";
                break;
            
        case 0:
            echo "\nPrograma encerrado!!\n";
            break;

        default:
            echo "\nOpção inválida\n";
            break;            
    }  

} while ($opcao != 0);
