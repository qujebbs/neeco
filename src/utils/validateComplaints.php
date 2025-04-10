<?php
    require_once __DIR__ . "/../repositories/EmployeeRepo.php";

    function validateComplaint(Complaint $complaint): array {
        $errors = [];
    
        if (empty($complaint->employeeId)) {
            $errors[] = 'Employee is required.';
        }
    
        if (empty($complaint->statusId)) {
            $errors[] = 'Complaint status is required.';
        }

        if (empty($complaint->townId)) {
            $errors[] = 'Complaint town is required.';
        }
    

        if (!empty($complaint->employeeId) && !empty($complaint->statusId)) {
            $employeeRepo = new EmployeeRepo();
            $employeeData = $employeeRepo->getEmployeesById($complaint->employeeId);
    
            if (empty($employeeData)) {
                $errors[] = "Employee with ID {$complaint->employeeId} not found.";
            } else {
                $employee = new Employees($employeeData[0]);
    
                $statusId = $complaint->statusId;
                $positionId = (int) $employee->positionId;

                $solverPositions = [3, 4, 5, 6, 8, 9, 10];
    
                if ($statusId == 1 && $positionId != 7) {
                    $errors[] = "Status 'received' requires the employee to be of position DCSO.";
                }
    
                if (in_array($statusId, [2, 3]) && !in_array($positionId, $solverPositions)) {
                    $errors[] = "Status 'unattended' or 'solved' requires the employee to be of position employee.";
                }
            }
        }
    
        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    //SHOULD CHECK IF:
    //complaint has townId, employeeId, statusId
    //statusID corresponds to employeeId position

    
    