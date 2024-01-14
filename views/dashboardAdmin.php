<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-max bg-white">

<?php include 'navbar.php' ?>

<?php include 'aside.php' ?>

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