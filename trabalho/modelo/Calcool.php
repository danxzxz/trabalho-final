<?php

require_once("Bebida.php");


class Calcool extends Bebida
{

    private string $pctAlcool;


    public function getTipo()
    {
        return "A";
    }

    /**
     * Get the value of pctAlcool
     */
    public function getPctAlcool(): string
    {
        return $this->pctAlcool;
    }

    /**
     * Set the value of pctAlcool
     */
    public function setPctAlcool(string $pctAlcool): self
    {
        $this->pctAlcool = $pctAlcool;

        return $this;
    }
}
