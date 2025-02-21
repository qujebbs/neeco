<?php
        class Bod{
            public $bodId;
            public $bodName;
            public $bodPosition;
            public $bodPicture;
            public $townId;
        
            public function __construct($data = []) {
                $this->bodId = $data['bodId'] ?? null;
                $this->bodName = $data['bodName'] ?? null;
                $this->bodPosition = $data['bodPosition'] ?? null;
                $this->bodPicture = $data['bodPicture'] ?? null;
                $this->townId = $data['townId'] ?? null;
            }
    }