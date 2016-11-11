<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
    <h1>分类列表</h1>
    <form class="form-inline" method="get" action="<?php echo base_url('manageroot/study_catgory/catgory_list'); ?>">
      <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入  分类名称 或 分类id" />
      <input class="input-large" type="submit" value="搜索" />
    </form>
  </div>

	<table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>分类名称</th>
          <th>父id</th>
          <th>路径</th>
          <th>级别</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
      	<?php if(!empty($catgory_list)): ?>
      	<?php foreach ($catgory_list as $k => $v): ?>
        <tr>
          <td><?php echo $v['catgory_id']; ?></td>
          <td><?php echo str_repeat('----', $v['catgory_grade']); ?><?php echo $v['catgory_name']; ?></td>
          <td><?php echo $v['parent_id']; ?></td>
          <td><?php echo $v['catgory_path']; ?></td>
          <td><?php echo $v['catgory_grade']; ?></td>
          <td>
            <a href="<?php echo site_url('manageroot/study_catgory/catgory_edit/'.$v['catgory_id']); ?>"><i class="icon-pencil"></i> 编辑</a>
            <?php if($v['catgory_grade'] != 0): ?><a href="<?php echo site_url('manageroot/study_catgory/catgory_del/'.$v['catgory_id']); ?>"><i class="icon-trash"></i> 删除</a><?php endif; ?>
          </td>
        </tr>
   	 	  <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    <?php echo $pages; ?>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>