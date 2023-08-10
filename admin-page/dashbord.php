<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
     .cardBox {
  position: relative;
  width: 100%;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 30px;
}

.cardBox .card {
  position: relative;
  background: white;
  padding: 30px;
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  cursor: pointer;
  box-shadow: 3px 3px 3px rgba(120, 152, 163, 0.5);

}

.cardBox .card .numbers {
  position: relative;
  font-weight: 500;
  font-size: 2.5rem;
  color: rgb(15, 172, 240);
}

.cardBox .card .cardName {
  color: var(--black2);
  font-size: 1.1rem;
  margin-top: 5px;
}

.cardBox .card .iconBx {
  font-size: 3.5rem;
  color: black;
}

.cardBox .card:hover {
  background: rgb(15, 172, 240);
}
.cardBox .card:hover .numbers,
.cardBox .card:hover .cardName,
.cardBox .card:hover .iconBx {
  color: white;
}

    </style>
</head>
<body>
<?php include 'admin.html' ?>
<section class="home-section">
                <!-- ======================= Cards ================== -->
                <div id="dashboard">
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">1,504</div>
                            <div class="cardName">Vues quotidiennes</div>
                        </div>
    
                        <div class="iconBx">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                    </div>
    
                    <div class="card">
                        <div>
                            <div class="numbers">80</div>
                            <div class="cardName">Ventes</div>
                        </div>
    
                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>
    
                    <div class="card">
                        <div>
                            <div class="numbers">284</div>
                            <div class="cardName">Messages</div>
                        </div>
    
                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>
    
                    <div class="card">
                        <div>
                            <div class="numbers">7,842Dhs</div>
                            <div class="cardName">Revenus</div>
                        </div>
    
                        <div class="iconBx">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers">2</div>
                            <div class="cardName">admins</div>
                        </div>
    
                        <div class="iconBx">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers">100</div>
                            <div class="cardName">users</div>
                        </div>
    
                        <div class="iconBx">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </div>
                </div>
    
            </div>
    </section>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>