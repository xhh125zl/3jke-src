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
	<h1>添加公司历史</h1>
  <?php echo form_open_multipart('manageroot/setting/company_history_add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('history_time'))): ?>error<?php endif; ?>">
    <label class="control-label" for="history_time">时间</label>
    <div class="controls">
      <input type="text" id="history_time" name="history_time" maxlength="4" value="<?php echo set_value('history_time'); ?>" class="input-xxlarge" placeholder="请填写年数  格式：2016">
      <?php echo form_error('history_time'); ?>
    </div>
  </div>
  
  <div class="control-group <?php if(!empty(form_error('history_desc'))): ?>error<?php endif; ?>">
    <label class="control-label" for="history_desc">简要描述</label>
    <div class="controls">
      <textarea rows="5" style="width:528px;" name="history_desc"></textarea>
      <?php echo form_error('history_desc'); ?>
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