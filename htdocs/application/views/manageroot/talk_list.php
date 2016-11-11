<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
    <h1>用户感言列表</h1>
    <form class="form-inline" method="get" action="<?php echo base_url('manageroot/customer_talk/talk_list'); ?>">
      <input style="width:300px;" class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入  感言作者 或 感言标题 或 感言id" />
      <input class="input-large" type="submit" value="搜索" />
    </form>
  </div>

  <table class="table table-striped">
      <thead>
        <tr>
          <th style="width:5%;">感言编号</th>
          <th style="width:7%;">感言作者</th>
          <th style="width:20%;">感言标题</th>
          <!-- <th style="width:50%;">感言内容</th> -->
          <th style="width:10%;">评论时间</th>
          <th style="width:8%;">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($talk_list)): ?>
        <?php foreach ($talk_list as $k => $v): ?>
        <tr>
          <td><?php echo $v['talk_id']; ?></td>
          <td><?php echo $v['user_name']; ?></td>
          <td style="width:50px;"><a target="_blank" href="<?php echo site_url('study/customer_talk'); ?><?php echo '/talk_id/'.$v['talk_id']; ?>"><?php echo $v['talk_title']; ?></a></td>
          <!-- <td style="width:300px;"><?php echo $v['talk_content']; ?></td> -->
          <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
          <td><a href="<?php echo site_url('manageroot/customer_talk/talk_edit/'.$v['talk_id']); ?>"><i class="icon-pencil"></i> 编辑</a>　<a href="<?php echo site_url('manageroot/customer_talk/talk_del/'.$v['talk_id']); ?>"><i class="icon-trash"></i> 删除</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
  </table>
  <?php echo $pages; ?>
</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>