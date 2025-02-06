<?php

require_once("Bebida.php");


class Refrigerante extends Bebida
{
    private string $sabor;

    public function getTipo()
    {
        return "R";
    }

    public function getA() {
        return $this->sabor;
    }

    /**
     * Get the value of sabor
     */
    public function getSabor(): string
    {
        return $this->sabor;
    }

    /**
     * Set the value of sabor
     */
    public function setSabor(string $sabor): self
    {
        $this->sabor = $sabor;

        return $this;
    }
}
