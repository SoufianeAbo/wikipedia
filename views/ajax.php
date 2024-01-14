<?php
$host = 'localhost';
$db = 'wiki';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT
    wiki.id,
    MAX(wiki.title) AS title,
    MAX(wiki.description) AS description,
    GROUP_CONCAT(DISTINCT tags.tag ORDER BY tags.tag) AS tags,
    MAX(categories.name) AS category_name,
    MAX(users.firstName) AS firstName,
    MAX(users.lastName) AS lastName
FROM wiki
LEFT JOIN (
    SELECT wikitags.wiki_id, tags.tag
    FROM wikitags
    LEFT JOIN tags ON wikitags.tag_id = tags.id
) AS tags ON wiki.id = tags.wiki_id
LEFT JOIN categories ON wiki.categoryId = categories.id
LEFT JOIN users ON wiki.creatorId = users.id
WHERE wiki.archive = 0 AND (wiki.title LIKE :searchTerm OR categories.name LIKE :searchTerm OR wiki.description LIKE :searchTerm OR tags.tag LIKE :searchTerm)
GROUP BY wiki.id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $wiki) {
        echo '<div class="p-8 border-b border-gray-500">';
        echo '<div class="flex flex-row justify-between">';
        echo '<h1 class="text-6xl pb-4 text-black">' . $wiki['title'] . '</h1>';
        echo '<p class="text-black">' . $wiki['category_name'] . '</p>';
        echo '</div>';
        echo '<p class="text-black">' . $wiki['description'] . '</p>';
        echo '<div class="flex flex-row w-full justify-between">';
        echo '<p>' . $wiki['tags'] . '</p>';
        echo '<div class="flex flex-row items-center gap-2">';
        echo '<a href="../dashboardWikis.php?wikiId=' . $wiki['id'] . '" class="rounded bg-blue-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-magnifying-glass mr-2"></i>Show more</a>';
        
        // Add delete button
        echo '<form action="../dashboardWikis.php" method="POST">';
        echo '<input type="hidden" name="deleteWiki" value="' . $wiki['id'] . '">';
        echo '<button class="rounded bg-red-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-trash-can mr-2"></i>Delete</button>';
        echo '</form>';

        // Add archive button
        echo '<form action="../dashboardWikis.php" method="POST">';
        echo '<input type="hidden" name="archiveWiki" value="' . $wiki['id'] . '">';
        echo '<button class="rounded bg-red-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-trash-can mr-2"></i>Archive</button>';
        echo '</form>';



        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    if (empty($results)) {
        echo '<p>No results found.</p>';
    }
} else {
    echo 'Invalid request.';
}
?>