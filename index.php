<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title></title>
  <link href="./css/style-boilerplate.css" rel="stylesheet">
  <link href="./css/style.css" rel="stylesheet">
  <link href="./css/header.css" rel="stylesheet">
  <link href="./css/footer.css" rel="stylesheet">
  <link href="./css/main.css" rel="stylesheet">
  <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>-->

  <script crossorigin="anonymous" src="https://kit.fontawesome.com/dc6cb5dd0e.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
          integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="./js/app.js"></script>


  <meta content="" name="description">
  <meta content="" property="og:title">
  <meta content="" property="og:type">
  <meta content="" property="og:url">
  <meta content="" property="og:image">
  <meta content="" property="og:image:alt">

  <link href="./favicon.ico" rel="icon" sizes="any">
  <link href="./icon.png" rel="icon" type="image/svg+xml">
  <link href="./icon.png" rel="apple-touch-icon">

  <link href="./site.webmanifest" rel="manifest">
  <meta content="#000000" name="theme-color">

  <style>
    .header {
      /*padding:0 2%;*/
    }
  </style>
</head>

<body>

<?php include './template/header.html'; ?>


<div class="section-carousel">
  <div class="carousel-container">

    <div class="carousel-slide active">
      <img alt="Slide 1" src="./img/slide1.jpg">
      <div class="carousel-slide-content">
        <div class="carousel-slide-content-background"></div>
        <div class="carousel-slide-content-text">
          <h2 class="resize-text">RTX 4090 24G</h2>
          <p>GIGABYTE</p>
        </div>
      </div>
    </div>
    <div class="carousel-slide">
      <img alt="Slide 2" src="./img/slide2.jpg">
      <div class="carousel-slide-content">
        <div class="carousel-slide-content-background"></div>
        <div class="carousel-slide-content-text">
          <h2 class="resize-text">Slide 2 Title</h2>
          <p>Slide 2 Description</p>
        </div>
      </div>
    </div>
    <div class="carousel-slide">
      <img alt="Slide 3" src="./img/slide3.jpg">
      <div class="carousel-slide-content">
        <div class="carousel-slide-content-background"></div>
        <div class="carousel-slide-content-text">
          <h2 class="resize-text">Slide 3 Title</h2>
          <p>Slide 3 Description</p>
        </div>
      </div>
    </div>
    <div class="carousel-slide">
      <img alt="Slide 4" src="./img/slide4.jpg">
      <div class="carousel-slide-content">
        <div class="carousel-slide-content-background"></div>
        <div class="carousel-slide-content-text">
          <h2 class="resize-text">Slide 4 Title</h2>
          <p>Slide 4 Description</p>
        </div>
      </div>
    </div>
  </div>

  <div class="carousel-indicators">
    <span class="indicator active"></span>
    <span class="indicator"></span>
    <span class="indicator"></span>
    <span class="indicator"></span>
  </div>

  <div class="carousel-arrows">
    <div class="arrow-icon arrows-left">
      <i class="fa-solid fa-chevron-left"></i>
    </div>
    <div class="arrow-icon arrows-right">
      <i class="fa-solid fa-chevron-right"></i>
    </div>
    <!--    <i class="fa-solid fa-chevron-left arrow-icon arrows-left"></i>-->
    <!--    <i class="fa-solid fa-chevron-right arrow-icon arrows-right"></i>-->
  </div>
</div>

<div class="section-category">
  <div class="section-category-title section-title">
    <span class="section-category-title-text">CATEGORY</span>
  </div>

  <div class="category-list-section">
    <!--    <div class="category-list-item">-->

    <!--    </div>-->
  </div>
</div>


<!--<div class="section-featured">-->
<!--  <div class="section-featured-title section-title">-->
<!--    <span class="section-featured-title-text">FEATURED</span>-->
<!--  </div>-->

<!--  <div class="featured-list-section">-->
<!--    <div class="featured-list-item">-->
<!--      <div class="featured-item-imageBox">-->
<!--        <div class="featured-item-imageBox-img">-->
<!--          <img src="./img/item-00001.jpg" alt="item000-1">-->
<!--        </div>-->
<!--        <div class="discount_badge">50%</div>-->
<!--      </div>-->
<!--      <div class="featured-item-text">-->
<!--        <span class="featured-item-text-name">Gigabyte Z790 Aorus Elite AX ATX Motherboard</span>-->
<!--        <div class="featured-item-text-price">-->
<!--          <div class="item-amount">-->
<!--            <span class="price_unit">රු. </span>-->
<!--            <span class="featured-item-text-msr_price">159,500.00</span>-->
<!--          </div>-->
<!--          <div class="item-current_amount" id="curentAmount">-->
<!--            <span class="price_unit">රු. </span>-->
<!--            <span class="featured-item-text-msr_price">145,000.00</span>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--  </div>-->

<!--</div>-->

<div class="section-featured">
  <div class="section-featured-title section-title">
    <span class="section-featured-title-text">FEATURED PRODUCTS</span>
  </div>
  <div class="featured-list-section">

  </div>
</div>


<?php include './template/footer.html'; ?>
<!--<footer class="footer-section">-->
<!--</footer>-->


</body>

</html>
