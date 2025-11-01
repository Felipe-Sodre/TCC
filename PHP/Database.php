<?php
//Classe Database
//Gerencia a conexão com o banco de dados MySQL usando PDO.
 
class Database {
    private $host;
    private $dbName;
    private $user;
    private $pass;
    private $charset;
    private $pdo;

    public function __construct($host, $dbName, $user, $pass, $charset = 'utf8mb4') {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->pass = $pass;
        $this->charset = $charset;
    }

        public function connect() {
        if ($this->pdo) {
            return $this->pdo; 
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
            // Registra o erro; para teste, exiba a mensagem
            echo "Erro de Conexão com o Banco de Dados: " . $e->getMessage();
            return null;
        }
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
   
    public function execute($sql, $params = []) {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
    
     //Fecha a conexão com o banco de dados.
   
    public function close() {
        $this->pdo = null;
    }
}
?>
