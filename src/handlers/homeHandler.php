<?php
    require_once("src/repositories/BodRepo.php");
    require_once("src/repositories/NewsRepo.php");
    require_once("src/repositories/StaffRepo.php");
    require_once("src/repositories/DistrictOfficesRepo.php");
    require_once("src/repositories/ServiceRepo.php");
    require_once("src/repositories/AwardRepo.php");
    require_once("src/repositories/ConsumerPayersRepo.php");
    require_once("src/repositories/BacRepo.php");



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
            "mission" => "views/mission.php",
            "company-profile" => "views/company-profile.php",
            "bod" => "views/board-of-directors.php",
            "staffs" => "views/view-staffs.php",
            "coverage-area" => "views/coverage-area.php",
            "district-offices" => "views/view-district-offices.php",
            "services" => "views/view-services.php",
            "news" => "views/view-news.php",
            "awards" => "views/view-awards.php",
            "consumer-payer" => "views/consumer-payer.php",
            "gm-corner" => "views/gm-corners.php",
            "rate" => "views/view-rate.php",//unimplemented
            "member-insurance" => "views/member-insurance.php",
            "safety" => "views/safety-tips.php",
            "contact" => "views/contact.php",
            "bacs" => "views/view-bac.php"
        ];

        $param = $_GET['section'] ?? "company-profile";

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

