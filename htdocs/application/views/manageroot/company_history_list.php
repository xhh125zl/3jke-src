<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
	table.table { width: 98%; margin: 0 auto; }
	input.span1 { margin: 0; text-align: center; }
</style>
<div id="main_center">
  <div style="margin:30px 30px; "><span style="font-size:40px;">公司历史列表</span><a href="<?php echo site_url('manageroot/setting/company_history_add'); ?>" style="margin-left:50px; font-size:25px; "><i class="icon-pencil"></i> 添加</a></div>
	<table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>时间</th>
          <th>描述</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
      	<?php if(!empty($company_history)): ?>
        	<?php foreach ($company_history as $k => $v): ?>
          <tr>
            <td><?php echo $v['history_id']; ?></td>
            <td><?php echo $v['history_time']; ?></td>
            <td><?php echo $v['history_desc']; ?></td>
            <td><a href="<?php echo site_url('manageroot/setting/company_history_edit/'.$v['history_id']); ?>"><i class="icon-pencil"></i> 编辑</a>　<a href="<?php echo site_url('manageroot/setting/company_history_del/'.$v['history_id']); ?>"><i class="icon-trash"></i> 删除</a></td>
          </tr>
     	 	  <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>