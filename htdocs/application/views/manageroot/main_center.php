<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }

	.server_info, .admin_info { width: 40%; display: inline-block; float: left; border: 1px solid #eee; }

	.ad_header { display: block; background: #eef3f7; height: 30px; line-height: 30px; text-indent: 10px; font-weight: bold; text-align: center; }
	li.item { border-top: 1px solid #eee; }
	li.item span { width: 48%; display: inline-block; text-indent: 10px; height: 30px; line-height: 30px; }
	li.item span.left { border-right: 1px solid #eee; }

	li.v  { border-top: 1px solid #eee; }
	li.v span { width: 30%; display: inline-block; text-indent: 10px; height: 30px; line-height: 30px; text-overflow:ellipsis; }
	li.v span.left { border-right: 1px solid #eee; }

	 table.table {
            width: 85%;
            margin-left: 20px;
        }
</style>
<div id="main_center">
	<h1>后台首页</h1>

	<div class="top_message">
		<ul class="server_info">
			<li class="ad_header">系统信息</li>
			<li class="item"><span class="left">框架版本</span><span>3.1</span></li>
			<li class="item"><span class="left">运行环境</span><span><?=$_SERVER['SERVER_SOFTWARE']?></span></li>
			<li class="item"><span class="left">上传许可</span><span><?=ini_get('upload_max_filesize')?></span></li>
			<!-- <li class="item"><span class="left">MYSQL版本</span><span><?=mysql_get_server_info()?></span></li> -->
			<li class="item"><span class="left">剩余空间</span><span><?=round((@disk_free_space(".")/(1024*1024)),2).'M'?></span></li>
		</ul>

		<ul class="admin_info">
			<li class="ad_header">个人资料</li>
			<?php if(!empty($login_info)): ?>
				<li class="item"><span class="left">用户名</span><span><?php echo $login_info['user_name']; ?></span></li>
				<li class="item"><span class="left">最后登录时间</span><span><?php echo date('Y-m-d H:i:s', $login_info['last_login_time']); ?></span></li>
				<li class="item"><span class="left">最后登录ip</span><span><?php echo $login_info['last_login_ip']; ?></span></li>
				<li class="item"><span class="left">登陆次数</span><span><?php echo $login_info['login_nums']; ?></span></li>
				<li class="item"><span class="left">添加时间</span><span><?php echo date('Y-m-d H:i:s', $login_info['addtime']); ?></span></li>
			<?php endif; ?>
		</ul>
	</div>
	 <table class="table table-striped">
	        <thead>
	        <tr><th colspan="7" style="text-align:center; color:red;">首页提交信息列表</th></tr>
	        <tr>
	            <th>编号</th>
	            <th>姓名</th>
	            <th>电话</th>
	            <th>邮箱</th>
	            <th>QQ</th>
	            <th>地址</th>
	            <th>添加时间</th>
	        </tr>
	        </thead>
	        <tbody>
	        <?php if (!empty($join_list)): ?>
	            <?php foreach ($join_list as $k => $v): ?>
	                <tr>
	                    <td><?php echo $v['id']; ?></td>
	                    <td><?php echo $v['join_name']; ?></td>
	                    <td><?php echo $v['join_phone']; ?></td>
	                    <td><?php echo $v['join_email']; ?></td>
	                    <td><?php echo $v['join_qq']; ?></td>
	                    <td><?php echo $v['join_address']; ?></td>
	                    <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
	                </tr>
	            <?php endforeach; ?>
	        <?php endif; ?>
	        </tbody>
	        <tfoot>
	        <tr>
	        	<td colspan="7" style="text-align:center;"><a href="<?php echo site_url('manageroot/join/join_list'); ?>">查看全部动态</a></td>
	        </tr>
	        </tfoot>

	    </table>

</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>