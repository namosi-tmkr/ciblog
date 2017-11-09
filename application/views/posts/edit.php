<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?= form_open_multipart('posts/update'); ?>
  
  <?= form_hidden('id', $posts->id); ?>
  <?= form_hidden('current_image', $posts->post_image); ?>
  <?= form_hidden('slug', $posts->slug); ?>


  <div class="form-group">
    <label for="title">Title</label>
    <?= form_input(['name' => 'title', 'class' => 'form-control', 'id' => 'title', 'value' => $posts->title]);  ?>
   <!--  <input type="text" name="title" class="form-control" id="title" placeholder="Add Title"> -->
  </div>

  <div class="form-group">
    <label for="body">Body</label>
    <?= form_textarea(['name' => 'body', 'class' => 'form-control', 'id' => 'editor1', 'value' => $posts->body]); ?>  
  </div>

   <div class="form-group">
   <label for="category">Category</label> 
    <?php foreach($categories as $category): 
    $option[$category->id] = $category->name;
     endforeach; 
     // $current_category[$posts->category_id] = $posts->name;
    echo form_dropdown('category_id', $option, $posts->category_id , ['class' => 'form-control']); ?>   
  </div>

  <div class="form-group">
    <label for="image">Upload Image</label>
    <?= form_upload(['name' => 'userfile', 'size' => 20]); ?>
    <?php echo img(['src'   => "assets/images/posts/$posts->post_image",  
          'width' => '60',
          'height'=> '60',]); ?>

  </div>

  <?= form_button(['type' => 'submit','name' => 'submit', 'class' => 'btn btn-default'], 'Update Blog'); ?>
  <!-- <button type="submit" class="btn btn-default">Submit Blog</button> -->

<?= form_close(); ?>