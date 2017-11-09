<h2><?= $posts->title; ?></h2>


<div class="col-md-3">
	<div class="col-md-3">
			<?php
			$image_properties = [
        	'src'   => "assets/images/posts/$posts->post_image",
        	// 'class' => 'post-thumb',
        	'width' => '200',
        	'height'=> '200',
			];

			echo img($image_properties);
			?>
		</div>
</div>
<small class="post-date">Posted On: <?= $posts->created_at; ?> 
			<?= br(2); ?>
<div class="post-body">
	<?= $posts->body; ?>
</div>

<?php if($this->session->userdata('user_id') == $posts->user_id): ?>
	<hr>
	<a class="btn btn-primary pull-left" href="<?= base_url(); ?>posts/edit/<?= $posts->slug; ?>">Edit</a>
<?php endif; ?>

<?php if($this->session->userdata('user_id') == $posts->user_id || $this->session->userdata('is_admin')): ?>

	 <a class="btn btn-danger " href="<?= base_url(); ?>posts/delete/<?= $posts->id; ?>">Delete</a>
	
<?php endif; ?>	


<?= br(3); ?>
<hr>

<h3>Comments</h3>
	
<?php if($comments) : ?>

	<?php foreach ($comments as $comment) : ?>
		<div class="well">
		 <?php echo $comment->body;  ?> [by <strong><?php echo $comment->name; ?></strong>]	
	</div>
	
	<?php endforeach; ?>

<?php else: ?>
	<p>No comments to display</p>

<?php endif; ?>

<hr>
<h3>Add Comment</h3>

<?php echo validation_errors(); ?>

<?= form_open_multipart('comments/create/' . $posts->id); ?>

	<div class="form-group">
	    <label for="comment_name">Name</label>
	    <?= form_input(['name' => 'name', 'class' => 'form-control']);  ?>
  	</div>

  	<div class="form-group">
	    <label for="email">Email</label>
	    <?= form_input(['name' => 'email', 'class' => 'form-control']);  ?>
  	</div>

  	<div class="form-group">
	    <label for="body">Body</label>
	    <?= form_textarea(['name' => 'body', 'class' => 'form-control', 'id' => 'editor1']); ?>  
  	</div>

  	<?= form_hidden('slug', $posts->slug); ?>

  	<?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Submit Comment'); ?>
	
<?= form_close(); ?>

