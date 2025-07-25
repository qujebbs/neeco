<?php
    require_once __DIR__ . '/BaseRepo.php';
    require_once __DIR__ . '/../models/RateModel.php';
    class RateRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('rates', 'rateId');
        }

        public function insert(Rate $rate){
                $sql = "INSERT INTO {$this->table} (pdf, date, rateType) VALUES (:pdf, :date, :rateType)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':pdf', $rate->pdf);
                $stmt->bindParam(':date', $rate->date);
                $stmt->bindParam(':rateType', $rate->rateType);
        
                return $stmt->execute();
        }

        public function selectByFilter($filter){
            die();
        }

        public function update(Rate $rate, $id){
            $sql = "UPDATE {$this->table} SET pdf = :pdf, [date] = :date, rateType = :rateType WHERE rateId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":pdf", $rate->pdf);
            $stmt->bindParam(":date", $rate->date);
            $stmt->bindParam(":rateType", $rate->rateType);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }