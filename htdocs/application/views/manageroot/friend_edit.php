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
	<h1>修改友情链接</h1>
  <?php echo form_open_multipart('manageroot/friend/friend_edit/'.$single_info['id'], array('class' => 'form-horizontal')); ?>

    <div class="control-group" style="display:none;">
      <label class="control-label" for="inputOrder">类型</label>
      <div class="controls">
        <label class="radio">
          <input type="radio" name="type" id="optionsRadios1" value="0" <?php if($single_info['type'] == 0): ?>checked<?php endif; ?>>
          合作伙伴
        </label>
        <label class="radio">
          <input type="radio" name="type" id="optionsRadios2" value="1" <?php if($single_info['type'] == 1): ?>checked<?php endif; ?>>
          友情链接
        </label>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('friend_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="friend_name">名称</label>
      <div class="controls">
        <input type="text" id="friend_name" name="friend_name" class="input-xxlarge" value="<?php echo $single_info['friend_name']; ?>" placeholder="链接名称">
        <?php echo form_error('friend_name'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('friend_logo'))): ?>error<?php endif; ?>">
      <label class="control-label" for="friend_logo">链接标识</label>
      <div class="controls">
        <input class="btn" type="file" name="friend_logo">
        <?php if(!empty($single_info['friend_logo'])): ?><img src="<?php echo base_url($single_info['friend_logo']); ?>" width="60px" height="30px"><?php endif; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('friend_href'))): ?>error<?php endif; ?>">
      <label class="control-label" for="friend_href">链接地址</label>
      <div class="controls">
        <input type="text" id="friend_href" name="friend_href" class="input-xxlarge" value="<?php echo $single_info['friend_href']; ?>" placeholder="链接地址">
        <?php echo form_error('friend_href'); ?>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="friend_status">启用状态</label>
      <div class="controls">
        <input type="radio" id="friend_status" name="friend_status" value="1" <?php if ($single_info['friend_status'] == 1) echo 'checked="checked"'; ?> class="input-xxlarge">启用
        &nbsp;&nbsp;
        <input type="radio" id="friend_status" name="friend_status" value="0" <?php if ($single_info['friend_status'] == 0) echo 'checked="checked"'; ?> class="input-xxlarge">停用
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