<?php
    require_once 'models/baseModel.models.php';
    class Rate extends BaseModel{
        public $rateId;
        public $pdf;
        public $date;
        public $rateType;

        public function __construct($con) {
            parent::__construct($con, 'rates', 'rateId');
        }

        public function insert(){
                $sql = "INSERT INTO {$this->table} (pdf, date, rateType) VALUES (:pdf, :date, :rateType)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':pdf', $this->pdf);
                $stmt->bindParam(':date', $this->date);
                $stmt->bindParam(':rateType', $this->rateType);
        
                return $stmt->execute();
        }

        public function selectByFilter($filter){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET pdf = :pdf, [date] = :date, rateType = :rateType WHERE rateId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":pdf", $this->pdf);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":rateType", $this->rateType);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }