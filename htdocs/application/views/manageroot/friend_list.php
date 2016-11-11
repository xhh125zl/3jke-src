<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  #main_center .form-control { width:110px; }
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
    <h1>友情链接列表</h1>
    <form class="form-inline" method="get" action="<?php echo base_url('manageroot/friend/friend_list'); ?>">
      <select  class="form-control" name="status">
        <option value="">请选择状态</option>
        <option value="1" <?php if(isset($status) && $status === '1'): ?>selected="selected"<?php endif; ?>>启用</option>
        <option value="0" <?php if(isset($status) && $status === '0'): ?>selected="selected"<?php endif; ?>>停用</option>
      </select>
      <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入  链接名称 或 编号" />
      <input class="input-large" type="submit" value="搜索" />
    </form>
  </div>

  <table class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>链接名称</th>
          <th>链接地址</th>
          <th>启用状态</th>
          <!-- <th>排序</th> -->
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list)): ?>
        <?php foreach ($list as $k => $v): ?>
        <tr>
          <td><?php echo $v['id']; ?></td>
          <td><a href="<?php echo $v['friend_href']; ?>" target="_blank"><?php echo $v['friend_name']; ?></a></td>
          <td><a href="<?php echo $v['friend_href']; ?>" target="_blank"><?php echo $v['friend_href']; ?></a></td>
          <td><?php switch($v['friend_status']) {case 0:echo '停用';break; case 1:echo '启用';break;}?></td>
          <!-- <td><input class="span1" type="text" value="<?php echo $v['order']; ?>"></td> -->
          <td><a href="<?php echo site_url('manageroot/friend/friend_edit/'.$v['id']); ?>"><i class="icon-pencil"></i> 编辑</a>　<a href="<?php echo site_url('manageroot/friend/friend_delete/'.$v['id']); ?>"><i class="icon-trash"></i> 删除</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
  </table>
  <?php echo $pages; ?>
</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>