<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/scripts/script.js"></script>
    <title>BooxCodex</title>
</head>

<body>
    <?php
        /*
            PHP & Database Requirements:
            ▪ MySQL with 15+ records                                    - Done
            ▪ At least 3 fields per item (id, name, description)        - Done
            ▪ Support insert, update, delete functionality.
            ▪ Display data on dashboard.php
            ▪ Simple search function                                    - Done
        */
    
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';
    ?>
    <div onclick="closeNav()" style="min-height: 100vh;">
        <section class="content" id="main" onclick="closeNav()">
            <h1>
                Welcome to our humble library!
            </h1>
            <img src="/img/favicon.svg" alt="logo.svg" height="200px" style="float: inline-end; margin: 50px; margin-right: 200px;">
            <p>
                From the moment the first words were etched onto clay tablets and inked onto parchment, books have stood as humanity’s most enduring vessel of knowledge, imagination, and emotion. They have carried stories across centuries, preserved the wisdom of generations, and allowed readers to experience countless worlds beyond their own. In every era, books have remained a timeless medium — not just repositories of information, but bridges connecting minds and hearts across distance and time. Whether bound in leather, printed on paper, or displayed on glowing screens, the essence of a book endures: the power to inspire, to teach, and to transport. At BooxCodex, we celebrate that enduring magic. Our community welcomes every book lover — the curious, the collectors, and the dreamers — to explore, share, and revel in the boundless world of books together.
                <br>
                At BooxCodex, we’re more than just a place to find books — we’re a thriving reading community built by and for people who love the written word. Here, stories don’t end on the last page; they continue in conversations, recommendations, and friendships sparked by shared passions. Members can explore curated reading lists, join lively discussions, and connect with others who understand the joy of getting lost in a good book at 2 a.m. Whether you’re diving into timeless classics, exploring emerging authors, or seeking a cozy corner of the internet where readers truly belong, BooxCodex offers a welcoming space to read, reflect, and grow together. It’s not just about collecting books — it’s about celebrating the people and experiences that bring them to life.
            </p>
        </section>
    </div>
    <?php 
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; 
    ?>
</body>
</html>