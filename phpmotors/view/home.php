<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/template.css">
</head>

<body>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     <nav> 
        <?php 
        echo $navList; ?> 
     </nav>
    
    <main>
        <h2 class="main-head">Welcome to PHP Motors</h2>
        <aside>
            <p>DMC Delorean</p>
            <p>3 Cup holders</p>
            <p>Superman doors</p>
            <p>Fuzzy dice</p>
        </aside>
        <img class="main-img" src="/phpmotors/images/delorean.jpg" alt="DMC Delorean">
        <!-- <button>Own Today</button> -->
        <img class="button" src="/phpmotors/images/site/own_today.png" alt="own today button">
        <div class="lower-grid">
            <section class="delo-section">
                <h3>DMC Delorean Reviews</h3>
                <ul class="mainul">
                    <li>
                        <p>'So fast its almost like traveling in time' [4/5]</p>
                    </li>
                    <li>
                        <p>'Coolest ride on the road' [4/5]</p>
                    </li>
                    <li>
                        <p>'I'm feeling Marty McFly' [5/5]</p>
                    </li>
                    <li>
                        <p>'The most futuristic ride of our day' [5/5]</p>
                    </li>
                    <li>
                        <p>'80's living and I love it!' [5/5]</p>
                    </li>
                </ul>
            </section>
            <section class="upgrade-section">
                <h3>Delorean Upgrades</h3>
                <div class="up-section">
                    <img class="image" src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor">
                    <a href="#">Flux Capacitor</a>
                    <img class="image" src="/phpmotors/images/upgrades/flame.jpg" alt="flame">
                    <a href="#">Flame Decals</a>
                    <img class="image" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                    <a href="#">Bumper Stickers</a>
                    <img class="image" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub cap">
                    <a href="#">Hub Caps</a>
                </div>
            </section>
        </div>
        <hr>
    </main>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>