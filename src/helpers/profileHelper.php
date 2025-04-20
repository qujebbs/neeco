<?php 
        require_once __DIR__ . "/../repositories/AccountRepo.php";
        require_once __DIR__ . "/../filters/AccountFilters.php";
        require_once __DIR__ . "/../repositories/ConsumerRepo.php";
        require_once __DIR__ . "/../repositories/EmployeeRepo.php";

        function getUserData(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $accountRepo = new AccountRepo();
            $consumerRepo = new ConsumerRepo();
            $employeeRepo = new EmployeeRepo();

            $consumerData = null;
            $employeeData = null;

            $accountFilter = new AccountFilter([
                "accountId"=> $_SESSION['accountId'],
            ]);

            $accountData = $accountRepo->selectByFilter($accountFilter);

            $consumerFilter = new ConsumerFilter([
                'consumerId'=> $accountData['consumerId'],
            ]);

            if(isset($_SESSION['consumerId'])){
                $consumerData = $consumerRepo->selectByFilters($consumerFilter);
            }else{
                $employeeData = $employeeRepo->getEmployeesById($_SESSION['employeeId']);
            }


            return [
                'consumerData' => $consumerData,
                'employeeData'=> $employeeData,
                'accountData' => $accountData,
            ];

        }