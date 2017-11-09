<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?= form_open_multipart('posts/create'); ?>

  <div class="form-group">
    <label for="title">Title</label>
    <?= form_input(['name' => 'title', 'class' => 'form-control', 'id' => 'title']);  ?>
   <!--  <input type="text" name="title" class="form-control" id="title" placeholder="Add Title"> -->
  </div>

  <div class="form-group">
    <label for="body">Body</label>
    <?= form_textarea(['name' => 'body', 'class' => 'form-control', 'id' => 'editor1']); ?>  
  </div>

  <div class="form-group">
     <label for="category">Category</label> 
   <?php   
      foreach($categories as $category): 
        $option[$category->id] = $category->name;
      endforeach; 

      echo form_dropdown('category_id', $option, '', ['class' => 'form-control']);
       ?>   
  </div>

  <div class="form-group">
    <label for="image">Upload Image</label>
    <?= form_upload(['name' => "userfile", 'size' => 20]); ?>

  </div>

  <?= form_button(['type' => 'submit', 'class' => 'btn btn-default'], 'Submit Blog'); ?>
  <!-- <button type="submit" class="btn btn-default">Submit Blog</button> -->

<?= form_close(); ?>