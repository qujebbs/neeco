<? 
    require_once("src/config/db.php");
    require_once("src/models/BacModel.php");

    function createBac($con){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $bac = new Bac($_POST);
    
            $bacRepo = new BacRepo($con);
    
            $bacRepo->insert($bac);
    
            header("Location: views/unimplemented.php");
            exit;
        }
    }

    function updateBac($con) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $bac = new Bac($_POST);
    
            $bacRepo = new BacRepo($con);
    
            $id = $_POST['awardId'];
    
            $bacRepo->update($bac, $id);
    
            header("Location: views/unimplemented.php");
            exit;
        }
    }

    function deleteBac($con){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $bac = new Bac($_POST);
    
            $bacRepo = new BacRepo($con);
    
            $id = $_POST['awardId'];
    
            $bacRepo->delete($id);

            header("Location: views/unimplemented.php");
            exit;
    }
}

//NO VIEWS AND BAD ROUTING