<?php
include 'head.html';
?>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 h-screen bg-white">

<?php include 'navbar.php' ?>

<?php include 'aside.php' ?>

<div class="p-8 sm:ml-64">

<button onclick = "my_modal_5.showModal()" class="btn btn-success fixed bottom-0 right-0 m-4 z-50 text-white"><i class="fa-solid fa-layer-group"></i>Add tag</button>
<div class = "grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
<?php foreach ($tags as $tag) { ?>
  <div class="card w-96 bg-white shadow-xl">
    <div class="card-body">
        <h2 class="card-title text-black"><?= $tag['tag'] ?></h2>
        <p class = "text-black"><?php echo $categoryNames[$tag['categoryId']] ?></p>

        <div class="card-actions justify-end">
        <button onclick = "modifyModal_<?php echo $tag['id']?>.showModal()" class="btn btn-primary border-none text-white"><i class="fa-solid fa-pen"></i>Modify</button>
        <form action="../tags.php" method="POST">
            <input type="text" name = "tagIdDelete" class = "hidden" value = "<?php echo $tag['id'] ?>">
            <button type = "submit" class="btn bg-red-500 text-black border-none text-white"><i class="fa-solid fa-trash"></i>Delete</button>
        </form>
        </div>
    </div> 
  </div>
  <?php } ?>
  </div>

  <?php foreach ($tags as $tag) { ?>
    <dialog id="modifyModal_<?php echo $tag['id']?>" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
    <div class="form-control">
    <label class="input-group input-group-vertical">
        <form action="../tags.php" method = "POST">
        <input name = "tagName" value = "<?php echo $tag['tag'] ?>" type="text" placeholder="Tag name..." class="input input-bordered w-full max-w-xs" />
        <input name = "tagEdit" value = "<?php echo $tag['id'] ?>" type="text" placeholder="Tag name..." class="hidden input input-bordered w-full max-w-xs" />
      </label>
    </div>
    <div class="dropdown pt-4">
      <select name = "tagCategory" class="select select-bordered z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
        <option disabled selected><a>Select a category</a></option>
        <?php foreach ($categories as $category) { ?>
        <?php if ($category['id'] == $tag['categoryId']) {
        ?>
        <option selected value = "<?php echo $category['id'] ?>"><a><?php echo $category['name'] ?></a></option>
        <?php } else { ?>
        <option value = "<?php echo $category['id'] ?>"><a><?php echo $category['name'] ?></a></option>
        <?php } ?>
        <?php } ?>
  </select>
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
        <form action="../tags.php" method = "POST">
        <input name = "tag" type="text" placeholder="Tag name..." class="input input-bordered w-full max-w-xs" />
      </label>
    </div>
    <div class="dropdown pt-4">
      <select name = "tagCategory" class="select select-bordered z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
        <option disabled selected><a>Select a category</a></option>
        <?php foreach ($categories as $category) { ?>
        <option value = "<?php echo $category['id'] ?>"><a><?php echo $category['name'] ?></a>
        <?php } ?>
  </select>
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