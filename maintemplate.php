<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website Title</title>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="maintemplate.css" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
    }

    .main-header {
      background-color: #fff;
      color: #333;
      padding: 10px 0;
    }

    .header-upper {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }

    .logo-outer {
      flex: 1;
    }

    .logo img {
      max-width: 100%;
      height: auto;
    }

    .upper-right {
      display: flex;
      align-items: center;
    }

    .info-box {
      margin-left: 20px;
      text-align: center;
    }

    .info-box .icon-box {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .theme-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #006622;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      text-align: right;
    }
    .container-fluid {
      display: block;
      padding: 10px 20px;
      background-color: #006622;
      color: #f2f2f2;
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
    }
  </style>
</head>
<body>

  <header class="main-header header-style-one">
    <!--Header-Upper-->
    <div class="header-upper">
       <div class="auto-container">
          <div class="clearfix">
             <div class="pull-left logo-outer">
                <div class="logo"><a href="index.php"><img src="https://neeco2area1.com/assets/file_manager/filemanager/source/Logo%20and%20Icon/NEECO_new_banner_5.png" alt="Neeco II - Area 1" title="Neeco II - Area 1" style="height: 80; width: 80%;"></a></div>
             </div>
             <div class="pull-right upper-right clearfix">
                <!--Info Box-->
                <div class="upper-column info-box"  style="text-align:left; position: absolute; top: 0; left: 330px ">
                   <div class="icon-box"><span class="flaticon-phone-call"></span></div>
                   <ul>
                      <li><strong>Call Now</strong></li>
                      <li>(044) 411 1007 / 958 0260 <br> 0915-0816-960 Globe/Tm <br/> 0933-8231-894 Sun/Smart</li>
                   </ul>
                </div>
                <!--Info Box-->
                <div class="upper-column info-box">
                   <div class="icon-box"><span class="flaticon-alarm-clock"></span></div>
                   <ul>
                      <li><strong>Business Hours</strong></li>
                      <li>Mon-Fri: 8:00am to 5:00pm</li>
                   </ul>
                </div>
                <!--Info Box-->
                <div class="upper-column info-box">
                   <div class="icon-box"><a href="index.php" class="theme-btn btn-style-two" style="font-size: 17px">Know your Bill</a></div>
                </div>
             </div>
          </div>
       </div>
    </div>
  </header>

  

</body>
</html>
