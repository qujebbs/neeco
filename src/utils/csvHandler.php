<?php

    //add error handling invalid csv || header or no deader?
    function readBillsCSV($csvFile) {

        $bills = [];
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $billData = [
                    "consumerId" => $data[0],
                    "billYearMonth"=> $data[1],
                    "billAmount"=> $data[2],
                    "kwhUsed"=> $data[3],
                    "orDate"=> $data[4],
                    "orAmount"=> $data[5],
                    "dueDate"=> $data[6],
                    "disconnectionDate"=> $data[7],
                ];

                $bill = new Bill($billData);

                $bills[] = $bill;
            }
            fclose($handle);
        } else {
            throw new Exception("Error opening file!");
        }
        return $bills;
    }