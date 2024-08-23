//============================================
//Details page details section
//============================================

// Dummy product data
const productData = {
  id: '0012',
  name: 'Lexar NS100 256GB 2.5" SATA III SSD',
  brand: 'lexar',
  category: 'Storage',
  subcategory: 'SSD',
  image: './img/products/007-storage.png',
  originalPrice: 7700.00,
  currentPrice: 7500.00,
  discountPercentage: 3,
  features: [
    'Upgrade your laptop or desktop computer for faster startups, data transfers, and application loads with read speeds of up to 550MB/s',
    'Faster performance and more reliable than traditional hard drives',
    'Features SSD dash software management'
  ],
  warranty: 2,
  sku: 'Lexar NS100 256GB 2.5" SATA III SSD',
  categories: ['Clearance sale', 'SSD'],
  tags: ['pny', 'SATA III SSD', 'ssd']
};

// update product details function
function updateProductDetails(product) {
  // Update breadcrumb
  const breadcrumb = document.getElementById('product-breadcrumb');
  breadcrumb.innerHTML = `
                <a href="/">Home</a> /
                <a href="/store">Store</a> /
                <a href="/store/pc-components">PC Components</a> /
                <a href="/store/pc-components/${product.category.toLowerCase()}">${product.category}</a> /
                <a href="/store/pc-components/${product.category.toLowerCase()}/${product.subcategory.toLowerCase()}">${product.subcategory}</a> /
                <br> ${product.name}
            `;

  // updating product image
  document.getElementById('product-image').src = product.image;
  document.getElementById('product-image').alt = product.name;

  // updating product title
  document.getElementById('product-title').textContent = product.name;

  // updating brand logo
  document.getElementById('brand-logo').src = `./img/logo/${product.brand}.png`;
  document.getElementById('brand-logo').alt = product.brand;

  // // updating prices
  document.getElementById('price-msr-price').textContent = `${product.originalPrice.toLocaleString(undefined,
    {'minimumFractionDigits':2,'maximumFractionDigits':2})}`;
  console.log(product.originalPrice);
  document.getElementById('price-discount-price').textContent = `${product.currentPrice.toLocaleString(undefined,
    {'minimumFractionDigits':2,'maximumFractionDigits':2})}`;

  // document.querySelector('.product-details-price .price-original').textContent = `රු. ${product.originalPrice.toLocaleString()}`;
  // document.querySelector('.product-details-price .price-current').textContent = `රු. ${product.currentPrice.toLocaleString()}`;


  // updating features
  const featuresList = document.getElementById('product-features');
  featuresList.innerHTML = product.features.map(feature => `<li>${feature}</li>`).join('');

  // updating warranty image
  document.getElementById('warranty-image').src = `./img/warranty-${product.warranty}year.png`;
  document.getElementById('warranty-image').alt = `${product.warranty} Year Warranty`;

  // updating SKU, categories, and tags
  document.getElementById('meta-sku').textContent = `${product.sku}`;
  document.getElementById('meta-categories').textContent = `${product.categories.join(', ')}`;
  // document.getElementById('meta-tags').textContent = `${product.tags.join(', ')}`;
  document.getElementById('meta-tags').innerHTML = `<a href="https://www.google.lk/search?q=${product.tags}">${product.tags}</a>}}`;

  // updating share links
  const currentUrl = encodeURIComponent(window.location.href);
  document.getElementById('share-facebook').href = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;
  document.getElementById('share-whatsapp').href = `https://wa.me/?text=${encodeURIComponent(product.name + ' - ' + window.location.href)}`;
  document.getElementById('share-linkedin').href = `https://www.linkedin.com/shareArticle?mini=true&url=${currentUrl}`;
  document.getElementById('share-telegram').href = `https://t.me/share/url?url=${currentUrl}&text=${encodeURIComponent(product.name)}`;
}

// Quantity control
const quantityInput = document.getElementById('quantity');
document.getElementById('quantity-minus').addEventListener('click', function () {
  if (quantityInput.value > 1) {
    quantityInput.value = parseInt(quantityInput.value) - 1;
  }
});
document.getElementById('quantity-plus').addEventListener('click', function ()  {
  quantityInput.value = parseInt(quantityInput.value) + 1;
});

// Initialize page
document.addEventListener('DOMContentLoaded', function () {
  updateProductDetails(productData);
});
