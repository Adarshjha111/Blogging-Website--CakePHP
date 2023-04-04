<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Greyb`s Blog';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

        <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>

        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <style media="screen">

            
            body{
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .top-nav{
                display: flex;
                top: 0;
                background: white;
                --e-global-color-primary: #4472c4;
                opacity: 0.9;
                --swiper-theme-color: #000;
                --swiper-navigation-size: 44px; 
                color:white;
                
            }

            .top-nav a:hover {
            background-color:grey;
            
            }
            /* to handle footer position at bottom we defined footer and body part */
            footer{
                margin-top: auto;
                background: #111;
                color: #fff;
            }


            .footer-content{
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                text-align: center;
            }
            .footer-content h3{
                font-size: 2.1rem;
                font-weight: 500;
                text-transform: capitalize;
                line-height: 3rem;
            }
            .footer-content p{
                max-width: 500px;
                margin: 10px auto;
                line-height: 28px;
                font-size: 14px;
                color: #cacdd2;
            }
            .socials{
                list-style: none;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 1rem 0 3rem 0;
            }
            .socials li{
                margin: 0 10px;
            }
            .socials a{
                text-decoration: none;
                color: #fff;
                border: 1.1px solid white;
                padding: 5px;

                border-radius: 50%;

            }
            .socials a i{
                font-size: 1.1rem;
                width: 20px;


                transition: color .4s ease;

            }
            .socials a:hover i{
                color: aqua;
            }

            .footer-bottom{
                background: #000;
                width: 100vw;
                padding: 20px;
                padding-bottom: 40px;
                text-align: center;
            }
            .footer-bottom p{
            float: left;
                font-size: 14px;
                word-spacing: 2px;
                text-transform: capitalize;
            }
            .footer-bottom p a{
            color:#44bae8;
            font-size: 16px;
            text-decoration: none;
            }
            .footer-bottom span{
                text-transform: uppercase;
                opacity: .4;
                font-weight: 200;
            }
            .footer-menu{
            float: right;

            }
            .footer-menu ul{
            display: flex;
            }
            .footer-menu ul li{
            padding-right: 10px;
            display: block;
            }
            .footer-menu ul li a{
            color: #cfd2d6;
            text-decoration: none;
            }
            .footer-menu ul li a:hover{
            color: #27bcda;
            }

            @media (max-width:500px) {
            .footer-menu ul {
            display: flex;
            margin-top: 10px;
            margin-bottom: 20px;
            }
            }

            @media(max-width:500px){
            .top-nav{
            display: flex;
            margin-top: 10px;
            margin-bottom: 20px; 
            width: 90%;  

            }
            }

            @media screen and (max-width: 500px) {
                .top-nav-links {
                    float: none;
                    display: block;
                    text-align: right;
                    font-size: 10px;
                    
                }
            }

        </style>




    </head>
        <body>

            <header id=”header”>
                    <!-- To check if user is logged in then change nav bar dynamically    -->
                    <?php $this->loadHelper('Authentication.Identity'); ?>
                    <?php if($this->Identity->isLoggedIn()) 
                    { ?>

                        
                        <nav class="top-nav" class="container-fluid">
                            <div class="top-nav-title">
                                <a href="<?= $this->Url->build('/') ?>"><span>Greyb's</span>Blog</a>
                            </div>
                            <div class="top-nav-links">
                                <a target="_blank" rel="noopener" href="http://localhost:8765/articles/index">Home</a>
                                <a target="_blank" rel="noopener" href="http://localhost:8765/articles/add">Create</a>
                                <?= $this->Html->link('Logout', array('controller'=>'Users','action' => 'logout')) ?>
                                
                            </div>
                        </nav>

                    <?php } 
                    
                    
                        else{?>

                            <nav class="top-nav">
                                <div class="top-nav-title">
                                    <a href="<?= $this->Url->build('/') ?>"><span>Greyb's</span>Blog</a>
                                </div>
                                <div class="top-nav-links" class="container-fluid">
                                
                                    <a target="_blank" rel="noopener" href="http://localhost:8765/users/add">Sign up!</a>
                                    <a target="_blank" rel="noopener" href="http://localhost:8765/users/login">Login</a>
                                </div>
                            </nav>


                    <?php  }  ?>

                    
                    <main class="main">
                        <div class="container">
                            <?= $this->Flash->render() ?>
                            <?= $this->fetch('content') ?>
                        </div>
                    </main>

            </header>


            <footer>
                <div class="footer-content">
                    <h3>Greyb's Bees</h3>
                    <p>Greyb's blog</p>
                    <ul class="socials">
                        <li><a href="https://www.facebook.com/GreyBServices/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/wegreyb"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/c/GreyBServices"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/greyb/"><i class="fa fa-linkedin-square"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/greyb/"><i class="fa fa-linkedin-square"></i></a></li>
                    </ul>
                </div>
                <div class="footer-bottom">
                    <p>copyright &copy; <a href="#">GreyB</a>  </p>
                            <div class="footer-menu">
                            <ul class="f-menu">
                                <li><a href="">Home</a></li>
                                <li><a href="">About</a></li>
                                <li><a href="">Contact</a></li>
                               
                            </ul>
                            </div>
                </div>

            </footer>
            


           
        </body>
</html>
