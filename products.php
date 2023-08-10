<!-- products.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="nav.css">
  </head>
  <body>
    <?php include 'header.html' ?>
   
    <main class="container mt-4">
    <div id="carouselExampleControls" class="carousel slide mb-4" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="admin-page/img/pv.webp" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
              <img src="admin-page/img/iop.webp" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
              <img src="admin-page/img/tred.jpg" class="d-block w-100" alt="Slide 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                <div class="card mb-4">
                    <div class="card-header">Filters</div>
                    <div class="card-body">
                        <h6>Price</h6>
                        <input type="range" class="form-range" min="0" max="1000" step="10" id="priceRange" oninput="updatePriceRangeValue(this.value);">
                        <p id="priceRangeValue">$0 - $2000</p>
                        
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">category</div>
                    <div class="card-body">
                    <select class="form-select" id="categorySelect">
                    <option value="b" selected></option>
  <option value="all-categories" >All categories</option>
  <option value="phones">Phone</option>
  <option value="laptops">Laptop</option>
  <option value="headphones">Headphone</option>
  <option value="chargers">Charg</option>
</select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                       require_once 'config.php';
                        
                        $sql = "SELECT id, name, image, price FROM products";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                                echo '<div class="col mb-4">';
                                echo '<div class="card product-card h-100">';
                               
                                echo '<img src="admin-page/img/' . $row["image"] . '" class="card-img-top" alt="' . $row["name"] . '">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                                echo '<p class="card-text">$' . $row["price"] . '</p>';
                                echo '</div>';
                                echo "<button class='add-to-cart' data-product-id='" . $row["id"] . "'>Add to cart</button>";
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "0 results";
                        }
                        
                        $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </main>
    
   
    <script>
      document.getElementById('priceRange').addEventListener('input', function() {
  filterProductsByPrice(this.value);
});

      function filterProductsByPrice(maxPrice) {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', `filter_products_by_price.php?maxPrice=${maxPrice}`, true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      updateProductList(xhr.responseText);
    }
  };
  xhr.send();
}

      function updateProductList(productsHtml) {
  const productListContainer = document.querySelector('.row-cols-1');
  productListContainer.innerHTML = productsHtml;
}
    // main.js
document.addEventListener('DOMContentLoaded', function() {
  const addToCartButtons = document.querySelectorAll('.add-to-cart');

  addToCartButtons.forEach(button => {
    button.addEventListener('click', addToCart);
  });
});

function addToCart(event) {
  const productId = event.target.dataset.productId;
  const clientId = 1; // Assuming you have a way to identify the current client

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'add_to_cart.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(`productId=${productId}&clientId=${clientId}`);
}
             
  function updatePriceRangeValue(val) {
    document.getElementById("priceRangeValue").innerHTML = "$0 - $" + val;
  }

 
  document.getElementById('categorySelect').addEventListener('change', function() {
  const selectedCategory = this.value;
  let categoryPageURL;

  switch (selectedCategory) {
    case 'all-categories':
      categoryPageURL = 'products.php';
      break;
    case 'phones':
      categoryPageURL = 'phone.php';
      break;
    case 'laptops':
      categoryPageURL = 'laptop.php';
      break;
    case 'headphones':
      categoryPageURL = 'headphones_page.php';
      break;
    case 'chargers':
      categoryPageURL = 'chargers_page.php';
      break;
  }

  if (categoryPageURL) {
    window.location.href = categoryPageURL;
  }
});
            
        </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <?php include 'footer.php' ?>
</body>
</html>