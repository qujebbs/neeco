<?php
    require_once "src/config/db.php";

    class BaseRepo {
        protected $con;
        protected $table;
        protected $primaryKey;

        public $limit = 100;

        public function __construct($table, $primaryKey = 'id') {
            $this->con = getPDOConnection();
            $this->table = $table;
            $this->primaryKey = $primaryKey;
        }

        public function selectAll() {
            $stmt = $this->con->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectOne($id) {
            $stmt = $this->con->prepare("SELECT TOP 1 * FROM {$this->table} WHERE {$this->primaryKey} = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function delete($id) {
            $stmt = $this->con->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount();
        }
    }