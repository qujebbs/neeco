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
    