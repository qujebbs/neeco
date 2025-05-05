<?php 
include __DIR__ . '/../views/fragments/header.php';
?>

<body>

<style>
  .contact {
    padding: 40px 0;
    background: #fff;
  }

  .section-header h2 {
    font-size: 32px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
  }

  .info-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 30px;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
  }

  .info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
  }

  .info-item i {
    font-size: 24px;
    color: #4154f1;
    margin-right: 15px;
    flex-shrink: 0;
  }

  .info-item h4 {
    margin-bottom: 5px;
    font-size: 16px;
    font-weight: bold;
  }

  .info-item p {
    margin: 0;
    font-size: 14px;
  }
</style>

<section id="contact" class="contact">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Contact</h2>
    </div>

    <div class="info-container">
      <div class="info-item">
        <i class="bi bi-geo-alt"></i>
        <div>
          <h4>Location:</h4>
          <p>Calipahan, Talavera, Nueva Ecija</p>
        </div>
      </div>

      <div class="info-item">
        <i class="bi bi-envelope"></i>
        <div>
          <h4>Email:</h4>
          <p>neeco2@gmail.com</p>
        </div>
      </div>

      <div class="info-item">
        <i class="bi bi-phone"></i>
        <div>
          <h4>Call:</h4>
          <p>(044) 411 1007 / 958 0260 <br>
            0915-0816-960 Globe/Tm <br>
            0933-8231-894 Sun/Smart</p>
        </div>
      </div>

      <div class="info-item">
        <i class="bi bi-clock"></i>
        <div>
          <h4>Open Hours:</h4>
          <p>Mon-Fri: 8:00am To 5:00pm</p>
        </div>
      </div>
    </div>

  </div>
</section>

<?php include __DIR__ . '/../views/fragments/footer.php'; ?>
</body>
</html>
