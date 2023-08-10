<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/ak5F2f5/8nN+XlCxpxFF9Cp9C/9Yupf5hr8yNE" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <title>Checkout</title>
    
</head>
<body>
<?php include 'header.html' ?>

<header class="bg-light py-5">
  <div class="container text-center">
    <h1 class="display-4">Checkout</h1>
  </div>
</header>

<main class="container my-5">
<?php
        session_start(); // Start the session

        // Check if the user_id is set in the session, and redirect if not
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php"); // Redirect to the login page
            exit;
        }

        $clientId = 1;
        $sql = "SELECT p.id, p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.client_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $clientId);
        $stmt->execute();
        $result = $stmt->get_result();

        $subTotal = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $price = $row["price"];
                $quantity = $row["quantity"];
                $productTotal = $price * $quantity;
                $subTotal += $productTotal;
            }
        }

        $stmt->close();
        ?>

  <div class="row">
    <div class="col-md-8">
      <form action="process_order.php" method="post">
        <h2>Client Information</h2>

        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
          <label for="address" class="form-label">Address:</label>
          <input type="text" class="form-control" id="address" name="address" required>
        </div>
        
        <div class="mb-3">
          <label for="phone" class="form-label">Phone:</label>
          <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>

        <h2 class="mt-5">Payment Method</h2>
        <div class="row">
          <!-- Add your payment methods here -->
        </div>

        <div class="shipping-options mt-5">
            <h2>Shipping Options</h2>
            <div class="mb-3">
              <label for="shipping" class="form-label">Select Shipping Method:</label>
              <select class="form-select" id="shipping" name="shipping">
                <option value="place_de_vent">Place de Vent</option>
                <option value="agadir">Agadir </option>
                <option value="other_cities">Other Cities</option>
              </select>
            </div>
          </div>

          <input type="hidden" name="total" value="<?php echo ($subTotal + $shippingCost); ?>">

        <button  style="background-color:#0d6efd;" type="submit" class="btn btn-success mt-5">Checkout</button>
      </form>
    </div>
    
    <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h3 class="card-title">Order Summary</h3>
                        <p>Subtotal: $<?php echo number_format($subTotal, 2); ?></p>
                        <p>Shipping: <span id="shipping-cost">TBD</span></p>
                        <p>Total: <span id="order-total">$<?php echo number_format($subTotal, 2); ?></span></p>
                    </div>
                </div>
    </div>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/ak5F2f5/8nN+XlCxpxFF9Cp9C/9Yupf5hr8yNE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybB5eD5z8XuKem3I5b3XVyTXl6tvQeg8zJmX1U0dT73v7+1Is" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/ak5F2f5/8nN+XlCxpxFF9Cp9C/9Yupf5hr8yNE" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
    
    const shippingSelect = document.getElementById('shipping');
    const shippingCostElement = document.getElementById('shipping-cost');
    const orderTotalElement = document.getElementById('order-total');
    const subTotal = <?php echo $subTotal; ?>;

    // Define the shipping costs for each option
    const shippingCosts = {
        'place_de_vent': 10.00,
        'agadir': 15.00,
        'other_cities': 20.00
    };

    // Function to calculate and update the shipping cost and order total
    function updateOrderSummary() {
        const selectedOption = shippingSelect.value;
        const shippingCost = shippingCosts[selectedOption];
        const orderTotal = subTotal + shippingCost;

        shippingCostElement.textContent = '$' + shippingCost.toFixed(2);
        orderTotalElement.textContent = '$' + orderTotal.toFixed(2);
    }

    // Event listener to update order summary on select change
    shippingSelect.addEventListener('change', updateOrderSummary);

    // Initial update of order summary
    updateOrderSummary();
   
  </script>
  
 
  <?php include 'footer.php' ?>
</body>
</html>