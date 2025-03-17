<?php
    require_once("src/repositories/BodRepo.php");
    require_once("src/repositories/NewsRepo.php");
    require_once("src/repositories/StaffRepo.php");
    require_once("src/repositories/DistrictOfficesRepo.php");
    require_once("src/repositories/ServiceRepo.php");
    require_once("src/repositories/AwardRepo.php");
    require_once("src/repositories/ConsumerPayersRepo.php");


class AboutUsHandler {

    private $repositories;

    public function __construct() {
        $this->repositories = [
            "bod" => new BodRepo(),
            "news" => new NewsRepo(),
            "staffs" => new StaffRepo(),
            "district-offices" => new DistrictOfficesRepo(),
            "services" => new ServiceRepo(),
            "awards" => new AwardRepo(),
            "consumer-payer" => new ConsumerPayersRepo()
        ];
    }

    public function loadAbout() {
        $params = [
            "mission" => "views/mission.php",
            "company-profile" => "views/company-profile.php",
            "bod" => "views/bod.php",
            "staffs" => "views/staffs.php",
            "coverage-area" => "views/coverage-area.php",
            "district-offices" => "views/district-offices.php",
            "services" => "views/services.php",
            "news" => "views/news.php",
            "awards" => "views/awards.php",
            "consumer-payer" => "views/consumer-payer.php"
        ];

        $param = $_GET['section'] ?? "mission";

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

$aboutHandler = new AboutUsHandler();
$aboutHandler->loadAbout();

