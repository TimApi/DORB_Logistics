<?php


$menuitems = array(
    array('home','Home'),
);





?>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<body>


<div class="wrapper">
    <header>
        <?php
        if  (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "admin"){
            ?>
            <nav>
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <div class="logo">
                   DORB Logistic
                </div>
                <div class="menu">
                    <ul>
                        <li><a class="nav-link" href="http://localhost:8080/DORB_Logistics/?page=home">Home<span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="http://localhost:8080/DORB_Logistics/?page=registration_admin">register Users<span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="http://localhost:8080/DORB_Logistics/?page=trucks">Trucks<span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="php/logout.php">Uitloggen<span class="sr-only">(current)</span></a></li>
                    </ul
                </div>
            </nav>
            <?php
        } else {?>
            <nav>
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <div class="logo">
            DORB Logistic
            </div>
                <div class="menu">
                    <ul>
                        <li><a class="nav-link" href="http://localhost:8080/DORB_Logistics/?page=home">pallets<span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="http://localhost:8080/DORB_Logistics/?page=shopping_cart">Cart<span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="http://localhost:8080/DORB_Logistics/?page=besteld">bought_items<span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="php/logout.php">Uitloggen<span class="sr-only">(current)</span></a></li>
                    </ul
            </div>
            </nav>
    <?php    }
        ?>
        <nav>
            <div class="menu-icon">
                <i class="fa fa-bars fa-2x"></i>

            <div class="logo">
                LOGO

            <div class="menu">
<?php


            if (isset($_SESSION['ingelogd'])) {
                if  (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "admin"){

                    echo '<a class="nav-link" href="http://localhost:8080/webshop/?page=grindplatentoevoegen">grindplaten toevoegen<span class="sr-only">(current)</span></a>';
                    echo '<a class="nav-link" href="http://localhost:8080/webshop/index.php?page=transactieoverzicht">Transactie overzicht<span class="sr-only">(current)</span></a>';
                    echo '<a class="nav-link" href="http://localhost:8080/webshop/index.php?page=overzichtusers">Users<span class="sr-only">(current)</span></a>';
                    echo '<a class="nav-link" href="php/logout.php">Uitloggen<span class="sr-only">(current)</span></a>';
                } else {
                    ;
                    echo '<a class="nav-link" href="http://localhost:8080/webshop/index.php?page=contact">Contact<span class="sr-only">(current)</span></a>';
                    echo '<a class="nav-link" href="php/logout.php">Uitloggen<span class="sr-only">(current)</span></a>';
                }
            } else {
                foreach ($menuitems as $menuitem){
                    echo '<li class="nav-item active">';
                    // eerste array is om naar een pagia te gaan en tweede array is om aan te geven welke pagina het is.
                    echo '<a class="nav-link" href="index.php?page='.$menuitem[0].'">'.$menuitem[1].' <span class="sr-only">(current)</span></a>';
                }
            }
            ?>
            </div>
            </div>
            </div>
        </nav>

    </header>
