
<h2><?= $title; ?></h2>

<ul class="list-group">
	
<?php foreach($categories as $category) :  ?>

	<li class="list-group-item"><a href="<?php echo site_url('categories/posts/' . $category->id); ?>"><?php echo $category->name ?></a>
		<?php if($this->session->userdata('is_admin')/* ||$this->session->userdata('user_id') == $category->user_id*/ ): ?>

			<?= form_open('categories/delete/'. $category->id, ['class' => "cat-delete"]); ?>
				<?= form_button(['type' => 'submit', 'class' => 'btn-link text-danger'], 'Delete'); ?>

			<?= form_close(); ?>
		<?php endif; ?>
	</li>

<?php endforeach; ?>

</ul>

