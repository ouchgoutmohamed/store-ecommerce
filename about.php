<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* styles.css */
/* styles.css */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

body, html {
  height: 100%;
  font-family: 'Roboto', sans-serif;
}



/* Parallax header */
.parallax-header {
  position: relative;
  height: 50vh;
  background-image: url('admin-page/img/opencart-1.webp' );
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  display: flex;
  align-items: center;
  justify-content: center;
}

.parallax-text {
  text-align: center;
  color: white;
}

.parallax-text h1 {
  font-size: 4rem;
  font-weight: bold;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* Our Values section */
.fa-3x {
  color: #4a86e8;
}

/* Testimonials section */
.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: #4a86e8;
}

blockquote {
  background-color: rgb(82, 185, 229);
  padding: 1rem;
  border-radius: 5px;
  color: white;
}

/* Footer */
footer {
  background-color: #4a86e8;
}
/* styles.css */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

body, html {
  height: 100%;
  font-family: 'Roboto', sans-serif;
}

/* Parallax header */
.parallax-header {
  position: relative;
  height: 50vh;
  background-image: url('admin-page/img/opencart-1.webp' );
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  display: flex;
  align-items: center;
  justify-content: center;
}

.parallax-text {
  text-align: center;
  color: white;
}

.parallax-text h1 {
  font-size: 4rem;
  font-weight: bold;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* Our Values section */
.fa-3x {
  color: #4a86e8;
}

/* Testimonials section */
.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: #4a86e8;
}

blockquote {
  background-color: rgb(82, 185, 229);
  padding: 1rem;
  border-radius: 5px;
  color: white;
}

/* Footer */
footer {
  background-color: #4a86e8;
}

/* Animation for Our Values section */
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

.text-center:nth-child(1) {
  animation-delay: 0.5s;
}

.text-center:nth-child(2) {
  animation-delay: 1s;
}

.text-center:nth-child(3) {
  animation-delay: 1.5s;
}
blockquote {
  /* ... (previous styles) ... */
  transition: background-color 0.3s;
}
.our-values-icon {
  transition: transform 0.3s, color 0.3s;
}

.our-values-icon:hover {
  transform: scale(1.2);
  color: #1d3c6e;
}
blockquote:hover {
  background-color: rgb(41, 128, 185);
}
/* Animation for Team section */
.card {
  opacity: 0;
  transform: scale(0.8);
  animation-name: zoomIn;
  animation-duration: 1s;
  animation-timing-function: ease-out;
  animation-fill-mode: forwards;
  transition: transform 0.3s, box-shadow 0.3s;
}
.card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
@keyframes zoomIn {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

.card:nth-child(1) {
  animation-delay: 0.5s;
}

.card:nth-child(2) {
  animation-delay: 1s;
}

.card:nth-child(3) {
  animation-delay: 1.5s;
}

.card:nth-child(4) {
  animation-delay: 2s;
}

/* Animation for Testimonials section */
.carousel-item {
  opacity: 0;
  animation-name: fadeIn;
  animation-duration: 1s;
  animation-timing-function: ease-out;
  animation-fill-mode: forwards;
}

.carousel-item.active {
  opacity: 1;
  animation-name: none;
}
  </style>
</head>
<body>
  <?php include 'header.html' ?>
  <!-- Parallax header -->
  <header class="parallax-header">
    <div class="parallax-text">
      <h1>About Us</h1>
    </div>
  </header>
  
  <!-- About section -->
  <!-- Team section -->
<section class="container my-5">
  <h2 class="mb-4">Our Team</h2>
  <div class="row">
    <!-- Team member -->
    
    <!-- Add more team members here -->

    <div class="col-md-3">
      <div class="card">
        <img src="admin-page/img/face3.jpg" class="card-img-top" alt="Team member image">
        <div class="card-body">
          <h5 class="card-title">John Doe</h5>
          <p class="card-text">CEO & Founder</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <img src="admin-page/img/oip.jpg"  class="card-img-top" alt="Team member image">
        <div class="card-body">
          <h5 class="card-title">John Doe</h5>
          <p class="card-text">CEO & Founder</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <img src="admin-page/img/face.jpg" class="card-img-top" alt="Team member image">
        <div class="card-body">
          <h5 class="card-title">John Doe</h5>
          <p class="card-text">CEO & Founder</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <img src="admin-page/img/face2.jpg" class="card-img-top" alt="Team member image">
        <div class="card-body">
          <h5 class="card-title">John Doe</h5>
          <p class="card-text">CEO & Founder</p>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- Our Values section -->
<section class="container my-5">
    <h2 class="mb-4">Our Values</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="text-center">
          <i class="fas fa-rocket fa-3x text-primary mb-3"></i>
          <h4>Innovation</h4>
          <p>We strive to stay ahead of the curve and continuously improve our products and services.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center">
          <i class="fas fa-handshake fa-3x text-primary mb-3"></i>
          <h4>Integrity</h4>
          <p>We are committed to building trust and maintaining transparency with our customers and partners.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="text-center">
          <i class="fas fa-users fa-3x text-primary mb-3"></i>
          <h4>Teamwork</h4>
          <p>Our team collaborates effectively to achieve common goals and deliver the best results.</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Testimonials section -->
  <section class="container my-5">
    <h2 class="mb-4">Testimonials</h2>
    <div id="testimonialsCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row">
            <div class="col-md-4">
              <blockquote class="blockquote">
                <p class="mb-0">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante."</p>
                <footer class="blockquote-footer">John Doe, <cite title="Source Title">Company X</cite></footer>
              </blockquote>
            </div>
            <div class="col-md-4">
              <blockquote class="blockquote">
                <p class="mb-0">"Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec velit neque."</p>
                <footer class="blockquote-footer">Jane Smith, <cite title="Source Title">Company Y</cite></footer>
              </blockquote>
            </div>
            
            <div class="col-md-4">
              <blockquote class="blockquote">
                <p class="mb-0">"Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat."</p>
                <footer class="blockquote-footer">Robert Brown, <cite title="Source Title">Company Z</cite></footer>
              </blockquote>
            </div>
            
          </div>
        </div>
        <!-- Add more carousel items here -->
      </div>
      <a class="carousel-control-prev" href="#testimonialsCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#testimonialsCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <!-- Footer -->
  
  <script >
    // scripts.js
$(document).ready(function() {
  $(window).scroll(function() {
    const scroll = $(window).scrollTop();
    $('.parallax-header').css('background-position', 'center ' + (scroll * 0.5) + 'px');
  });
});
  </script>
  <?php include 'footer.php' ?>
</body>
</html>