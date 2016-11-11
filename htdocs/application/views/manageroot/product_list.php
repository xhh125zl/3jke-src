<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
	table.table { width: 98%; margin: 0 auto; }
	input.span1 { margin: 0; text-align: center; }
</style>
<div id="main_center">
	<h1>产品列表</h1>

	<table class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>产品名称</th>
          <th>调用名称</th>
          <th>排序</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
      	<?php if(!empty($list)): ?>
      	<?php foreach ($list as $k => $v): ?>
        <tr>
          <td><?php echo $v['product_id']; ?></td>
          <td><a href="<?php echo base_url('product/'.$v['method_name']); ?>" target="_blank"><?php echo $v['product_name']; ?></a></td>
          <td><?php echo $v['method_name']; ?></a></td>
          <td><?php echo $v['order']; ?></td>
          <td>
            <a href="<?php echo site_url('manageroot/product/product_edit/'.$v['product_id']); ?>"><i class="icon-pencil"></i> 编辑</a>
          　<!-- <a href="<?php echo site_url('manageroot/product/del_product/'.$v['product_id']); ?>"><i class="icon-trash"></i> 删除</a> -->
          </td>
        </tr>
   	 	<?php endforeach; ?>
        <?php endif; ?>

      </tbody>
    </table>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>