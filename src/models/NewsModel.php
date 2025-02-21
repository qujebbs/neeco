<?php

    class News{
        public $newsId;
        public $newsPic;
        public $newsTitle;
        public $newsDesc;
        public $employeeId;
        public $uploadDate;

        public function __construct($data = []) {
            $this->newsId = $data['newsId'] ?? null;
            $this->newsPic = $data['newsPic'] ?? null;
            $this->newsTitle = $data['newsTitle'] ?? null;
            $this->newsDesc = $data['newsDesc'] ?? null;
            $this->employeeId = $data['employeeId'] ?? null;
            $this->uploadDate = $data['uploadDate'] ?? null;
        }
    }