<!DOCTYPE html>
<html>
	<head>
		<title>CodeIgniter Blog</title>
		<?= link_tag('assets/css/bootstrap.min.css') ?>
    <?= link_tag('assets/css/style.css') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	</head>
  <script src="http://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<body>


	<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url(); ?>">ciBlog</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       <li><a href="<?= base_url(); ?>">Home</a></li>       
       <li><a href="<?= base_url(); ?>posts">Blog</a></li>
       <li><a href="<?= base_url(); ?>categories">Categories</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <?php if(!$this->session->userdata('logged_in')): ?>
          <li><a href="<?= base_url(); ?>users/login">Login</a></li>
          <li><a href="<?= base_url(); ?>users/register">Register</a></li>
        <?php endif; ?>
      
         <?php if($this->session->userdata('logged_in')): ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="<?= base_url(); ?>users/profile/<?php echo $this->session->userdata('user_id'); ?>" aria-expanded="false"><b>Welcome <?php echo $this->session->userdata('username'); ?></b>
              <span class="caret"></span> </a>
              
            <ul class="dropdown-menu">
            <li><a href="<?= base_url(); ?>users/profile/<?php echo $this->session->userdata('user_id'); ?>">My Profile</a></li> 
            <li><a href="<?= base_url(); ?>users/view_posts/<?= $this->session->userdata('user_id'); ?>">View My Posts</a></li>
            <li><a href="<?= base_url(); ?>users/edit_account/<?= $this->session->userdata('user_id'); ?>">Edit Account</a></li>
            <li><a href="<?= base_url(); ?>users/change_password/<?= $this->session->userdata('user_id'); ?>">Change Password</a> </li>      
            <li><a href="<?= base_url(); ?>users/delete_account/<?= $this->session->userdata('user_id'); ?>">Delete Account</a></li>

            </ul>
          </li>  

          <?php if($this->session->userdata('is_admin')): ?>
            <li><a href="<?= base_url(); ?>users/view_all_users">View Registered Users</a></li>
            <li><a href="<?= base_url(); ?>categories/create">Create Category</a></li>
          <?php endif; ?>


          <li><a href="<?= base_url(); ?>posts/create">Create Post</a></li>          
          <li><a href="<?= base_url(); ?>users/logout">Logout</a></li>
          <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>



	<div class="container">

  
    <!--  Flash Messages -->
    <?php if($this->session->flashdata('image_upload_error')): ?>
      <?php echo '<p>' . $this->session->flashdata('image_upload_error') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('user_registered')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
    <?php endif; ?>

     <?php if($this->session->flashdata('post_created')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
    <?php endif; ?>
     
     <?php if($this->session->flashdata('post_updated')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
    <?php endif; ?>

     <?php if($this->session->flashdata('category_created')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_created') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('post_deleted')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('user_loggedin')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
    <?php endif; ?>
		

    <?php if($this->session->flashdata('login_failed')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('user_loggedout')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
    <?php endif; ?>

     <?php if($this->session->flashdata('not_logged_in')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('not_logged_in') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('category_deleted')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('category_deleted') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('others_profile')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('others_profile') . '</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('user_account_edited')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_account_edited') . '</p>'; ?>
    <?php endif; ?>

     <?php if($this->session->flashdata('user_password_edited')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_password_edited') . '</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('user_account_deleted')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('user_account_deleted') . '</p>'; ?>
    <?php endif; ?>

     <?php if($this->session->flashdata('not_admin')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('not_admin') . '</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('is_logged_in')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('is_logged_in') . '</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('pwrecover_message_to_email')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('pwrecover_message_to_email') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('recover_pw_updated')): ?>
      <?php echo '<p class="alert alert-success">' . $this->session->flashdata('recover_pw_updated') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('recovery_token_expired')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('recovery_token_expired') . '</p>'; ?>
    <?php endif; ?>


    <?php if($this->session->flashdata('verification_code_invalid')): ?>
      <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('verification_code_invalid') . '</p>'; ?>
    <?php endif; ?>