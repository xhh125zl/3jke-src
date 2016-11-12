<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  #main_center .form-control {width:150px;}
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
    <h1>文档列表</h1>
    <form class="form-inline" method="get" action="<?php echo base_url('manageroot/study/study_list'); ?>">
      <select style="width:110px;"  class="form-control" name="status">
        <option value="">请选择状态</option>
        <option value="1" <?php if(isset($status) && $status === '1'): ?>selected="selected"<?php endif; ?>>启用</option>
        <option value="0" <?php if(isset($status) && $status === '0'): ?>selected="selected"<?php endif; ?>>停用</option>
      </select>
      <select  class="form-control" name="catgory_id">
        <option value="">请选择分类</option>
        <option value="3">公司动态</option>
        <option value="7">常见问题</option>
      </select>
      <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入  文档标题 或 文档id" />
      <input class="input-large" type="submit" value="搜索" />
    </form>
  </div>

  <table class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>分类名称</th>
          <th>文档标题</th>
          <th>点击次数</th>
          <!-- <th>排序</th> -->
          <th>状态</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($study_list)): ?>
        <?php foreach ($study_list as $k => $v): ?>
        <tr>
          <td><?php echo $v['study_id']; ?></td>
          <td><?php echo $v['catgory_name']; ?></td>
          <td><a target="_blank" href="<?php echo base_url(); ?><?php switch($v['catgory_id']){case 3:echo '/company_news/index/'; break; case 6:echo 'question/index/'; break;} ?><?php echo $v['study_id'].'.html'; ?>"><?php echo $v['title']; ?></a></td>
          <td><?php echo $v['click']; ?></td>
          <!-- <td><input class="span1" type="text" value="<?php echo $v['order']; ?>"></td> -->
          <td><?php if($v['status'] == '1'): ?>启用<?php elseif($v['status'] == '0'): ?>停用<?php endif; ?></td>
          <td><a href="<?php echo site_url('manageroot/study/study_edit/'.$v['study_id']); ?>"><i class="icon-pencil"></i> 编辑</a>　<a href="<?php echo site_url('manageroot/study/study_delete/'.$v['study_id']); ?>"><i class="icon-trash"></i> 删除</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
      
    </table>
    <?php echo $pages; ?>
</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>