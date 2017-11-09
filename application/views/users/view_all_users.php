<h2 align="center"><?= $title; ?></h2>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>S.No.</th>
      <th>Name</th>
      <th>Zipcode</th>
      <th>Email</th>
      <th>Username</th>
      <th>Registered At</th>
      <th>Delete User</th>
    </tr>
  </thead>
  <tbody>

  	<?php foreach($users as $user): ?>
	    <tr>
	      <td><?= $s_no++; ?></td>
	      <td><?= $user->name?></td>
	      <td><?= $user->zipcode?></td>
	      <td><?= $user->email?></td>
	      <td><?= $user->username?></td>
	      <td><?= $user->register_date?></td>
	      <td><a class="btn btn-danger " href="<?= base_url(); ?>users/delete_account/<?= $user->id; ?>">Delete</a></td>
	    </tr>
    <?php endforeach; ?>
  </tbody>
</table>