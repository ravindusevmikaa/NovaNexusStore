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
  <link href="./css/main_details.css" rel="stylesheet">
  <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>-->

  <script crossorigin="anonymous" src="https://kit.fontawesome.com/dc6cb5dd0e.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <meta content="" name="description">
  <meta content="" property="og:title">
  <meta content="" property="og:type">
  <meta content="" property="og:url">
  <meta content="" property="og:image">
  <meta content="" property="og:image:alt">

  <link href="./favicon.ico" rel="icon" sizes="any">
  <link href="./icon.svg" rel="icon" type="image/svg+xml">
  <link href="./icon.png" rel="apple-touch-icon">

  <link href="./site.webmanifest" rel="manifest">
  <meta content="#000000" name="theme-color">

</head>

<body>

<?php include './template/header.html'; ?>

<?php $t = $_GET['test'];
//echo '<span>' . htmlspecialchars($t) . '</span>';
//echo "<span>$t</span>";
?>
<div class="section-wrapper">
  <div class="section-product-details">
    <div class="section-details-left">
      <div class="product-image">
        <img id="product-image" src="" alt="Product Image">
      </div>
    </div>
    <div class="section-details-right">
      <div class="product-breadcrumb" id="product-breadcrumb"></div>
      <div class="product-details">
        <div class="product-details-title">
          <h1 class="product-details-title-text" id="product-title"></h1>
          <div class="product-details-brand">
            <img id="brand-logo" src="" alt="Brand Logo">
          </div>
        </div>

        <div class="product-details-price">
          <div class="item-amount">
            <span class="price-unit">රු.</span>
            <span class="product-details-price-msr-price" id="price-msr-price"></span>
          </div>
          <div class="item-current-amount">
            <span class="price-unit">රු.</span>
            <span class="product-details-price-discount-price" id="price-discount-price"></span>
          </div>

<!--          <span class="price-current" id="price-current"></span>-->
        </div>
        <div class="product-details-features">
          <ul id="product-features"></ul>
        </div>
        <div class="product-details-warranty">
          <img id="warranty-image" src="" alt="Warranty">
        </div>
        <div class="product-details-actions">
          <div class="action-quantity-and-cart">
            <div class="quantity-control">
              <button id="quantity-minus">-</button>
              <input type="number" id="quantity" value="1" min="1">
              <button id="quantity-plus">+</button>
            </div>
            <button class="add-to-cart">ADD TO CART</button>
          </div>
          <div>
            <button class="add-to-wishlist">
              <i class="fas fa-heart"></i> ADD TO WISHLIST
            </button>
          </div>
        </div><br>
        <div class="product-details-meta">
          <div id="product-sku">
            <span class="meta-label">SKU: </span>
            <a class="meta-content meta-sku" id="meta-sku"></a>
          </div>
          <div id="product-categories">
            <span class="meta-label">Categories: </span>
            <a class="meta-content meta-categories" id="meta-categories"></a>
          </div>
          <div id="product-tags">
            <span class="meta-label">Tags: </span>
            <a class="meta-content meta-tags" id="meta-tags"></a>
          </div>
        </div>
        <div class="product-details-share">
          <span class="share-label meta-label">Share: </span>
          <a href="#" id="share-facebook" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="#" id="share-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
          <a href="#" id="share-linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
          <a href="#" id="share-telegram" target="_blank"><i class="fab fa-telegram"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include './template/footer.html'; ?>

<script src="./js/details.js"></script>
</body>

</html>
