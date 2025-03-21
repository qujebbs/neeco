<?php 
    require __DIR__ . '/../../repositories/TownsRepo.php';
    require __DIR__ . '/../../repositories/AccountRepo.php';
    require __DIR__ . '/../../repositories/ConsumerRepo.php';
    require __DIR__ . '/../../../utils/debugUtil.php';

    class RegisterHandler {
        private $townsRepo;
        private $accountRepo;
        private $consumerRepo;

        public function __construct() {
            $this->townsRepo = new TownsRepo();
            $this->accountRepo = new AccountRepo();
            $this->consumerRepo = new ConsumerRepo();
        }

        public function handleRequest(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET'){
                include __DIR__ . '/../../../public/views/register.php';
            }elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
                return $this->register();
            }else{
                echo "invalid request method";
            }
        }
        
        // Checks if registered account number is present in consumers then register the user
        public function register() {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo "Invalid request method";
                return;
            }

            if (empty($_POST['password']) || empty($_POST['accountNum'])) {
                echo "Password and account number are required.";
                return;
            }

            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $account = new Account($_POST);

            $filter = new ConsumerFilter([
                "accountNum" => $_POST['accountNum']
            ]);
            $user = $this->consumerRepo->selectByFilters($filter, 1);

            if ($user) {
                $inserted = $this->accountRepo->insert($account);
                    if ($inserted) {
                        echo "Account successfully registered.";
                    } else {
                        echo "Error: Failed to register the account. Please try again later.";
                        error_log("Account insertion failed for username: " . $account->username);
                    }
            } else {
                echo "Error: Account number does not exist.";
            }
        }

    }

    $registerHandler = new RegisterHandler();
    $registerHandler->handleRequest();