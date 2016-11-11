<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
	table.table { width: 98%; margin: 0 auto; }
	input.span1 { margin: 0; text-align: center; }
  .alert { width: 96%; margin: 0 auto; }
  .f16 { font-size: 16px; }
  .form-horizontal { padding: 20px 0; }
  .form-horizontal .control-label { width: 75px; }
  .form-horizontal .controls { margin-left: 85px; }
</style>
<div id="main_center">
	<h1>添加公司面貌</h1>
  <?php echo form_open_multipart('manageroot/setting/company_face_add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('face_pic'))): ?>error<?php endif; ?>">
    <label class="control-label" for="face_pic">图片</label>
    <div class="controls">
      <input class="btn" type="file" name="face_pic">
      <?php echo form_error('face_pic'); ?>
    </div>
  </div>
  
  <div class="control-group <?php if(!empty(form_error('face_title'))): ?>error<?php endif; ?>">
    <label class="control-label" for="face_title">图片标题</label>
    <div class="controls">
      <input type="text" id="face_title" name="face_title" class="input-xxlarge" placeholder="图片标题">
        <?php echo form_error('face_title'); ?>
    </div>
  </div>

  <div class="control-group">
      <label class="control-label" for="face_status">启用状态</label>
      <div class="controls">
        <input type="radio" id="face_status" name="face_status" value="1" checked="checked" class="input-xxlarge">启用
        &nbsp;&nbsp;
        <input type="radio" id="face_status" name="face_status" value="0" class="input-xxlarge">停用
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('order'))): ?>error<?php endif; ?>">
      <label class="control-label" for="order">排序</label>
      <div class="controls">
        <input class="input-mini" id="order" type="text" name="order" placeholder="排序" value="<?php echo set_value(); ?>">
        <?php echo form_error('order'); ?>
      </div>
    </div>

  <div class="control-group">
    <label class="control-label" for="inputOrder"></label>
    <div class="controls">
      <button class="btn btn-primary" type="submit">确认添加</button>
    </div>
  </div>

  </form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>