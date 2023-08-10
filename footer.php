<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style>
      .go-top {
  position: fixed;
  bottom: 0;
  right: 15px;
  background-color: hsl(205, 87%, 53%);
  color: hsl(0, 0%, 100%);
  font-size: 2rem;
  padding: 14px;
  border-radius: 3px;
  box-shadow: -3px 3px 15px hsla(335, 87%, 53%, 0.5);
  z-index: 2;
  visibility: hidden;
  opacity: 0;
  transition: 0.15s ease;
}

.go-top.active {
  visibility: visible;
  opacity: 1;
  transform: translateY(-15px);
}


/*start footer*/
  .footer{
   background-color: rgb(203, 251, 241);

}

.footer .box-container{
   justify-content: center;
   display: flex;
   margin:0 auto;
   grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
   gap:3rem;
}
.footer .box-container .box{
   text-align: left;
   margin: 10px 30px;
}

.footer .box-container .box h3{
   color:black;
   font-size: 24px;
   padding-bottom: 15px;
}

.footer .box-container .box p,
.footer .box-container .box a{
   display: block;
   font-size: 17px;
   color:rgb(106, 104, 104);
   padding: 5px 0;
   text-decoration: none;
}

.footer .box-container .box p i,
.footer .box-container .box a i{
   color:#0d6efd;
   padding-right: .5rem;
}

.footer .box-container .box a:hover{
   color:r#0d6efd;
   text-decoration: underline;
}

.footer .credit{
   text-align: center;
   font-size: 18px;
   color:#fff;
   margin-top: 2.5rem;
   padding: 20px 0;
   background: #0d6efd;
}
.footer .box a:hover{
color:#0d6efd;
}
   </style>
</head>
<body>
   <br>
   <br>
<section class="footer">

<div class="box-container">

   <div class="box">
      <h3>Catégories</h3>
      
      <a href="#">Phone</a>
      <a href="#">Laptop</a>
      <a href="#">Smart Watch</a>
      <a href="#">ecouteur</a>
      <a href="#">chargeur</a>
      
   </div>

   <div class="box">
      <h3>Extra links</h3>
      <a href="#">login</a>
      <a href="#">register</a>
      <a href="#">cart</a>
     
   </div>

   <div class="box">
      <h3>contact info</h3>
      <p> <i class="fas fa-phone"></i> +154789562 </p>
      <p> <i class="fas fa-phone"></i> +655425424 </p>
      <p> <i class="fas fa-envelope"></i> ouchgout@gmail.com </p>

   </div>

   <div class="box">
      <h3>follow us</h3>
      <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
      <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
      <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
      <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
   </div>

</div>

<p class="credit"> &copy; copyright  @ <?php echo date('Y'); ?> by Ouchgout </p>

</section>
<a href="#top" class="go-top  active" aria-label="Go To Top" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    const header = document.querySelector("[data-header]");
const goTopBtn = document.querySelector("[data-go-top]");

window.addEventListener("scroll", function () {
  if (window.scrollY >= 400) {
    header.classList.add("active");
    goTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    goTopBtn.classList.remove("active");
  }
});
</script>
</body>
</html>