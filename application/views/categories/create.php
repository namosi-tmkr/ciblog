<h2> <?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?= form_open_multipart('categories/create'); ?>

	<div class="form-group">
	    <label for="name">Category Name</label>
	    <?= form_input(['name' => 'category_name', 'class' => 'form-control', 'id' => 'title']);  ?>
  	</div>

  	<?= form_button(['type' => 'submit', 'class' => 'btn btn-default'], 'Submit'); ?>
	
<?= form_close(); ?>