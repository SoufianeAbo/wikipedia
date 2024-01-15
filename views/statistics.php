<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-full bg-white">

<?php include 'navbar.php' ?>

<?php include 'aside.php' ?>

<div class="p-8 sm:ml-64 h-screen">

<div class = "grid grid-cols-1 lg:grid-cols-3 items-center gap-4">
    <div class="stats shadow">
        <div class="stat">
            <div class="stat-title">Total Wikis</div>
            <div class="stat-value"><i class="fa-solid fa-globe mr-2"></i><?php echo $wikiCount ?></div>
        </div>
    </div>
    
    <div class="stats shadow">
        <div class="stat">
            <div class="stat-title">Total Categories</div>
            <div class="stat-value"><i class="fa-solid fa-list mr-2"></i><?php echo $categoryCount ?></div>
        </div>
    </div>

    <div class="stats shadow">
        <div class="stat">
            <div class="stat-title">Total Tags</div>
            <div class="stat-value"><i class="fa-solid fa-tags mr-2"></i><?php echo $tagsCount ?></div>
        </div>
    </div>

    <div class="stats shadow lg:col-span-3">
        <div class="stat">
            <div class="stat-title">Total Users</div>
            <div class="stat-value"><i class="fa-solid fa-users mr-2"></i><?php echo $userCount ?></div>
        </div>
    </div>
</div>

</div>
<script src="../js/wikiUpdate.js"></script>
</body>
</html>