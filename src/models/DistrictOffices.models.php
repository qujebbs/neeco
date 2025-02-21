<?php
    require_once 'models/baseModel.models.php';
    class DistrictOffices extends BaseModel{
        public $districtId;
        public $districtName;
        public $hotline;
        public $contactNum;
        public $dcso;
        public $teller;
        public $stationLineman;
        public $districtPic;

        public function __construct($con) {
            parent::__construct($con, 'districtOffices', 'districtId');
        }

        public function insert(){
            $sql = "INSERT INTO {$this->table} (districtName, hotline, contactNum, DCSO, teller, stationLineman, districtPic) 
                    VALUES (:districtName, :hotline, :contactNum, :DCSO, :teller, :stationLineman, :districtPic";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":districtName", $this->districtName);
            $stmt->bindParam(":hotline", $this->hotline);
            $stmt->bindParam(":contactNum", $this->contactNum);
            $stmt->bindParam(":DCSO", $this->dcso);
            $stmt->bindParam(":teller", $this->teller);
            $stmt->bindParam(":stationLineman", $this->stationLineman);
            $stmt->bindParam(":districtPic", $this->districtPic);

            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update($id){
            $sql = "UPDATE {$this->table} SET districtName = :districtName, hotline = :hotline, contactNum = :contactNum, DCSO = :DCSO, teller = :teller, stationLineman = :stationLineman, districtPic = :districtPic WHERE districtId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":districtName", $this->districtName);
            $stmt->bindParam(":hotline", $this->hotline);
            $stmt->bindParam(":contactNum", $this->contactNum);
            $stmt->bindParam(":DCSO", $this->dcso);
            $stmt->bindParam(":teller", $this->teller);
            $stmt->bindParam(":stationLineman", $this->stationLineman);
            $stmt->bindParam(":districtPic", $this->districtPic);

            return $stmt->execute();
        }
    }