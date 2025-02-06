<?php

require_once("Bebida.php");


class Suco extends Bebida
{
    private string $sabor;

    public function getTipo()
    {
        return "S";
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
