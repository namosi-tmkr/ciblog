<?= form_open('users/change_password'); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
     <?php echo validation_errors(); ?> 
      <h1 class="text-center"><?= $title; ?> </h1>

      <div class="form-group">
        <label for="password">Password</label>
        <?= form_password(['name' => 'password', 'class' => 'form-control', ]);  ?> 
      </div>

       <div class="form-group">
        <label for="new_password">New Password</label>
        <?= form_password(['name' => 'new_password', 'class' => 'form-control', ]);  ?> 
      </div>
      
      <div class="form-group">
        <label for="new_password_again">Confirm New Password</label>
        <?= form_password(['name' => 'new_password_again', 'class' => 'form-control', ]);  ?> 
      </div>
      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Change Password'); ?>

    </div>
  </div>
 
<?= form_close(); ?>