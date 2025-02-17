<?php
    require_once 'models/baseModel.models.php';

    class News extends BaseModel{
        public $newsId;
        public $newsPic;
        public $newsTitle;
        public $newsDesc;
        public $employeeId;
        public $uploadDate;

        public function __construct($con) {
            parent::__construct($con, 'news', 'newsId');
        }

        public function insert($news){
            $sql = "INSERT INTO {$this->table} (newsPic, newsTitle, newsDesc, employeeId, uploadDate) 
                    VALUES (:newsPic, :newsTitle, :newsDesc, :employeeId, :uploadDate)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":newsPic", $this->newsPic);
            $stmt->bindParam(":newsTitle", $this->newsTitle);
            $stmt->bindParam(":newsDesc", $this->newsDesc);
            $stmt->bindParam(":employeeId", $this->employeeId);
            $stmt->bindParam(":uploadDate", $this->uploadDate);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET newsPic = :newsPic, newsTitle = :newsTitle, newsDesc = :newsDesc, employeeId = :employeeId, uploadDate = :uploadDate WHERE newsId = :newsId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":newsPic", $this->newsPic);
            $stmt->bindParam(":newsTitle", $this->newsTitle);
            $stmt->bindParam(":newsDesc", $this->newsDesc);
            $stmt->bindParam(":employeeId", $this->employeeId);
            $stmt->bindParam(":uploadDate", $this->uploadDate);

            return $stmt->execute();
        }
    }