
<?= form_open('users/register'); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <?php echo validation_errors(); ?>
      <h1 class="text-center"><?= $title; ?> </h1>

      <div class="form-group">
        <label for="name">Full Name</label>
        <?= form_input(['name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => set_value('name')]);  ?>  
      </div>

       <div class="form-group">
        <label for="zipcode">Zip Code</label>
        <?= form_input(['name' => 'zipcode', 'class' => 'form-control', 'value' => set_value('zipcode')]);  ?>  
      </div>

       <div class="form-group">
        <label for="email">Email</label>
        <?= form_input(['name' => 'email', 'class' => 'form-control', 'value' => set_value('email')]);  ?> 
      </div>

       <div class="form-group">
        <label for="username">Username</label>
        <?= form_input(['name' => 'username', 'class' => 'form-control', 'value' => set_value('username'), 'autocomplete' => 'off']);  ?> 
      </div>

       <div class="form-group">
        <label for="password">Password</label>
        <?= form_password(['name' => 'password', 'class' => 'form-control', ]);  ?> 
      </div>

       <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <?= form_password(['name' => 'confirm_password', 'class' => 'form-control', ]);  ?> 
      </div>
      
      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Register'); ?>

    </div>
  </div>
 
<?= form_close(); ?>