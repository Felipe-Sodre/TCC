<?php

 //Classe Database
 //Gerencia a conexão com o banco de dados MySQL
 class Database {
    private $host;
    private $dbName;
    private $user;
    private $pass;
    private $charset;
    private $pdo; //Objeto PDO

    public function __construct($host, $dbName, $user, $pass, $charset = 'utf8mb4') {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->pass = $pass;
        $this->charset = $charset;
    }

    
     //Conecta ao banco de dados
     
    public function connect() {
        if ($this->pdo) {
            return $this->pdo; // Já conectado
        }
        
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}";
        $options = [
            
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
           
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
            return $this->pdo;
        } catch (\PDOException $e) {
            //exceção para que o código chamador possa tratar o erro
            throw new Exception("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
        }
    }

   
    public function query($sql, $params = []) {
      
        $pdo = $this->connect();
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    
    public function execute($sql, $params = []) {
       
        $pdo = $this->connect();

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    //Fecha a conexão com o banco de dados.
         
    public function close() {
        $this->pdo = null;
    }
}
