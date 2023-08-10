<?php
// functions.php
require_once 'config.php';


function getOrders() {
    global $conn;

    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    $orders = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    return $orders;
}


function updateOrderStatus($id, $status) {
  global $conn;
  $sql = "UPDATE orders SET status = '$status' WHERE id = '$id'";
  return $conn->query($sql);
}

if (isset($_POST['id']) && isset($_POST['status'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $result = updateOrderStatus($id, $status);
  if ($result) {
    echo json_encode(array("statusCode" => 200, "message" => "Order status updated successfully"));
  } else {
    echo json_encode(array("statusCode" => 201, "message" => "Order status update failed"));
  }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="cc.css">
    <title>Admin - Orders</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
         .page-header {
            padding: 20px;
           
            color: black
            \'.,m ;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .order-table {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

       
    </style>
</head>
<body>
<?php include 'admin.html' ?>
<section class="home-section">
<div class="col-lg-12" style='margin-top :15px;  ' >
            <h1 class="mb-4">Admin - Orders</h1>
            </div>
    <div class="container">
        
        <div class="row">
        <div class="col-lg-12">
                <div class="order-table">
                    <table class="table table-striped table-hover">
                        
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Adress</th>
                                <th>phone</th>
                                <th>total</th>
                                <th>shipping</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            $orders = getOrders();
                            foreach ($orders as $order) {
                            ?>
                    
                                <tr>
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['customer_name']; ?></td>
                                    <td><?php echo $order['customer_email']; ?></td>
                                    <td><?php echo $order['customer_address']; ?></td>
                                    <td><?php echo $order['phone']; ?></td>
                                    <td><?php echo $order['total']; ?></td>
                                    <td><?php echo $order['shipping']; ?></td>
                                    <td><?php echo $order['status']; ?></td>
                                    <td>
                                    <a class=" button complete" data-id="<?php echo $order['id']; ?>">Complete</a> / 
                                <a class="button cancel" data-id="<?php echo $order['id']; ?>">Cancel</a></td>
                                </tr>
                                
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
        function sendAjaxRequest(id, status) {
            $.ajax({
                type: "POST",
                url: "update_status.php", // Updated URL
                data: {id: id, status: status},
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.statusCode == 200) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    alert(error.responseText);
                }
            });
        }

        // Define a function to handle the click event on the complete button
        function handleCompleteClick(event) {
            var id = $(this).data("id");
            sendAjaxRequest(id, "Completed");
        }

        // Define a function to handle the click event on the cancel button
        function handleCancelClick(event) {
            var id = $(this).data("id");
            sendAjaxRequest(id, "Cancelled");
        }

        $(document).ready(function() {
            $(".complete").click(handleCompleteClick);
            $(".cancel").click(handleCancelClick);
        });
    </script>
 </body>
</html>