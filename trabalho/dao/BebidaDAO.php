<?php

require_once("modelo/Bebida.php");
require_once("modelo/Calcool.php");
require_once("modelo/Suco.php");
require_once("modelo/Refrigerante.php");
require_once("util/Conexao.php");

class BebidaDAO
{

    public function inserirBebida(Bebida $bebida)
    {
        $sql = "INSERT INTO bebidas (tipo, nome, ml, quantidade, pctalcool, sabor) VALUES (?, ?, ?, ?, ?, ?)";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);

        $pctAlcool = null;
        $sabor = null;

        if ($bebida instanceof Calcool) {
            $pctAlcool = $bebida->getPctAlcool();
        } elseif ($bebida instanceof Refrigerante || $bebida instanceof Suco) {
            $sabor = $bebida->getSabor();
        }

        $stm->execute([
            $bebida->getTipo(),
            $bebida->getNome(),
            $bebida->getMl(),
            $bebida->getQuantidade(),
            $pctAlcool,
            $sabor
        ]);
    }



    public function venderBebida(int $id, int $quantidade)
    {
        $sql = "UPDATE bebidas SET quantidade = quantidade - ? WHERE id = ? AND quantidade >= ?";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute([$quantidade, $id, $quantidade]);
        return $stm->rowCount() > 0; // usado para ver quantas linhas foram afetadas pelo UPDATE 
        // se rowCount() retorna > 0, significa que o UPDATE realmente afetou alguma linha no banco, ou seja, a venda foi registrada.
    }


    public function reabastecerBebida(int $id, int $quantidade)
    {
        $sql = "UPDATE bebidas SET quantidade = quantidade + ? WHERE id = ?";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute([$quantidade, $id]);
    }



    public function listarBebidas()
    {
        $sql = "SELECT * FROM bebidas";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute();
        $registros = $stm->fetchAll();

        $bebidas = $this->mapBebidas($registros);
        return $bebidas;

        
    }



    public function buscarPorID(int $idBebida)
    {

        $con = Conexao::getCon();

        $sql = "SELECT * FROM bebidas WHERE id = ?";
        $stm = $con->prepare($sql);
        $stm->execute([$idBebida]);

        $registros = $stm->fetchAll();
        $bebidas = $this->mapBebidas($registros);

        if (count($bebidas) > 0)
            return $bebidas[0];

        return null;
    }

    public function excluirBebida(int $idBebida)
    {
        $con = Conexao::getCon();

        $sql = "DELETE FROM bebidas WHERE id = ?";
        $stm = $con->prepare($sql);
        $stm->execute([$idBebida]);

    }



    private function mapBebidas(array $registros)
    {
        $bebidas = array();
        foreach ($registros as $reg) {
            $bebida = null;
            if ($reg['tipo'] == 'A') {
                $bebida = new Calcool();
                $bebida->setPctAlcool($reg['pctAlcool']);
            } elseif ($reg['tipo'] == 'R') {
                $bebida = new Refrigerante();
                $bebida->setSabor($reg['sabor']);
            } elseif ($reg['tipo'] == 'S') {
                $bebida = new Suco();
                $bebida->setSabor($reg['sabor']);
            }
            $bebida->setId($reg['id']);
            $bebida->setNome($reg['nome']);
            $bebida->setMl($reg['ml']);
            array_push($bebidas, $bebida);
        }
        return $bebidas;
    }
}
