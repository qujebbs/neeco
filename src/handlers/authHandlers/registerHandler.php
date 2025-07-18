<?php 
    require __DIR__ . '/../../repositories/TownsRepo.php';
    require __DIR__ . '/../../repositories/AccountRepo.php';
    require __DIR__ . '/../../repositories/ConsumerRepo.php';
    require_once __DIR__ . '/../../filters/AccountFilters.php';
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

            $user = $this->consumerRepo->getByAccountNum($_POST['accountNum']);

            $account->consumerId = $user['consumerId'];
            $account->positionId = 1;
            $account->accountStatusId = 1;
            $account->townId = $user['townId'];
            $filter = new AccountFilter(["username" => $account->username]);
            $newFilter = new AccountFilter(["consumerId"=> $account->consumerId]);

            $emailIsActive = $this->accountRepo->findByEmail($account->email);
            $usernameIsActive = $this->accountRepo->selectByFilter($filter);
            $accountNumIsActive = $this->accountRepo->selectByFilter($newFilter);

            if ($emailIsActive) {
                include __DIR__ . '/../../../public/views/register.php';
                echo "<script>Swal.fire('Error', 'Email is already in use', 'error');</script>";
                return;
            }
            if ($usernameIsActive) {
                include __DIR__ . '/../../../public/views/register.php';
                echo "<script>Swal.fire('Error', 'Username is already in use', 'error');</script>";
                return;
            }
            if ($accountNumIsActive) {
                include __DIR__ . '/../../../public/views/register.php';
                echo "<script>Swal.fire('Error', 'Account Number is already in use', 'error');</script>";
                return;
            }

            if ($user) {
                $inserted = $this->accountRepo->insert($account);
                    if ($inserted) {
                        header("Location: /neeco2/login");
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