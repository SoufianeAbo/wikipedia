<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-full bg-white">

<nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-gray-800 border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                    <img src="../img/wikilogo.png" alt="" class = "w-24">
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none divide-y divide-gray-100 rounded shadow bg-gray-700 divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="/wikis/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <a href="/users/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<?php include 'aside.html' ?>

<div class="p-8 sm:ml-64">

<a href="../dashboardWikis.php" class = "text-white rounded p-2 bg-green-500"><i class="fa-solid fa-backward"></i></a>
<p class = "flex justify-end text-4xl text-black pb-2"><?php echo $wikis[$wikiId]['wiki']['name'] ?></p>
<div class = "flex flex-row justify-between border-b border-gray-200 pb-2">
    <h1 class = "mt-4 text-3xl font-bold text-black"><?php echo $wikis[$wikiId]['wiki']['title']?></h1>
    <div class = "flex flex-col">
        <p><?php echo $wikis[$wikiId]['wiki']['dateofCreation'] ?></p>
        <p><?php echo $wikis[$wikiId]['wiki']['hourofCreation'] ?></p>
    </div>
</div>
<p class = "text-xl text-black rounded bg-blue-500 text-white w-fit p-2 mt-2"><?php echo implode(', ', $wikis[$wikiId]['tags']) ?></p>
<p class = "text-black mt-2"><?php echo $wikis[$wikiId]['wiki']['description']?></p>
</div>

<div class = "flex flex-row fixed bottom-0 right-0">
    <a onclick = "my_modal_5.showModal()" class = "rounded bg-orange-500 p-2 text-white cursor-pointer m-4"><i class="fa-solid fa-pen mr-2"></i>Modify</a>
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