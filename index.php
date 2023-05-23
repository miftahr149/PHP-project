<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel=icon type=image/x-icon href=favicon.ico>
    <title>PHP Project</title>
</head>

<body>
    <?php include('template/header.html') ?>
    <main class="main flex-grow">
        <section class="home flex-box">
            <section class="home-left flex-grow">
                <h2 class=fg-white>My PHP Project</h2>
            </section>

            <section class="home-right flex-grow">
                hello world
            </section>
        </section>
        <section id="about">
            
        </section>
    </main>
    <?php include('template/footer.html') ?>