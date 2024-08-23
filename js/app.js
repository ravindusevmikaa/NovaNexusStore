// carousel animation
document.addEventListener('DOMContentLoaded', function () {
  const slides = document.querySelectorAll('.carousel-slide');
  const indicators = document.querySelectorAll('.indicator');
  const sliderArrows = document.querySelectorAll('.arrow-icon');
  let currentSlide = 0;
  let timer = 5000;

  function showSlide(index) {
    slides[currentSlide].classList.remove('active');
    indicators[currentSlide].classList.remove('active');
    currentSlide = (index + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
    indicators[currentSlide].classList.add('active');
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  // let slider = setInterval(nextSlide, timer);  // Change slide every 10 seconds

  indicators.forEach(function (indicator, index) {
    indicator.addEventListener('click', function () {
      showSlide(index);
      //reset slider timer
      clearInterval(slider);
      slider = setInterval(nextSlide, timer);
    });
  });

  sliderArrows.forEach(function (arrow, index) {
    arrow.addEventListener('click', function () {
      if (index === 1) {
        nextSlide();
      } else {
        prevSlide();
      }
      //reset slider timer
      clearInterval(slider);
      slider = setInterval(nextSlide, timer);
    })
  });

});


// document.querySelector('.resize-text').forEach(function(){
//   let el= document.querySelector(this);
//   let textLength = el.html().length;
//   if (textLength > 5) {
//     el.css('font-size', '0.8em');
//   }
// });


// ================================================
// Category Item creator
// ================================================


document.addEventListener('DOMContentLoaded', function () {
  const categoryNames = ['MOTHERBOARD', 'GRAPHIC CARDS', 'PROCESSORS', 'MEMORY', 'KEYBOARDS', 'POWER SUPPLY', 'STORAGE', 'MONITORS', 'MOUSE', 'HEADPHONE', 'CASING', 'RGB PERIPHERAL'];
  const categoryImagesPath = './img/';
  const categoryListSection = document.querySelector('.category-list-section');
  const extraItemsPerSide = 3;
  let itemsPerRow = 0;
  if (window.innerWidth > 1500) {
    itemsPerRow = 5;
  } else {
    itemsPerRow = 4;
  }

  function createCategoryItem(name, isExtra = false) {
    const item = document.createElement('div');
    item.className = 'category-list-item';

    const background = document.createElement('div');
    background.className = 'category-list-item-background';


    if (!isExtra) {
      const imageName = `catg_${name.toLowerCase().replace(/ /g, '_')}.jpg`;
      background.classList.add('unskew_background');

      // let imgURL = 'url(' + categoryImagesPath+imageName + ')';
      // background.style.backgroundImage = imgURL;
      // background.style.backgroundImage = `url('${categoryImagesPath}${imageName}')`;
      // background.style.setProperty('--img_url', imgURL);
      background.style.setProperty('--img_url', `url(.${categoryImagesPath}${imageName})`);

      const label = document.createElement('span');
      label.className = 'category-list-item-label';
      label.textContent = name;
      item.appendChild(label);
    } else {
      background.style.backgroundColor = 'rgb(50 50 50 / 45%)';
    }

    item.appendChild(background);
    return item;
  }

  let rowIncrement = 0;

  function createCategoryRow(startIndex) {
    const row = document.createElement('div');
    rowIncrement += 1;
    row.className = 'category-list-row row' + rowIncrement;
    // add empty items before category
    for (let i = 0; i < extraItemsPerSide; i++) {
      row.appendChild(createCategoryItem('', true));
    }

    // add category items
    for (let i = 0; i < itemsPerRow; i++) {
      const index = startIndex + i;
      if (index < categoryNames.length) {
        row.appendChild(createCategoryItem(categoryNames[index]));
      }
    }

    // add empty items after category
    for (let i = 0; i < extraItemsPerSide; i++) {
      row.appendChild(createCategoryItem('', true));
    }

    return row;
  }

  function populateCategorySection() {
    for (let i = 0; i < categoryNames.length; i += itemsPerRow) {
      categoryListSection.appendChild(createCategoryRow(i));
    }
  }

  populateCategorySection();
});


// ================================================
// Featured Products creator
// ================================================

document.addEventListener('DOMContentLoaded', function() {
  // dummy data arrays
  const productIds = ['001', '002', '003', '004', '005', '006', '007', '008'];
  const productNames = [
    'Genius HS-M910BT Wireless Earbuds - Black',
    'Genius GX Speed P100 Gaming Mouse Pad',
    'Micropack CCH-01 Athena Gaming Chair',
    'Gigabyte Z790 Aorus Elite AX ATX Motherboard',
    'MSI Modern 15 B12M (12th Gen Core i5) Windows 11 Pro Business Laptop',
    'ASUS VA27EHF 27" IPS 100HZ Frameless Monitor',
    'Gigabyte AORUS GeForce RTX 4060 Ti Elite 8G Graphics Card',
    'Gigabyte G32QC 32" Curved 2K QC 170Hz Gaming Monitor'
  ];
  // const categories = ['Audio', 'Accessories', 'Furniture', 'Motherboard', 'Laptop', 'Monitor', 'Graphics Card', 'Monitor'];
  const categories = ['MOTHERBOARD', 'GRAPHIC CARDS', 'PROCESSORS', 'MEMORY', 'KEYBOARDS', 'POWER SUPPLY', 'STORAGE', 'MONITORS', 'MOUSE', 'HEADPHONE', 'CASING', 'RGB PERIPHERAL'];
  const actualPrices = [5200.00, 1950, 5900.000, 159500.00, 22500.000, 44500.00, 11600.000, 135900.00];
  const discountPrices = [3800.00, 1500.00, 4200.000, 14500.000, 20900.000, 39900.00, 11300.000, 12900.000];
  const discountPercentages = [26, 23, null, 9, 7, null, 2, 17];

  function generateImageFilename(productId, category) {
    return `${productId}-${category.replace(/\s+/g, '-')}.png`;
  }

  function createProductItem(index) {
    const productId = productIds[index];
    const productName = productNames[index];
    const category = categories[index];
    const actualPrice = actualPrices[index];
    const discountPrice = discountPrices[index];
    const discountPercentage = discountPercentages[index];
    const imageFilename = generateImageFilename(productId, category);

    let itemAmountSegment = ``;
    let itemDiscountbadge = ``;

    const item = document.createElement('div');
    item.className = 'featured-list-item';

    if (discountPercentage !== null) {
      itemAmountSegment = `<div class="item-amount">
                        <span class="price-unit">රු.</span>
                        <span class="featured-item-text-msr-price">${actualPrice.toLocaleString(undefined,
        {'minimumFractionDigits':2,'maximumFractionDigits':2})}</span>
                    </div>`;
      itemDiscountbadge = `<div class="discount-badge">
                    <span class="discount-badge-value">-${discountPercentage}%</span>
                </div>`;
    }


    item.innerHTML = `
            <div class="featured-item-imageBox">
                <div class="featured-item-imageBox-img">
                    <img src="./img/products/${imageFilename}" alt="${productName}">
                </div>
                ${itemDiscountbadge}
                <div class="hover-options option-1">
                    <button class="add-to-cart">
                        <div class="add-to-cart-text">
                            <span>ADD TO CART</span>
                            <span class="fa-solid fa-cart-shopping cart-icon">
                        </div>
                    </button>
                </div>
                <div class="hover-options quick-options">
                    <span class="wishlist-icon"><i class="fas fa-heart"></i></span>
                    <span class="quickview-icon"><i class="fas fa-search"></i></span>
                </div>
            </div>
            <div class="featured-item-text">
                <span class="featured-item-text-name">${productName}</span>
                <div class="featured-item-text-price">
                    ${itemAmountSegment}
                    <div class="item-current-amount">
                        <span class="price-unit">රු.</span>
                        <span class="featured-item-text-discount-price">${discountPrice.toLocaleString(undefined,
      {'minimumFractionDigits':2,'maximumFractionDigits':2})}</span>
                    </div>
                </div>
            </div>
        `;

    return item;
  }

  function populateFeaturedProducts() {
    const featuredListSection = document.querySelector('.featured-list-section');
    productIds.forEach((_, index) => {
      featuredListSection.appendChild(createProductItem(index));
    });
  }

  populateFeaturedProducts();
});



//============================================
//Details page details section
//============================================

