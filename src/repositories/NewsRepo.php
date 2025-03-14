<?php
    require_once 'src/repositories/BaseRepo.php';
    require_once 'src/models/NewsModel.php';

    class NewsRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('news', 'newsId');
        }

        public function insert(News $news){
            $sql = "INSERT INTO {$this->table} (newsPic, newsTitle, newsDesc, employeeId, uploadDate) 
                    VALUES (:newsPic, :newsTitle, :newsDesc, :employeeId, :uploadDate)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":newsPic", $news->newsPic);
            $stmt->bindParam(":newsTitle", $news->newsTitle);
            $stmt->bindParam(":newsDesc", $news->newsDesc);
            $stmt->bindParam(":employeeId", $news->employeeId);
            $stmt->bindParam(":uploadDate", $news->uploadDate);

            return $stmt->execute();
        }

        public function getall() {
            $stmt = $this->con->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function selectByFilter(){
            die();
        }

        public function update(News $news, $id){
            $sql = "UPDATE {$this->table} SET newsPic = :newsPic, newsTitle = :newsTitle, newsDesc = :newsDesc, employeeId = :employeeId, uploadDate = :uploadDate WHERE newsId = :newsId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":newsPic", $news->newsPic);
            $stmt->bindParam(":newsTitle", $news->newsTitle);
            $stmt->bindParam(":newsDesc", $news->newsDesc);
            $stmt->bindParam(":employeeId", $news->employeeId);
            $stmt->bindParam(":uploadDate", $news->uploadDate);

            return $stmt->execute();
        }
    }