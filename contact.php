<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'config.php';
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $timestamp = date("Y-m-d H:i:s");

    // Insert data into contact_form table
    $sql = "INSERT INTO contact_form (name, email, message, timestamp) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $message, $timestamp);

    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    border-radius: 5px;
}

h1, h2 {
    text-align: center;
    margin-bottom: 2rem;
}

#map {
    width: 100%;
    height: 300px;
    margin-bottom: 1rem;
}

.contact-info {
    margin-bottom: 1rem;
}

.social-icons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.fa {
    padding: 1rem;
    font-size: 1.5rem;
    color: #333;
    text-decoration: none;
    transition: color 0.3s;
}

.fa:hover {
    color: #007bff;
}

#accordion .card {
    margin-bottom: 1rem;
}
    </style>
</head>
<body>
<header >
  <div class="container text-center">
    <h1 class="display-4">Contact Us</h1>
  </div>
</header>

    <div class="container">
     
        <div class="row">
            <div class="col-md-6">
                <form id="contact-form" action="" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <div id="map"></div>
                <div class="contact-info">
                    <p><strong>Phone:</strong> <a href="tel:+1234567890">+212 5304456</a></p>
                    <p><strong>Address:</strong> 123 Main St, Agadir,Morocco</p>
                    <p><strong>Business Hours:</strong> Mon-Fri 9:00am - 5:00pm</p>
                </div>
                <div class="social-icons">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>FAQ</h2>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                Question 1
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                Answer to question 1.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                Question 2
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Answer to question 2.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
   function initMap() {
    var location = [33.5731, -7.5898];  
    var map = L.map('map').setView(location, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker(location).addTo(map);
}

initMap();

    </script>
    <?php include 'footer.php' ?>
</body>
</html>