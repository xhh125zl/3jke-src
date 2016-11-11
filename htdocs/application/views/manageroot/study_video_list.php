<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
  #main_center form { display:inline; margin-left:100px;}
  #main_center .form-control {width:150px;}
  table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
  <div style="border-bottom: 1px solid #eee;">
      <h1>教育视频列表</h1>
      <form class="form-inline" method="get" action="<?php echo base_url('manageroot/study_video/video_list'); ?>">
        <select style="width:110px;"  class="form-control" name="status">
          <option value="">请选择状态</option>
          <option value="1" <?php if(isset($status) && $status === '1'): ?>selected="selected"<?php endif; ?>>启用</option>
          <option value="0" <?php if(isset($status) && $status === '0'): ?>selected="selected"<?php endif; ?>>停用</option>
        </select>
        <select  class="form-control" name="catgory_id">
          <option value="">请选择分类</option>
          <?php if(!empty($study_catgory)): ?>
            <?php foreach($study_catgory as $k => $v): ?>
              <option value="<?php echo $v['catgory_id']; ?>" <?php if(!empty($catgory_id) && $catgory_id == $v['catgory_id']): ?>selected="selected"<?php endif; ?>><?php echo $v['catgory_name']; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入 视频名称 或 视频编号" />
        <input class="input-large" type="submit" value="搜索" />
      </form>
  </div>
  <table class="table table-striped">
      <thead>
        <tr>
          <th>编号</th>
          <th>视频分类</th>
          <th>视频名称</th>
          <!-- <th>关键字</th> -->
          <th>视频封面</th>
          <th>视频链接</th>
          <th>启用状态</th>
          <!-- <th>排序</th> -->
          <th>添加时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($video_list)): ?>
        <?php foreach ($video_list as $k => $v): ?>
        <tr>
          <td><?php echo $v['video_id']; ?></td>
          <td><?php echo $v['catgory_name']; ?></td>
          <td><?php echo $v['video_name']; ?></td>
          <!-- <td><?php echo $v['video_keyword']; ?></td> -->
          <td><?php if(!empty($v['video_cover'])): ?><img src="<?php echo base_url($v['video_cover']); ?>" width="60px" height="30px"><?php endif; ?></td>
          <td><a target="_blank" href="<?php echo $v['video_href']; ?>"><?php echo $v['video_href']; ?></a></td>
          <td><?php switch($v['video_status']) {case 0: echo "禁用"; break; case 1: echo "启用"; break;}  ?></td>
          <!-- <td><?php echo $v['video_order']; ?></td> -->
          <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
          <td><a href="<?php echo site_url('manageroot/study_video/video_edit/'.$v['video_id']); ?>"><i class="icon-pencil"></i> 编辑</a>　<a href="<?php echo site_url('manageroot/study_video/video_del/'.$v['video_id']); ?>"><i class="icon-trash"></i> 删除</a></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
  </table>

</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>