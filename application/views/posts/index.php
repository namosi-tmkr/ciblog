<h2><?= $title; ?></h2>

<?= br(2); ?>

<?php foreach($posts as $post) : ?>

	<h3><?= $post->title; ?></h3> <?= br(); ?>
	<div class="row">
	
		<div class="col-md-3">
			<?php
			$image_properties = [
        	'src'   => "assets/images/posts/$post->post_image",
        	'class' => 'post-thumb',
        	'width' => '200',
        	'height'=> '200',
			];

			echo img($image_properties);
			?>
		</div>

		<div class="col-md-9">
			<small class="post-date">Posted On: <?= $post->created_at; ?> in <strong> <?= $post->category_name; ?> </strong> </small><br>
			by: <strong> <?= $post->users_name; ?> </strong>
			<?= br(2); ?>
			<?= word_limiter($post->body, 60); ?> <?= br(2); ?>
			
			<p><a class="btn btn-info" href="<?= site_url('/posts/' . $post->slug); ?>">Read More</a> </p>
			<?= br(2); ?>
		</div>
	</div>

	
<?php endforeach; ?>

<div class="pagination-links">
	<?php echo $this->pagination->create_links(); ?>
</div>