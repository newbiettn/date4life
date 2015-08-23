<div class="notifications js-notifications">
	<h3>Notifications</h3>
	<ul class="notifications-list">
	</ul>
	<a href="#" class="show-all">Show all notifications</a>
</div>
<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
	<li class="name">
	  <?php if ( $this->session->userdata('username')) { ?>
      <h1><a href="<?php echo base_url('index.php/profile/view_profile')?>">Dating 4 Life</a></h1>
      <?php } else {?>
      <h1><a href="<?php echo base_url('index.php/welcome')?>">Dating 4 Life</a></h1>
      <?php }?>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <?php if ( ! $this->session->userdata('username')) { ?>
      <li><a href="<?php echo base_url('index.php/Search_For_Nonregistered')?>"><i class="fa fa-search fa-lg"></i>&nbsp Search</a></li>
      <li><a href="<?php echo base_url('index.php/user/show_login')?>">Login</a></li>
      <li><a href="<?php echo base_url('index.php/user/show_register')?>">Register</a></li>
      <?php } else {?>
      
      <li><a href="<?php echo base_url('index.php/search')?>"><i class="fa fa-search fa-lg"></i>&nbsp Search</a></li>
      <li><a href="<?php echo base_url('index.php/attention/view_attention_list')?>"><i class="fa fa-gift fa-lg"></i>&nbsp Attentions</a></li>
      
      
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/like/view_liked_list')?>"><i class="fa fa-users fa-lg"></i>&nbsp Liked List</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/message/index')?>"><i class="fa fa-users fa-weixin"></i>&nbsp Message</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo base_url('index.php/block/view_blocked_list')?>"><i class="fa fa-ban fa-lg"></i>&nbsp Blocked List</a></li>
      <li class="divider"></li>
      <li>
      	<button type="button" style="background: none !important;" class="button-default show-notifications active js-show-notifications">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" viewBox="0 0 30 32">
				<defs>
				      <g id="icon-bell">
					      <path class="path1" d="M15.143 30.286q0-0.286-0.286-0.286-1.054 0-1.813-0.759t-0.759-1.813q0-0.286-0.286-0.286t-0.286 0.286q0 1.304 0.92 2.223t2.223 0.92q0.286 0 0.286-0.286zM3.268 25.143h23.179q-2.929-3.232-4.402-7.348t-1.473-8.652q0-4.571-5.714-4.571t-5.714 4.571q0 4.536-1.473 8.652t-4.402 7.348zM29.714 25.143q0 0.929-0.679 1.607t-1.607 0.679h-8q0 1.893-1.339 3.232t-3.232 1.339-3.232-1.339-1.339-3.232h-8q-0.929 0-1.607-0.679t-0.679-1.607q3.393-2.875 5.125-7.098t1.732-8.902q0-2.946 1.714-4.679t4.714-2.089q-0.143-0.321-0.143-0.661 0-0.714 0.5-1.214t1.214-0.5 1.214 0.5 0.5 1.214q0 0.339-0.143 0.661 3 0.357 4.714 2.089t1.714 4.679q0 4.679 1.732 8.902t5.125 7.098z" />
				      </g>
				</defs>
				<g fill="#ffffff">
					<use xlink:href="#icon-bell" transform="translate(0 0)"></use>
				</g>
			</svg>
				<div class="notifications-count js-count"></div>
		</button>
	  </li>
      <li class="divider"></li>
      <li class="has-dropdown">
        <a href="#"><i class="fa fa-bars fa-lg"></i>&nbsp Menu</a>
        <ul class="dropdown">
          <li><a href="<?php echo base_url('index.php/search/view_request_random_friend')?>">Request Random Friends</a></li>
          <li><a href="<?php echo base_url('index.php/profile/show_edit_personal_profile')?>">Edit Personal Profile</a></li>
          <li><a href="<?php echo base_url('index.php/user/do_logout')?>">Logout</a></li>
        </ul>
      </li>
      <?php }?>
      <li class="divider"></li>
    </ul>
  </section>
</nav>