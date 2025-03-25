<?php
    require_once __DIR__ . '/BaseRepo.php';
    require_once __DIR__ . '/../models/DistrictOfficesModel.php';
    class DistrictOfficesRepo extends BaseRepo{
        public function __construct() {
            parent::__construct('districtOffices', 'districtId');
        }

        public function insert(DistrictOffices $districtOffices) {
            $sql = "INSERT INTO {$this->table} (districtName, hotline, contactNum, DCSO, teller, stationLineman, districtPic) 
                    VALUES (:districtName, :hotline, :contactNum, :DCSO, :teller, :stationLineman, :districtPic)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":districtName", $districtOffices->districtName);
            $stmt->bindParam(":hotline", $districtOffices->hotline);
            $stmt->bindParam(":contactNum", $districtOffices->contactNum);
            $stmt->bindParam(":DCSO", $districtOffices->dcso);
            $stmt->bindParam(":teller", $districtOffices->teller);
            $stmt->bindParam(":stationLineman", $districtOffices->stationLineman);
            $stmt->bindParam(":districtPic", $districtOffices->districtPic);
            

            // return $stmt->debugDumpParams();
            return $stmt->execute();
        }

        public function selectByFilter(){
            die();
        }

        public function update(DistrictOffices $districtOffices, $id){
            $sql = "UPDATE {$this->table} SET districtName = :districtName, hotline = :hotline, contactNum = :contactNum, DCSO = :DCSO, teller = :teller, stationLineman = :stationLineman, districtPic = :districtPic WHERE districtId = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":districtName", $districtOffices->districtName);
            $stmt->bindParam(":hotline", $districtOffices->hotline);
            $stmt->bindParam(":contactNum", $districtOffices->contactNum);
            $stmt->bindParam(":DCSO", $districtOffices->dcso);
            $stmt->bindParam(":teller", $districtOffices->teller);
            $stmt->bindParam(":stationLineman", $districtOffices->stationLineman);
            $stmt->bindParam(":districtPic", $districtOffices->districtPic);

            return $stmt->execute();
        }
    }