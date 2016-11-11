<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
    <h1>用户列表</h1>
    <form class="form-inline" method="get" action="<?php echo base_url('manageroot/user/user_list'); ?>">
      <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入  用户名称 或 用户id" />
      <input class="input-large" type="submit" value="搜索" />
    </form>
  </div>
  
  <table class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>用户名称</th>
          <th>用户绑定url</th>
          <th>用户绑定公司</th>
          <th>注册时间</th>
          <th>登陆次数</th>
          <th>最后登陆时间</th>
          <th>最后登陆IP</th>
          <!-- <th>用户状态</th> -->
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($user_list)): ?>
        <?php foreach ($user_list as $k => $v): ?>
        <tr>
          <td><?php echo $v['user_id']; ?></td>
          <td><?php echo $v['user_name']; ?></td>
          <td><?php echo $v['user_url']; ?></td>
          <td><?php echo $v['company_name']; ?></td>
          <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
          <td><?php echo $v['login_nums']; ?></td>
          <td><?php echo date('Y-m-d H:i:s',$v['last_login_time']); ?></td>
          <td><?php echo $v['last_login_ip']; ?></td>
          <!-- <td><?php switch($v['user_status']) {case 0:echo '停用';break; case 1:echo '启用';break;}?></td> -->
          <td>
            <a href="<?php echo site_url('manageroot/user/user_edit/'.$v['user_id']); ?>"><i class="icon-trash"></i> 重置密码</a>
            <a href="<?php echo site_url('manageroot/user/user_del/'.$v['user_id']); ?>"><i class="icon-trash"></i> 删除</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
  </table>
  <?php echo $pages; ?>
</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>