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
	<h1>修改首页banner图</h1>
  <?php echo form_open_multipart('manageroot/banner/banner_edit/'.$single_info['id'], array('class' => 'form-horizontal')); ?>

    <div class="control-group <?php if(!empty(form_error('banner_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="banner_name">banner名称</label>
      <div class="controls">
        <input type="text" id="banner_name" name="banner_name" class="input-xxlarge" value="<?php echo $single_info['banner_name']; ?>" placeholder="合作名称">
        <?php echo form_error('banner_name'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('banner_img'))): ?>error<?php endif; ?>">
      <label class="control-label" for="banner_img">PC端banner图片</label>
      <div class="controls">
        <input class="btn" type="file" name="banner_img">
        <?php if(!empty($single_info['banner_img'])): ?><img src="<?php echo base_url($single_info['banner_img']); ?>" width="60px" height="30px"><?php endif; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('banner_phone_img'))): ?>error<?php endif; ?>">
      <label class="control-label" for="banner_phone_img">手机端banner图片</label>
      <div class="controls">
        <input class="btn" type="file" name="banner_phone_img">
        <?php if(!empty($single_info['banner_phone_img'])): ?><img src="<?php echo base_url($single_info['banner_phone_img']); ?>" width="60px" height="30px"><?php endif; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('banner_href'))): ?>error<?php endif; ?>">
      <label class="control-label" for="banner_href">链接地址</label>
      <div class="controls">
        <input type="text" id="banner_href" name="banner_href" class="input-xxlarge" value="<?php echo $single_info['banner_href']; ?>" placeholder="链接地址">
        <?php echo form_error('banner_href'); ?>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="banner_status">banner状态</label>
      <div class="controls">
        <input type="radio" id="banner_status" name="banner_status" value="1" <?php if ($single_info['banner_status'] == 1) echo 'checked="checked"'; ?> class="input-xxlarge">启用
        &nbsp;&nbsp;
        <input type="radio" id="banner_status" name="banner_status" value="2" <?php if ($single_info['banner_status'] == 2) echo 'checked="checked"'; ?> class="input-xxlarge">不显示在分站
        &nbsp;&nbsp;
        <input type="radio" id="banner_status" name="banner_status" value="0" <?php if ($single_info['banner_status'] == 0) echo 'checked="checked"'; ?> class="input-xxlarge">停用
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('order'))): ?>error<?php endif; ?>">
      <label class="control-label" for="order">排序</label>
      <div class="controls">
        <input class="input-mini" id="order" type="text" name="order" placeholder="排序" value="<?php echo $single_info['order']; ?>">
        <?php echo form_error('order'); ?>
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