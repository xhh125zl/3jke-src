<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  #main_center .form-control {width:150px;}
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
      <h1>客服列表</h1>
      <form class="form-inline" method="get" action="<?php echo base_url('manageroot/setting/qq_list'); ?>">
        <select style="width:110px;"  class="form-control" name="status">
          <option value="">请选择状态</option>
          <option value="1" <?php if(isset($status) && $status === '1'): ?>selected="selected"<?php endif; ?>>启用</option>
          <option value="0" <?php if(isset($status) && $status === '0'): ?>selected="selected"<?php endif; ?>>停用</option>
        </select>
        <select  class="form-control" name="qq_class">
          <option value="">请选择分类</option>
          <option value="0" <?php if(isset($qq_class) && $qq_class === '0'): ?>selected="selected"<?php endif; ?>>售前客服</option>
          <option value="1" <?php if(isset($qq_class) && $qq_class === '1'): ?>selected="selected"<?php endif; ?>>代理合作</option>
          <option value="2" <?php if(isset($qq_class) && $qq_class === '2'): ?>selected="selected"<?php endif; ?>>售后客服</option>
        </select>
        <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入 客服名称 或 qq号码" />
        <input class="input-large" type="submit" value="搜索" />
      </form>
  </div>

  <table class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>分类</th>
          <th>名称</th>
          <th>qq号码</th>
          <th>启用状态</th>
          <th>添加时间</th>
          <th>修改时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($qq_list)): ?>
        <?php foreach ($qq_list as $k => $v): ?>
        <tr>
          <td><?php echo $v['serve_id']; ?></td>
          <td><?php switch($v['qq_class']){ case 0: echo '售前客服';break; case 1: echo '代理合作';break; case 2: echo '售后客服';break;} ?></td>
          <td><?php echo $v['qq_name']; ?></td>
          <td><?php echo $v['qq_code']; ?></td>
          <td><?php switch($v['serve_status']){ case 0: echo '停用'; break; case 1: echo '启用'; break;} ?></td>
          <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
          <td><?php echo date('Y-m-d H:i:s',$v['savetime']); ?></td>
          <td><a href="<?php echo site_url('manageroot/setting/qq_edit/'.$v['serve_id']); ?>"><i class="icon-pencil"></i> 编辑</a>　<a href="<?php echo site_url('manageroot/setting/qq_del/'.$v['serve_id']); ?>"><i class="icon-trash"></i> 删除</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
  </table>
  <?php echo $pages; ?>
</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>