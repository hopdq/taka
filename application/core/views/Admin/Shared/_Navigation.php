<?php 
	$this->load->helper('url');
	$parentMenu = '';
	$childMenu = '';
	if(isset($data))
	{
		if(isset($data->parentMenu))
		{
			$parentMenu = $data->parentMenu;
		}
		if(isset($data->childMenu))
		{
			$childMenu = $data->childMenu;
		}
	}
?>
<!-- User info -->
<div class="login-info">
	<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
		<a href="javascript:void(0);" id="show-shortcut">
			<i class="fa fa-user"></i>
			<span>
				john.doe 
			</span>
		</a> 
		<?php 
			$logoutUrl = site_url(array('AdminLogin', 'Logout'));
			$urlRedirect  = site_url(array('AdminLogin'));
		?>
		<a href="javascript:void(0);" id="show-shortcut" style="float:right;" onclick="<?php echo "logout('".$logoutUrl."','".$urlRedirect."')"?>">
			<code class="danger">
				Đăng xuất
			</code>
			<i class="fa fa-long-arrow-right"></i>
		</a>
	</span>
</div>
<nav>
	<ul>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::Home ? "active" : ""; ?>">
			<a href="<?php echo site_url(array('AdminHome','Index')); ?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Trang chủ</span></a>
		</li>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::Product ? "open" : ""; ?>">
			<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Sản phẩm</span></a>
			<ul>
				<li class="<?php echo $childMenu == adminChildMenuEnum::ListManagement && $parentMenu == adminParentMenuEnum::Product ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminProduct')); ?>">Danh sách</a>
				</li>
				<li class="<?php echo $childMenu == adminChildMenuEnum::Add && $parentMenu == adminParentMenuEnum::Product ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminProduct','AddProduct')); ?>">Thêm mới</a>
				</li>
			</ul>
		</li>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::User ? "open" : ""; ?>">
			<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Người dùng</span></a>
			<ul>
				<li class="<?php echo $childMenu == adminChildMenuEnum::ListManagement && $parentMenu == adminParentMenuEnum::User ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminUser')); ?>">Danh sách</a>
				</li>
			</ul>
		</li>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::Category ? "open" : ""; ?>">
			<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Danh mục</span></a>
			<ul>
				<li class="<?php echo $childMenu == adminChildMenuEnum::ListManagement && $parentMenu == adminParentMenuEnum::Category ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminCategory')); ?>">Danh sách</a>
				</li>
			</ul>
		</li>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::Attribute ? "open" : ""; ?>">
			<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Thuộc tính</span></a>
			<ul>
				<li class="<?php echo $childMenu == adminChildMenuEnum::ListManagement && $parentMenu == adminParentMenuEnum::Attribute ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminAttribute')); ?>">Danh sách</a>
				</li>
			</ul>
		</li>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::Provider ? "open" : ""; ?>">
			<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Nhà cung cấp</span></a>
			<ul>
				<li class="<?php echo $childMenu == adminChildMenuEnum::ListManagement && $parentMenu == adminParentMenuEnum::Provider ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminProvider')); ?>">Danh sách</a>
				</li>
				<li class="<?php echo $childMenu == adminChildMenuEnum::Add && $parentMenu == adminParentMenuEnum::Provider ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminProvider', 'AddProvider')); ?>">Thêm mới</a>
				</li>
			</ul>
		</li>
		<li class="<?php echo $parentMenu == adminParentMenuEnum::Banner ? "open" : ""; ?>">
			<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Banner</span></a>
			<ul>
				<li class="<?php echo $childMenu == adminChildMenuEnum::ListManagement && $parentMenu == adminParentMenuEnum::Banner ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminBanner')); ?>">Danh sách</a>
				</li>
				<li class="<?php echo $childMenu == adminChildMenuEnum::Add && $parentMenu == adminParentMenuEnum::Banner ? "active" : ""; ?>">
					<a href="<?php echo site_url(array('AdminBanner', 'AddBanner')); ?>">Thêm mới</a>
				</li>
			</ul>
		</li>
	</ul>
</nav>
<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>
