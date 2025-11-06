<?php

    class Professor{
        private $id;
        private $nome;
        private $dataNascimento;
        private $sexo;
        private $usuario;
        private $senha;

        public function __construct()
        {
            
        }

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }
    }
