<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	body{height:100%; width: 100%; background: #ccc;}
	#main_center { width: 100%; height: 100%; background:#333; }
	h1 { float:left; width: 20%; height: 60px; line-height: 55px; font-size: 20px; color: #FFF; text-indent: 10px; background: #333; padding: 0; margin: 0; }
	.main_center { width:30%; height:60px; line-height:60px; float:left; background-color:#333333; }
	.main_center a { color:#fff; }
	.userinfo { width: 50%; float: right; height: 60px; background: #333; color: #fff; line-height: 56px; }
	.userinfo a { width: 100px; color: #fff; margin-left: 50px; }
</style>
<div id="main_center">
	<h1>网中网后台管理系统</h1>
	<div class="main_center">
		<a target="main" href="<?php echo site_url('manageroot/home/main_center'); ?>">后台首页</a>
	</div>
	<div class="userinfo">
		<a href="<?php if($this->session->userdata('role') == 1): ?><?php echo site_url(); ?><?php else: ?><?php echo site_url('/').'?UserId='.$this->session->userdata('loginid'); ?><?php endif; ?>" target="_blank">前台首页</a>
		<a href="<?php echo site_url('manageroot/login/login_out'); ?>">退出登录</a>
		<a>欢迎您：<?php if(!empty($login_info)): ?><?php echo $login_info['user_name']; ?><?php endif; ?>&nbsp;&nbsp;<?php if($role == 1): ?>管理员<?php else: ?>用户<?php endif; ?></a>
		<a href="<?php echo site_url('manageroot/user/change_psw/'); ?>" target="main">修改密码</a>
	</div>
</div>
<script type="text/javascript">
	function reload(){
		window.location.href="";
		self.opener.location.reload();
	}
</script>
<?php $this->load->view('/manageroot/admin_footer'); ?>