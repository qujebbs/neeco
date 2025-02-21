<?php
    require_once("models/baseModel.models.php");

    class Downloads extends BaseModel{
        public $pdfName;
        public $pdfTitle;
        public $uploadDate;

        public function __construct($con) {
            parent::__construct($con, 'downloads', 'downloadId');
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table} (pdfName, pdfTitle, uploadDate) VALUES (:pdfName, :pdfTitle, :uploadDate)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("pdfName", $this->pdfName);
            $stmt->bindParam("pdfTitle", $this->pdfTitle);
            $stmt->bindParam("uploadDate", $this->uploadDate);

            return $stmt->execute();
        }

        public function update($id){
            $sql = "UPDATE awards SET pdfName = :pdfName, pdfTitle = :pdfTitle, uploadDate = :uploadDate WHERE downloadId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":pdfName", $this->pdfName);
            $stmt->bindParam(":pdfTitle", $this->pdfTitle);
            $stmt->bindParam(":uploadDate", $this->uploadDate);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }