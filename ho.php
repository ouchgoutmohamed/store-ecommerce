<html>
<head>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"><!-- Custom CSS -->
    <style>
        /* Parallax effect */
        .parallax {
            background-image: url("admin-page/img/pgh.jpg");
            min-height: 500px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Parallax caption */
        .parallax-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color:white;
            font-size: 4rem;
  font-weight: bold;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        /* New products section */
        .new-products {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* New products title */
        .new-products-title {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }

        /* New products cards */
        .new-products-card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        /* New products card hover effect */
        .new-products-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* New products card image */
        .new-products-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* New products card body */
        .new-products-card-body {
            padding: 16px;
        }

        /* New products card title */
        .new-products-card-title {
            font-size: 24px;
            font-weight: bold;
        }

        /* New products card price */
        .new-products-card-price {
            color: green;
            font-size: 20px;
            font-weight: bold;
        }

        /* Most selling products section */
        .most-selling-products {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        /* Most selling products title */
        .most-selling-products-title {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }

        /* Most selling products cards */
        .most-selling-products-card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        /* Most selling products card hover effect */
        .most-selling-products-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Most selling products card image */
        .most-selling-products-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Most selling products card body */
        .most-selling-products-card-body {
            padding: 16px;
        }

         /* Most selling products card title */
         .most-selling-products-card-title {
             font-size: 24px;
             font-weight: bold;
         }
 
         /* Most selling products card price */
         .most-selling-products-card-price {
             color: green;
             font-size: 20px;
             font-weight: bold;
         }
         @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
}

.promo-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    justify-items: center;
    align-items: center;
    background-image: linear-gradient(to right, #7b4397, #dc2430); /* Add your desired gradient colors */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin: 2rem 0;
}

.promo-image {
    max-width: 100%;
    height: auto;
    grid-column: 1 / 2;
}

.promo-text {
    width: 100%;
    grid-column: 2 / 3;
    color: #ffffff; /* Change the text color to suit the gradient background */
}

h1 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.text-center {
    opacity: 0;
    animation-name: fadeIn;
    animation-duration: 1s;
    animation-timing-function: ease-out;
    animation-fill-mode: forwards;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

#welcome {
    animation-delay: 0.5s;
}

#quality {
    animation-delay: 1s;
}

#shipping {
    animation-delay: 1.5s;
}

#discount {
    animation-delay: 2s;
}
    </style>
</head>
<body>
    <!-- Navbar -->
    
    <?php include 'header.html' ?>
    
    <!-- Parallax section -->
    <div class="parallax">
        <div class="parallax-caption">
            <span>Professionnel Electronic products</span>
        </div>
    </div>

    <!-- New products section -->
    <div class="container-fluid new-products">
        <div class="row">
            <div class="col-12">
                <h1 class="new-products-title">New Products</h1>
            </div>
        </div>
        <div class="row">
            <!-- Loop through the new products from the database -->
            <?php
                // Connect to the database
                $conn = mysqli_connect("localhost", "root", "", "store");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Query the new products table
              // Query the products table for new products
$sql = "SELECT  * FROM products WHERE date_added > DATE_SUB(CURDATE(), INTERVAL 7 DAY) LIMIT 4";
$result = mysqli_query($conn, $sql);


                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    // Output each row as a card
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
                        echo '<div class="card new-products-card">';
                        echo '<img src="admin-page/img/'  . $row["image"] . '" alt="' . $row["name"] . '" class="card-img-top new-products-card-image">';
                        
                        echo '<div class="card-body new-products-card-body">';
                        echo '<h5 class="card-title new-products-card-title">' . $row["name"] . '</h5>';
                        echo '<p class="card-text new-products-card-price">$' . $row["price"] . '</p>';
                        echo '<a href="#" class="btn btn-primary">Add to Cart</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // No results found
                    echo "No new products found.";
                }

                // Close connection
                mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Most selling products section -->
    <div class="container-fluid most-selling-products">
        <div class="row">
            <div class="col-12">
                <h1 class="most-selling-products-title">Most Selling Products</h1>
            </div>
        </div>
        <div class="row">
            <!-- Loop through the most selling products from the database -->
            <?php
                // Connect to the database
                $conn = mysqli_connect("localhost", "root", "", "store");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

$sql = "SELECT p.*, COUNT(o.order_id) AS sales FROM products p INNER JOIN order_items o ON p.id = o.product_id GROUP BY p.id ORDER BY sales DESC LIMIT 4";
$result = mysqli_query($conn, $sql);
                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    // Output each row as a card
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
                        echo '<div class="card most-selling-products-card">';
                        echo '<img src="admin-page/img/' . $row["image"] . '" alt="' . $row["name"] . '" class="card-img-top most-selling-products-card-image">';
                        echo '<div class="card-body most-selling-products-card-body">';
                        echo '<h5 class="card-title most-selling-products-card-title">' . $row["name"] . '</h5>';
                        echo '<p class="card-text most-selling-products-card-price">$' . $row["price"] . '</p>';
                        echo '<a href="#" class="btn btn-primary">Add to Cart</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // No results found
                    echo "No most selling products found.";
                }

                // Close connection
                mysqli_close($conn);
            ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="promo-section">
                    <img src="admin-page/img/opencart-1.webp" alt="Promotional Image" class="promo-image">
                    <div class="promo-text">
                        <h1 class="text-center" id="welcome">Welcome to Professional Electronic Products</h1>
                        <p class="text-center" id="quality">We offer high-quality products at affordable prices.</p>
                        <p class="text-center" id="shipping">Free shipping on orders over $50.</p>
                        <p class="text-center" id="discount">Shop now and get 10% off your first order with code WELCOME10.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
<br>
    <!-- Product recommendations -->
   <!-- Categories section -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h2 class="text-center">Shop by Category</h2>
    </div>
  </div>
  <br>
  <div class="row">
    <!-- Loop through the categories from the database -->
    <?php
      // Connect to the database
      $conn = mysqli_connect("localhost", "root", "", "store");

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Query the categories table
      $sql = "SELECT * FROM categories";
      $result = mysqli_query($conn, $sql);

      // Check if there are any results
      if (mysqli_num_rows($result) > 0) {
        // Output each row as a card
        while($row = mysqli_fetch_assoc($result)) {
          echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
          echo '<div class="card">';
          echo '<img src="admin-page/img/'. $row["image"] . '" alt="' . $row["name"] . '" class="card-img-top">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row["name"] . '</h5>';
          echo '<a href="#" class="btn btn-primary">Shop Now</a>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        // No results found
        echo "No categories found.";
      }

      // Close connection
      mysqli_close($conn);
    ?>
  </div>
</div>
<br>
<br>
<br>
    <!-- Brand story -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Our Story</h2>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <!-- Display a brand image -->
                <img src="admin-page/img/story.jpg"  alt="Our brand image" class="img-fluid">
            </div>
            <div class="col-12 col-md-6">
                <!-- Display a brand mission statement -->
                <p>We are Professional Ecommerce, a company that was founded in 2023 with a vision to provide high-quality products at affordable prices. We believe that everyone deserves to have access to the best products in the market, without breaking the bank. We source our products from reliable suppliers and manufacturers, and we test them rigorously before selling them to our customers. We also offer fast and free shipping on orders over $50, and a hassle-free return policy. Our goal is to make online shopping easy, fun, and rewarding for our customers. We hope you enjoy our products as much as we do.</p>
            </div>
            </div>
    </div>
<br>
<br>

    <!-- Social proof
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <?php
            //   // Connect to the database
            //   $conn = mysqli_connect("localhost", "root", "", "store");

            //   // Check connection
            //   if (!$conn) {
            //       die("Connection failed: " . mysqli_connect_error());
            //   }

            //   // Query the testimonials table
            //   $sql = "SELECT * FROM testimonials";
            //   $result = mysqli_query($conn, $sql);

            //   // Check if there are any results
            //   if (mysqli_num_rows($result) > 0) {
            //       // Output each row as a card
            //       while($row = mysqli_fetch_assoc($result)) {
            //           echo '<div class="col-12 col-sm-6 col-md-4">';
            //           echo '<div class="card">';
            //           echo '<img src="admin-page/img/' . $row["image"] . '" alt="' . $row["name"] . '" class="card-img-top">';
            //           echo '<div class="card-body">';
            //           echo '<h5 class="card-title">' . $row["name"] . '</h5>';
            //           echo '<p class="card-text">' . $row["text"] . '</p>';
            //           echo '<p class="card-text"><small class="text-muted">' . $row["date"] . '</small></p>';
            //           echo '</div>';
            //           echo '</div>';
            //           echo '</div>';
            //       }
            //   } else {
            //       // No results found
            //       echo "No testimonials found.";
            //   }

            //   // Close connection
            //   mysqli_close($conn);
            ?>
        </div>
    </div> -->


    <!-- Newsletter sign-up -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Subscribe to Our Newsletter</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Create a form with an email input and a submit button -->
                <form action="subscribe.php" method="post" class="form-inline justify-content-center">
                    <input type="email" name="email" class="form-control mr-2" placeholder="Enter your email address" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
