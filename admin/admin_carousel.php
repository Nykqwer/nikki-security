<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="icon/caro.png">
    <link rel="icon" href="icon/caro.png" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>ONLINE VOTING SYSTEM </title>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand text-uppercase fs-10">DEVELOPED ONLINE-BASED VOTING SYSTEM - DOBVS</a>
      <button class="navbar-toggler"  data-bs-toggle="collapse" data-bs-target="#list1">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="list1">
        <ul class="navbar-nav ms auto">
          <!-- Modified Sign In link -->
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--- Carousel Starter--->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/img1.jpg" class="d-block w-100" alt="slide1">
      </div>
      <div class="carousel-item">
        <img src="images/img0.png" class="d-block w-100" alt="slide2">
      </div>
      <div class="carousel-item">
        <img src="images/img4.jpg" class="d-block w-100" alt="slide3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!--- Carousel End--->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<style>
  .carousel-item {
    height: 100vh;
    max-height: 700px;
    background: no-repeat scroll center scroll;
    -webkit-background-size: cover;
    background-size: cover;
  }
</style>
</html>
