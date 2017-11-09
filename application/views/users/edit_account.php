
<?= form_open('users/edit_account'); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
     <!--  <?php //echo validation_errors(); ?> -->
      <h1 class="text-center"><?= $title; ?> </h1>

      <div class="form-group">
        <label for="name">Full Name</label>
        <?= form_input(['name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => $user_info->name]);  ?> 
        <?php echo form_error('name'); ?> 
      </div>

       <div class="form-group">
        <label for="zipcode">Zip Code</label>
        <?= form_input(['name' => 'zipcode', 'class' => 'form-control', 'value' => $user_info->zipcode ]);  ?>  
      </div>

       <div class="form-group">
        <label for="email">Email</label>
        <?= form_input(['name' => 'email', 'class' => 'form-control', 'value' => $user_info->email]);  ?> 
        <?php echo form_error('email'); ?> 
      </div>

       <div class="form-group">
        <label for="username">Username</label>
        <?= form_input(['name' => 'username', 'class' => 'form-control', 'value' => $user_info->username]);  ?> 
        <?php echo form_error('username'); ?> 
      </div>
      
      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Update'); ?>

    </div>
  </div>
 
<?= form_close(); ?>