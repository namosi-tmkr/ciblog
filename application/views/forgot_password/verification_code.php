<?= form_open('forgotpassword/verification_code/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)); ?>
  
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
     <?php echo validation_errors(); ?> 
      <h1 class="text-center"><?= 'Enter Code'; ?> </h1>

      <div class="form-group">
        <label for="code">Code</label>
        <?= form_input(['name' => 'verification_code', 'class' => 'form-control', ]);  ?> 

      </div>

      
      <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Submit Code'); ?>

    </div>
  </div>
 
<?= form_close(); ?>