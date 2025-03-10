<?php
    require_once 'BaseRepo.php';
    require_once 'neeco2/src/models/AwardModel.php';

    class AwardRepo extends BaseRepo{
            public function __construct() {
                parent::__construct('awards', 'awardId');
            }

            public function insert(Award $award){
                $sql = "INSERT INTO {$this->table} (awardType, awardName, awardFrom, awardDate) VALUES (:awardType, :awardName, :awardFrom, :awardDate)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam("awardType", $award->awardType);
                $stmt->bindParam("awardName", $award->awardName);
                $stmt->bindParam("awardFrom", $award->awardFrom);
                $stmt->bindParam("awardDate", $award->awardDate);

                return $stmt->execute();
            }

            public function selectByFilter(){
                die();
            }


            public function update(Award $award, $id){
                $sql = "UPDATE awards SET awardType = :awardType, awardName = :awardName, awardFrom = :awardFrom, awardDate = :awardDate WHERE awardId = :id";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(":awardType", $award->awardType);
                $stmt->bindParam(":awardName", $award->awardName);
                $stmt->bindParam(":awardFrom", $award->awardFrom);
                $stmt->bindParam(":awardDate", $award->awardDate);
                $stmt->bindParam(":id", $id);

                return $stmt->execute();
            }
        }