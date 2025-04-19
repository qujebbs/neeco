<?php
    require_once __DIR__ . "/../repositories/BodRepo.php";
    require_once __DIR__ . "/../repositories/NewsRepo.php";
    require_once __DIR__ . "/../repositories/StaffRepo.php";
    require_once __DIR__ . "/../repositories/DistrictOfficesRepo.php";
    require_once __DIR__ . "/../repositories/ServiceRepo.php";
    require_once __DIR__ . "/../repositories/AwardRepo.php";
    require_once __DIR__ . "/../repositories/ConsumerPayersRepo.php";
    require_once __DIR__ . "/../repositories/BacRepo.php";
    require_once __DIR__ . "/../middlewares/AuthMiddleware.php";



class HomeHandler {

    private $repositories;

    public function __construct() {
        $this->repositories = [
            "bod" => new BodRepo(),
            "news" => new NewsRepo(),
            "staffs" => new StaffRepo(),
            "district-offices" => new DistrictOfficesRepo(),
            "services" => new ServiceRepo(),
            "awards" => new AwardRepo(),
            "consumer-payer" => new ConsumerPayersRepo(),
            "bacs" => new BacRepo()
        ];
    }

    public function loadAbout() {
        $params = [
            "mission" => __DIR__ . "/../../public/views/mission.php",
            "landing" => __DIR__ . "/../../public/views/landing.php",
            "company-profile" => __DIR__ . "/../../public/views/company-profile.php",
            "bod" => __DIR__ . "/../../public/views/board-of-directors.php",
            "staffs" => __DIR__ . "/../../public/views/view-staffs.php",
            "coverage-area" => __DIR__ . "/../../public/views/coverage-area.php",
            "district-offices" => __DIR__ . "/../../public/views/view-district-offices.php",
            "services" => __DIR__ . "/../../public/views/view-services.php",
            "news" => __DIR__ . "/../../public/views/view-news.php",
            "awards" => __DIR__ . "/../../public/views/view-awards.php",
            "consumer-payer" => __DIR__ . "/../../public/views/consumer-payer.php",
            "gm-corner" => __DIR__ . "/../../public/views/gm-corners.php",
            "rate" => __DIR__ . "/../../public/views/view-rate.php",//unimplemented
            "member-insurance" => __DIR__ . "/../../public/views/member-insurance.php",
            "safety" => __DIR__ . "/../../public/views/safety-tips.php",
            "contact" => __DIR__ . "/../../public/views/contact.php",
            "bacs" => __DIR__ . "/../../public/views/view-bac.php"
        ];

        $param = $_GET['section'] ?? "landing";

        if (!isset($params[$param])) {
            http_response_code(400);
            echo "Invalid Request.";
            exit;
        }

        $data = [
            'news' => $this->repositories['news']->selectAll()
        ];


        if (isset($this->repositories[$param])) {
            $data[str_replace('-', '_', $param)] = $this->repositories[$param]->selectAll();
        }

        extract($data);

        include $params[$param];
    }
}

$aboutHandler = new HomeHandler();
$aboutHandler->loadAbout();

