<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-max bg-white">


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

<button onclick = "my_modal_5.showModal()" class="btn btn-success fixed bottom-0 right-0 m-4 z-50 text-white"><i class="fa-solid fa-layer-group"></i>Add category</button>
<div class = "grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
<?php foreach ($categories as $category) { ?>
  <div class="card bg-white w-96 shadow-xl">
    <div class="card-body">
        <h2 class="card-title text-black"><?= $category['name'] ?></h2>
        <div class="card-actions justify-end">
        <button onclick = "modifyModal_<?php echo $category['id']?>.showModal()" class="text-white btn bg-blue-500 text-black border-none"><i class="fa-solid fa-pen"></i>Modify</button>
        <form action="../dashboardAdmin.php" method="POST">
            <input type="text" name = "categoryIdDelete" class = "hidden" value = "<?php echo $category['id'] ?>">
            <button type = "submit" class="btn bg-red-500 text-black border-none text-white "><i class="fa-solid fa-trash"></i>Delete</button>
        </form>
        </div>
    </div> 
  </div>
  <?php } ?>
  </div>

  <?php foreach ($categories as $category) { ?>
    <dialog id="modifyModal_<?php echo $category['id']?>" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
    <div class="form-control">
      <label class="input-group input-group-vertical">
        <form action="../dashboardAdmin.php" method = "POST">
        <input name = "categoryId" type = "text" class = "hidden" value = "<?php echo $category['id'] ?>" />
        <input name = "categoryEdit" type="text" placeholder="Category name..." class="input input-bordered w-full max-w-xs" value = "<?php echo $category['name'] ?>"/>
      </label>
    </div>
      <div class="modal-action">
      <div class = "flex flex-row gap-4">
        <div>
          <button class="btn btn-success">Submit</button>
        </div>
        </form>


        <form method="dialog">
          <button class="btn">Close</button>
        </form>
      </div>
    </div>
    </div>
  </dialog>
    <?php } ?>

  <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
    <div class="form-control">
      <label class="input-group input-group-vertical">
        <form action="../dashboardAdmin.php" method = "POST">
        <input name = "category" type="text" placeholder="Category name..." class="input input-bordered w-full max-w-xs" />
      </label>
    </div>
      <div class="modal-action">
      <div class = "flex flex-row gap-4">
        <div>
          <button class="btn btn-success">Submit</button>
        </div>
        </form>


        <form method="dialog">
          <button class="btn">Close</button>
        </form>
      </div>
    </div>
    </div>
  </dialog>
</div>



</body>
</html>