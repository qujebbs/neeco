<?php
    require_once __DIR__ . "/../repositories/BaseRepo.php";
    require_once __DIR__ . "/../models/DownloadsModel.php";

    class DownloadsRepo extends BaseRepo{

        public function __construct() {
            parent::__construct('downloads', 'downloadId');
        }

        public function insert(Downloads $downloads){
            $sql = "INSERT INTO {$this->table} (pdfName, pdfTitle, uploadDate) VALUES (:pdfName, :pdfTitle, :uploadDate)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("pdfName", $downloads->pdfName);
            $stmt->bindParam("pdfTitle", $downloads->pdfTitle);
            $stmt->bindParam("uploadDate", $downloads->uploadDate);

            return $stmt->execute();
        }

        public function update(Downloads $downloads, $id){
            $sql = "UPDATE {$this->table} SET pdfName = :pdfName, pdfTitle = :pdfTitle, uploadDate = :uploadDate WHERE downloadId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":pdfName", $downloads->pdfName);
            $stmt->bindParam(":pdfTitle", $downloads->pdfTitle);
            $stmt->bindParam(":uploadDate", $downloads->uploadDate);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        }
    }