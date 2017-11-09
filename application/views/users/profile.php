

<div class="row">
    <div class="col-md-4 col-md-offset-4">
      
        <h3 class="text-center"><?= $title; ?> </h3>
        <h4 class="text-center"><?= 'Username:' . $user_info->username; ?> </h4>
        <h6 class="text-center"><?= 'Name:' . $user_info->name; ?> </h6>
        <h6 class="text-center"><?= 'Zipcode:' . $user_info->zipcode; ?> </h6>
        <h6 class="text-center"><?= 'Email:' . $user_info->email; ?> </h6>
        <h6 class="text-center"><?= 'Registered at:' . $user_info->register_date; ?> </h6>

        <hr>

        <a class="btn btn-info btn-block" href="<?= base_url(); ?>users/view_posts/<?= $user_info->id; ?>">View My Posts</a><br>
        <a class="btn btn-default btn-block" href="<?= base_url(); ?>users/edit_account/<?= $user_info->id; ?>">Edit Account</a><br>
        <a class="btn btn-primary btn-block" href="<?= base_url(); ?>users/change_password/<?= $user_info->id; ?>">Change Password</a><br>        
        <a class="btn btn-danger btn-block" href="<?= base_url(); ?>users/delete_account/<?= $user_info->id; ?>">Delete Account</a>
        
        




    </div>
  </div>