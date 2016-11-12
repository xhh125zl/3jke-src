<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
	table.table { width: 98%; margin: 0 auto; }
	input.span1 { margin: 0; text-align: center; }
</style>
<div id="main_center">
  <div style="margin:30px 30px; "><span style="font-size:40px;">公司面貌列表</span><a href="<?php echo site_url('manageroot/setting/company_face_add'); ?>" style="margin-left:50px; font-size:25px; "><i class="icon-pencil"></i> 添加</a></div>
	<table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>图片</th>
          <th>图片描述</th>
          <th>状态</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
      	<?php if(!empty($company_face)): ?>
        	<?php foreach ($company_face as $k => $v): ?>
          <tr>
            <td><?php echo $v['face_id']; ?></td>
            <td><a href="<?php echo base_url($v['face_pic']); ?>"><img src="<?php echo base_url($v['face_pic']); ?>" width="60px" height="30px"></a></td>
            <td><?php echo $v['face_title']; ?></td>
            <td><?php switch($v['face_status']) {case 0: echo "禁用"; break; case 1: echo "启用"; break;}  ?></td>
            <td>
              <a href="<?php echo site_url('manageroot/setting/company_face_edit/'.$v['face_id']); ?>"><i class="icon-pencil"></i> 编辑</a>
              <a href="<?php echo site_url('manageroot/setting/company_face_del/'.$v['face_id']); ?>"><i class="icon-trash"></i> 删除</a>
            </td>
          </tr>
     	 	  <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>