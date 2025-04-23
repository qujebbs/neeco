<?php
    class Downloads{
        public $downloadsId;
        public $pdfName;
        public $downloadsTitle;
        public $uploadDate;

        public function __construct($data = []) {
            $this->pdfName = $data['pdfName'] ?? null;
            $this->downloadsTitle = $data['title'] ?? null;
            $this->uploadDate = $data['uploadDate'] ?? null;
        }
    }