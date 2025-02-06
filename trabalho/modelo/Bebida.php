<?php

abstract class Bebida{

    protected int $id;
    protected string $nome;
    protected string $ml;
    protected int $quantidade = 0; 



    public abstract function getTipo();
    public abstract function getA();




    public function __toString() {
        return sprintf("%d- %s | %s | %s | %s \n",
                        $this->id, $this->getTipo(), $this->nome,
                        $this->ml, $this->getA());
    }
    


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of ml
     */
    public function getMl(): string
    {
        return $this->ml;
    }

    /**
     * Set the value of ml
     */
    public function setMl(string $ml): self
    {
        $this->ml = $ml;

        return $this;
    }

    /**
     * Get the value of tipo
     */
   



    /**
     * Get the value of quantidade
     */
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    /**
     * Set the value of quantidade
     */
    public function setQuantidade(int $quantidade): self
    {
        $this->quantidade = $quantidade;

        return $this;
    }
    }

