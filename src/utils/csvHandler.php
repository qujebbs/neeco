<?php

    //add error handling invalid csv || header or no header?
    function readBillsCSV($csvFile) {
        $requiredHeaders = [
            "consumerid", "billyearmonth", "billamount", "kwhused",
            "ordate", "oramount", "duedate", "disconnectiondate"
        ];
    
        $bills = [];
    
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            $firstRow = fgetcsv($handle, 1000, ",");
    
            $normalized = array_map(fn($h) => strtolower(trim($h)), $firstRow);
            $isHeader = count(array_intersect($requiredHeaders, $normalized)) >= count($requiredHeaders);
    
            $headerMap = [];
    
            if ($isHeader) {
                foreach ($requiredHeaders as $requiredHeader) {
                    if (!in_array($requiredHeader, $normalized)) {
                        fclose($handle);
                        throw new Exception("CSV is missing required header: $requiredHeader");
                    }
                    $headerMap[$requiredHeader] = array_search($requiredHeader, $normalized);
                }
            } else {
                rewind($handle);
            }
    
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($isHeader) {
                    $billData = [
                        "consumerId"         => trim($data[$headerMap["consumerid"]]),
                        "billYearMonth"      => trim($data[$headerMap["billyearmonth"]]),
                        "billAmount"         => trim($data[$headerMap["billamount"]]),
                        "kwhUsed"            => trim($data[$headerMap["kwhused"]]),
                        "orDate"             => trim($data[$headerMap["ordate"]]),
                        "orAmount"           => trim($data[$headerMap["oramount"]]),
                        "dueDate"            => trim($data[$headerMap["duedate"]]),
                        "disconnectionDate"  => trim($data[$headerMap["disconnectiondate"]]),
                    ];
                } else {
                    if (count($data) < 8) {
                        fclose($handle);
                        throw new Exception("CSV row has missing fields. Expected at least 8 columns.");
                    }
    
                    $billData = [
                        "consumerId"         => trim($data[0]),
                        "billYearMonth"      => trim($data[1]),
                        "billAmount"         => trim($data[2]),
                        "kwhUsed"            => trim($data[3]),
                        "orDate"             => trim($data[4]),
                        "orAmount"           => trim($data[5]),
                        "dueDate"            => trim($data[6]),
                        "disconnectionDate"  => trim($data[7]),
                    ];
                }
    
                // ✅ Validate expected types
                if (!is_numeric($billData["billAmount"])) {
                    throw new Exception("Invalid billAmount: must be numeric.");
                }
                if (!is_numeric($billData["kwhUsed"])) {
                    throw new Exception("Invalid kwhUsed: must be numeric.");
                }
                if (!is_numeric($billData["orAmount"])) {
                    throw new Exception("Invalid orAmount: must be numeric.");
                }
    
                // Optional: validate date formats (basic check)
                foreach (["orDate", "dueDate", "disconnectionDate"] as $dateField) {
                    if (!strtotime($billData[$dateField])) {
                        throw new Exception("Invalid date format in $dateField: {$billData[$dateField]}");
                    }
                }
    
                // Optional: validate format of consumerId if needed
                // if (!is_numeric($billData["consumerId"])) {
                //     throw new Exception("Invalid consumerId: must be numeric.");
                // }
    
                $bill = new Bill($billData);
                $bills[] = $bill;
            }
    
            fclose($handle);
        } else {
            throw new Exception("Error opening file!");
        }
    
        return $bills;
    }

    function readConsumerCsv($csvFile) {
        $requiredHeaders = [
            "townid",
            "accountnum"
        ];
    
        // Removed "consumerid" from $allHeaders
        $allHeaders = [
            "townid", "routecode", "accountnum", "lastname", "firstname", 
            "midname", "suffix", "barangay", "profilepix", "backpix", "registrationdate", 
            "contactnum", "poleid", "metersrn", "employeename", "date", "time", 
            "transferrable", "email"
        ];
    
        $consumers = [];
    
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            $firstRow = fgetcsv($handle, 1000, ",");
    
            $normalized = array_map(fn($h) => strtolower(trim($h)), $firstRow);
            $isHeader = count(array_intersect($requiredHeaders, $normalized)) >= count($requiredHeaders);
    
            $headerMap = [];
    
            if ($isHeader) {
                foreach ($requiredHeaders as $requiredHeader) {
                    if (!in_array($requiredHeader, $normalized)) {
                        fclose($handle);
                        throw new Exception("CSV is missing required header: $requiredHeader");
                    }
                }
                foreach ($allHeaders as $header) {
                    $headerMap[$header] = array_search($header, $normalized);
                }
            } else {
                rewind($handle);
            }
    
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($isHeader) {
                    $consumerData = [
                        "townId"            => $data[$headerMap["townid"]] ?? null,
                        "routeCode"         => $data[$headerMap["routecode"]] ?? null,
                        "accountNum"        => $data[$headerMap["accountnum"]] ?? null,
                        "lastname"          => $data[$headerMap["lastname"]] ?? null,
                        "firstname"         => $data[$headerMap["firstname"]] ?? null,
                        "midname"           => $data[$headerMap["midname"]] ?? null,
                        "suffix"            => $data[$headerMap["suffix"]] ?? null,
                        "barangay"          => $data[$headerMap["barangay"]] ?? null,
                        "profilepix"        => $data[$headerMap["profilepix"]] ?? null,
                        "backpix"           => $data[$headerMap["backpix"]] ?? null,
                        "registrationDate"  => $data[$headerMap["registrationdate"]] ?? null,
                        "contactNum"        => $data[$headerMap["contactnum"]] ?? null,
                        "poleId"            => $data[$headerMap["poleid"]] ?? null,
                        "meterSRN"          => $data[$headerMap["metersrn"]] ?? null,
                        "employeeName"      => $data[$headerMap["employeename"]] ?? null,
                        "date"              => $data[$headerMap["date"]] ?? null,
                        "time"              => $data[$headerMap["time"]] ?? null,
                        "transferrable"     => $data[$headerMap["transferrable"]] ?? null,
                        "email"             => $data[$headerMap["email"]] ?? null,
                    ];
                } else {
                    if (count($data) < count($requiredHeaders)) {
                        fclose($handle);
                        throw new Exception("CSV row has missing fields. Expected at least the required columns.");
                    }
    
                    $consumerData = [
                        "townId"            => $data[1] ?? null,
                        "routeCode"         => $data[2] ?? null,
                        "accountNum"        => $data[3] ?? null,
                        "lastName"          => $data[4] ?? null,
                        "firstName"         => $data[5] ?? null,
                        "midName"           => $data[6] ?? null,
                        "suffix"            => $data[7] ?? null,
                        "barangay"          => $data[8] ?? null,
                        "profilePix"        => $data[9] ?? null,
                        "backPix"           => $data[10] ?? null,
                        "registrationDate"  => $data[11] ?? null,
                        "contactNum"        => $data[12] ?? null,
                        "poleId"            => $data[13] ?? null,
                        "meterSRN"          => $data[14] ?? null,
                        "employeeName"      => $data[15] ?? null,
                        "date"              => $data[16] ?? null,
                        "time"              => $data[17] ?? null,
                        "transferrable"     => $data[18] ?? null,
                        "email"             => $data[19] ?? null,
                    ];
                }
    
                // ✅ Validate required fields
                if (empty($consumerData["townId"])) {
                    throw new Exception("Missing required field: townId");
                }
                if (empty($consumerData["accountNum"])) {
                    throw new Exception("Missing required field: accountNum");
                }
    
                // Optional: validate date fields if needed
                if (!empty($consumerData["registrationDate"]) && !strtotime($consumerData["registrationDate"])) {
                    throw new Exception("Invalid date format in registrationDate: {$consumerData["registrationDate"]}");
                }
    
                // Don't include consumerId in the Consumer object
                unset($consumerData["consumerId"]);
    
                $consumer = new Consumer($consumerData);
                $consumers[] = $consumer;
            }
    
            fclose($handle);
        } else {
            throw new Exception("Error opening file!");
        }
    
        return $consumers;
    }
     
    