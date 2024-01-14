<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-full bg-white">

<?php include 'navbar.php' ?>

<?php include 'aside.php' ?>

<div class="p-8 sm:ml-64">

<a href="../dashboardWikis.php" class = "text-white rounded p-2 bg-green-500"><i class="fa-solid fa-backward"></i></a>
<p class = "flex justify-end text-4xl text-black pb-2"><?php echo $wikis[$wikiId]['wiki']['name'] ?></p>
<div class = "flex flex-row justify-between border-b border-gray-200 pb-2">
    <div class = "flex flex-col">
        <h1 class = "mt-4 text-3xl font-bold text-black"><?php echo $wikis[$wikiId]['wiki']['title']?></h1>
        <p>Written by: <?php echo $wikis[$wikiId]['wiki']['firstName'] . " " . $wikis[$wikiId]['wiki']['lastName'] ?></p>
    </div>
    <div class = "flex flex-col">
        <p><?php echo $wikis[$wikiId]['wiki']['dateofCreation'] ?></p>
        <p><?php echo $wikis[$wikiId]['wiki']['hourofCreation'] ?></p>
    </div>
</div>
<p class = "text-xl text-black rounded bg-blue-500 text-white w-fit p-2 mt-2"><?php echo implode(', ', $wikis[$wikiId]['tags']) ?></p>
<p class = "text-black mt-2"><?php echo $wikis[$wikiId]['wiki']['description']?></p>
</div>

<div class = "flex flex-row fixed bottom-0 right-0">
    <?php if (isset($_SESSION['id'])) { ?>
    <?php if ($_SESSION['id'] == $wikis[$wikiId]['wiki']['creatorId']) {?>
    <a onclick = "my_modal_5.showModal()" class = "rounded bg-orange-500 p-2 text-white cursor-pointer m-4"><i class="fa-solid fa-pen mr-2"></i>Modify</a>
    <?php } ?>
    <?php } ?>
</div>

<dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <div class = "flex flex-row gap-8 w-full">
                <div class = "flex flex-col">
                    <form action="../dashboardWikis.php?wikiId=<?php echo $wikiId ?>&modify" method = "POST">
                    <input name = "titleUpdate" class="input input-bordered w-full max-w-xs" type="text" placeholder="Wiki title" value = "<?php echo $wikis[$wikiId]['wiki']['title'] ?>" />
                    <input name = "tagsUpdate" type="text" id = "selected_tag_id" class = "hidden" value = "">
                    <textarea name = "descriptionUpdate" class="textarea textarea-bordered resize-none w-full max-w-xs mt-4" placeholder="Wiki description"><?php echo $wikis[$wikiId]['wiki']['description'] ?></textarea>
                    <div class="dropdown pt-4">
                        <select id = "selectForm" onchange="handleCategoryChange(this)" name = "tagCategoryUpdate" class="select select-bordered z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
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

<script src="../js/wikiUpdate.js"></script>
</body>
</html>