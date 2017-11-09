



<?= form_open('users/login'); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <?php echo validation_errors(); ?>
      <h1 class="text-center"><?= $title; ?> </h1>

       <div class="form-group">
        <label for="username">Username</label>
        <?= form_input(['name' => 'username', 'class' => 'form-control', 'autocomplete' => 'off' ]);  ?> 
      </div>

       <div class="form-group">
        <label for="password">Password</label>
        <?= form_password(['name' => 'password', 'class' => 'form-control', ]);  ?> 
      </div>

      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Login'); ?> <br>

      <a href="<?php echo base_url(); ?>forgotpassword">Forgot your password?</a>

    </div>
  </div>
  
  
 
<?= form_close(); ?>