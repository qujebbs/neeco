<?php
    require_once __DIR__ . "/../../src/config/db.php";

    class BaseRepo {
        protected $con;
        protected $table;
        protected $primaryKey;
        private const ALLOWED_TABLES = [
            'accountStatus', 'accounts', 'awards', 'bac', 'bills', 'bod', 
            'complaitStatus', 'complaints', 'consumerPromptPayers', 
            'consumers', 'districtOffices',
            'downloads', 'employees', 'news', 'positions', 'rates', 
            'routes', 'services', 'staffs', 'towns', 'employees'
        ];

        public $limit = 1000;

        public function __construct(string $table, string $primaryKey) {
            if (!in_array($table, self::ALLOWED_TABLES)) {
                throw new InvalidArgumentException("Invalid table name: $table");
            }
            
            $this->table = $table;
            $this->primaryKey = $primaryKey;
            $this->con = getPDOConnection();
        }
        public function selectAll() {
            try {
                $stmt = $this->con->prepare("SELECT * FROM {$this->table}");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database Error in selectAll(): " . $e->getMessage());
                return [];
            }
        }

        public function selectOne($id) {
            try {
                $stmt = $this->con->prepare("
                    SELECT TOP 1 * 
                    FROM {$this->table} 
                    WHERE {$this->primaryKey} = :id
                ");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Database Error in selectOne(): " . $e->getMessage());
                return null;
            }
        }

        public function countAll(){
            try{
                $stmt = $this->con->prepare("SELECT COUNT(*) AS total FROM {$this->table}");

                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("Database error in countAll(): " . $e->getMessage());
                return null;
            }
        }

        public function delete($id) {
            try{
                $stmt = $this->con->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->debugDumpParams();
            }catch (PDOException $e){
                error_log("Database Error in delete(): " . $e->getMessage());
                return null;
            }
        }
    }