<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <div class="index_bg">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper swiper_card">
                <div class="swiper-slide slide_card">
                    <div class="slide_image">
                        <img src="./images/logo.png" alt="">
                    </div>
                    <div class="slide_text">
                        <h3>Explore Our Menu</h3>
                        <p>Find your favorite meals, freshly made and delicious.</p>
                    </div>
                </div>

                <div class="swiper-slide slide_card">
                    <div class="slide_image">
                        <img src="./images/logo.png" alt="">
                    </div>
                    <div class="slide_text">
                        <h3>Secure Payments</h3>
                        <p>Pay quickly and safely with ease.</p>

                    </div>
                </div>


                <div class="swiper-slide slide_card">
                    <div class="slide_image">
                        <img src="./images/logo.png" alt="">
                    </div>
                    <div class="slide_text">
                        <h3>Fast Delivery</h3>
                        <p>Get your food delivered fresh and on time.</p>

                    </div>
                </div>

            </div>
        </div>
        <div class="index_btns">
            <a href="signup.php">
                <button class="signup"> <i class="fas fa-user-plus"></i> Signup</button>
            </a>
            <a href="login.php">
                <button class="login"> <i class="fas fa-sign-in-alt"></i> Login</button>
            </a>
        </div>
    </div>
    <script src="./js/swiper.js"></script>
</body>

</html>