<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
	<li class="name">
	  <?php if ( $this->session->userdata('username')) { ?>
      <h1><a href="<?php echo base_url('index.php/user/show_homepage')?>">Dating 4 Life</a></h1>
      <?php } else {?>
      <h1><a href="<?php echo base_url('index.php/welcome')?>">Dating 4 Life</a></h1>
      <?php }?>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="divider"></li>
      <li><a href="#">Search</a></li>
      <?php if ( ! $this->session->userdata('username')) { ?>
      <li><a href="<?php echo base_url('index.php/user/show_login')?>">Login</a></li>
      <li><a href="<?php echo base_url('index.php/user/show_register')?>">Register</a></li>
      <?php } else {?>
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/user/messenger')?>">Message</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/like/view_liked_list')?>">Liked List</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/block/view_blocked_list')?>">Blocked List</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/user/do_logout')?>">Logout</a></li>
      <?php }?>
      <li class="divider"></li>
    </ul>
  </section>
</nav>