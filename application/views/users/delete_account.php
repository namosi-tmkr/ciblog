<h2 align="center"><?= $title; ?></h2>
<?= br(2); ?>
<?= form_open('users/delete_account/' . $user_info->id); ?>
<div class="row">
    <div class="col-md-8 col-md-offset-5">
		

		<?= form_submit(['name' =>'yes', 'value' => 'Yes', 'class' => 'btn btn-danger' ]); ?>

		<?= form_submit(['name' =>'no', 'value' => 'No', 'class' => 'btn btn-primary' ]); ?>

		<?= form_close(); ?> 
	</div>
</div>