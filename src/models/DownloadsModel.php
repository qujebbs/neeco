<?php
    class Downloads{
        public $downloadsId;
        public $pdfName;
        public $pdfTitle;
        public $uploadDate;

        public function __construct($data = []) {
            $this->pdfName = $data['pdfName'] ?? null;
            $this->pdfTitle = $data['pdfTitle'] ?? null;
            $this->uploadDate = $data['uploadDate'] ?? null;
        }
    }