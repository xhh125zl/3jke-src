<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
  table.table { width: 98%; margin: 0 auto; }
  input.span1 { margin: 0; text-align: center; }
  .form-horizontal { padding: 20px 0; }
  .form-horizontal .control-label { width: 75px; }
  .form-horizontal .controls { margin-left: 85px; }
  .checkbox {  }
</style>
<div id="main_center">
	<h1>修改视频</h1>
  <?php echo form_open_multipart('manageroot/study_video/video_edit/'.$single_info['video_id'], array('class' => 'form-horizontal')); ?>

    <div class="control-group <?php if(!empty(form_error('video_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="video_name">视频名称</label>
      <div class="controls">
        <input type="text" id="video_name" name="video_name" class="input-xxlarge" value="<?php echo $single_info['video_name']; ?>" placeholder="视频名称">
        <?php echo form_error('video_name'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('catgory_id'))): ?>error<?php endif; ?>">
      <label class="control-label" for="catgory_id">视频分类</label>
      <div class="controls">
        <select id="catgory_id" name="catgory_id">
          <?php if(!empty($catgory_list)): ?>
            <?php foreach($catgory_list as $k => $v): ?>
              <option value="<?php echo $v['catgory_id']; ?>" <?php if($v['catgory_id'] == $single_info['catgory_id']): ?>selected="selected"<?php endif; ?>><?php echo $v['catgory_name']; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>
    </div>

    <!-- <div class="control-group <?php if(!empty(form_error('video_keyword'))): ?>error<?php endif; ?>">
      <label class="control-label" for="video_keyword">关键字</label>
      <div class="controls">
        <input type="text" id="video_keyword" name="video_keyword" class="input-xxlarge" value="<?php echo $single_info['video_keyword']; ?>" placeholder="关键字">
        <?php echo form_error('video_keyword'); ?>
      </div>
    </div> -->

    <div class="control-group <?php if(!empty(form_error('video_cover'))): ?>error<?php endif; ?>">
      <label class="control-label" for="video_cover">视频封面</label>
      <div class="controls">
        <input class="btn" type="file" name="video_cover">
        <?php if(!empty($single_info['video_cover'])): ?><img src="<?php echo base_url($single_info['video_cover']); ?>" width="60px" height="30px"><?php endif; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('video_href'))): ?>error<?php endif; ?>">
      <label class="control-label" for="video_href">视频链接</label>
      <div class="controls">
        <input type="text" id="video_href" name="video_href" class="input-xxlarge" value="<?php echo $single_info['video_href']; ?>" placeholder="视频链接  格式：http://player.youku.com/embed/XMjY3MzgzODg0">
        <span>优酷为复制 分享给好友的 flash地址</span>
        <?php echo form_error('video_href'); ?>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="video_status">启用状态</label>
      <div class="controls">
        <input type="radio" id="video_status" name="video_status" value="1" <?php if ($single_info['video_status'] == 1) echo 'checked="checked"'; ?> class="input-xxlarge">启用
        &nbsp;&nbsp;
        <input type="radio" id="video_status" name="video_status" value="0" <?php if ($single_info['video_status'] == 0) echo 'checked="checked"'; ?> class="input-xxlarge">停用
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="inputOrder"></label>
      <div class="controls">
        <button class="btn btn-primary" type="submit">确认修改</button>
      </div>
    </div>

  </form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>