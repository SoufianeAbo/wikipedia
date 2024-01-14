<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-fit bg-white">

<?php include 'navbar.php' ?>

<?php include 'aside.php' ?>

<div class="p-8 sm:ml-64">

<input id = "searchInput" class = "text-black w-full bg-white p-2 border border-gray-500" placeholder = "Search..." type="text">

<div class = "flex flex-row gap-8">
    <div id = "searchResults" class = "flex flex-col w-full">
        <?php foreach ($wikis as $wiki) { ?>
            <div class = "p-8 border-b border-gray-500">
                <div class = "flex flex-row justify-between">
                    <h1 class = "text-6xl pb-4 text-black"><?php echo $wiki['wiki']['title'] ?></h1>
                    <p class = "text-black"><?php echo $wiki['wiki']['name'] ?></p>
                </div>
                <p class = "text-black"><?php echo $wiki['wiki']['description'] ?></p>
                <div class = "flex flex-row w-full justify-between">
                    <p><?php echo implode(', ', $wiki['tags']) ?></p>
                    <div class = "flex flex-row items-center gap-2">
                    <!-- <a onclick = "modal<?php echo $wiki['wiki']['id'] ?>.showModal()" class = "rounded bg-orange-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-pen mr-2"></i>Modify</a> -->
                        <form action="../dashboardWikis.php" method = "POST">
                        <a href = "../dashboardWikis.php?wikiId=<?php echo $wiki['wiki']['id'] ?>" class = "rounded bg-blue-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-magnifying-glass mr-2"></i>Show more</a>
                            <input type="text" name = "deleteWiki" value = "<?php echo $wiki['wiki']['id'] ?>" class = "hidden">
                            <?php if (isset($_SESSION['id'])) { ?>
                            <?php if ($_SESSION['id'] == $wiki['wiki']['creatorId']) { ?>
                            <button class = "rounded bg-red-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-trash-can mr-2"></i>Delete</button>
                            <?php } ?>
                            <?php } ?>
                        </form>
                        <form action="../dashboardWikis.php" method = "POST">
                            <input type="text" name = "archiveWiki" value = "<?php echo $wiki['wiki']['id'] ?>" class = "hidden">
                            <?php if (isset($_SESSION['id'])) { ?>
                            <?php if ($_SESSION['role'] == "admin") { ?>
                            <button class = "rounded bg-red-500 p-2 text-white justify-self-end self-end w-fit cursor-pointer"><i class="fa-solid fa-trash-can mr-2"></i>Archive</button>
                            <?php } ?>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class = "flex flex-col">
        <div class = "shadow-lg w-64 flex items-center flex-col p-6">
            <p class = "text-black font-bold text-2xl border-b border-gray-200 mb-2">Recent wikis</p>
            <?php foreach ($wikisRecent as $wiki) { ?>
                <a href = "../dashboardWikis.php?wikiId=<?php echo $wiki['wiki']['id'] ?>" class = "text-black"><?php echo $wiki['wiki']['title'] ?></a>
            <?php } ?>

        </div>

        <div class = "shadow-lg w-64 flex items-center flex-col p-6">
        <p class = "text-black font-bold text-2xl border-b border-gray-200 mb-2">Recent categories</p>
            <?php foreach ($categoryNamesRecent as $category) { ?>
                <a class = "text-black"><?php echo $category ?></a>
            <?php } ?>
        </div>
    </div>
    </div>
    <?php if (isset($_SESSION['id'])) {?>
    <button onclick = "my_modal_5.showModal()" class="btn btn-success fixed bottom-0 right-0 m-4 z-50 text-white"><i class="fa-solid fa-layer-group"></i>Add wiki</button>
    <?php } ?>

    <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <div class = "flex flex-row gap-8 w-full">
                <div class = "flex flex-col">
                    <form action="../dashboardWikis.php" method = "POST">
                    <input name = "title" class="input input-bordered w-full max-w-xs" type="text" placeholder="Wiki title" />
                    <input name = "tags" type="text" id = "selected_tag_id" class = "hidden" value = "">
                    <textarea name = "description" class="textarea textarea-bordered resize-none w-full max-w-xs mt-4" placeholder="Wiki description"></textarea>
                    <div class="dropdown pt-4">
                        <select id = "selectForm" onchange="handleCategoryChange(this)" name = "tagCategory" class="select select-bordered z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <option disabled selected><a>Select a category</a></option>
                            <?php foreach ($categories as $category) { ?>
                            <option value = "<?php echo $category['id'] ?>"><a><?php echo $category['name'] ?></a>
                            <?php } ?> 
                        </select>
                    </div>
                </div>

                <div class = "flex flex-col w-full">
                    <p>Tags</p>
                    <div id = "tagContainer">

                    </div>
                    <a id = "addBtn" class = "rounded bg-green-500 px-2 py-1 mt-2 cursor-pointer text-black"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
            <div class="modal-action">
            <button type = "submit" class="btn bg-green-500 text-black">Submit</button>
            </form>
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
            </div>
        </div>
    </dialog>
</div>

</div>


<script src="../js/wiki.js"></script>
</body>
</html>