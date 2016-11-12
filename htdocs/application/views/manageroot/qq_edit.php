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
	<h1>编辑客服</h1>
  <?php echo form_open('manageroot/setting/qq_edit/'.$single_info['serve_id'], array('class' => 'form-horizontal')); ?>
  
  <div class="control-group <?php if(!empty(form_error('qq_class'))): ?>error<?php endif; ?>">
    <label class="control-label" for="qq_class">选择分类</label>
    <div class="controls">
      <select id="qq_class" name="qq_class">
        <option value="0" <?php if($single_info['qq_class'] == 0): ?>selected="selected"<?php endif; ?>>售前客服</option>
        <option value="1" <?php if($single_info['qq_class'] == 1): ?>selected="selected"<?php endif; ?>>代理合作</option>
        <option value="2" <?php if($single_info['qq_class'] == 2): ?>selected="selected"<?php endif; ?>>售后客服</option>
      </select>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('qq_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="qq_name">客服名称</label>
    <div class="controls">
      <input type="text" id="qq_name" name="qq_name" value="<?php echo $single_info['qq_name']; ?>" class="input-xxlarge" placeholder="">
      <?php echo form_error('qq_name'); ?>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('qq_code'))): ?>error<?php endif; ?>">
    <label class="control-label" for="qq_code">qq号码</label>
    <div class="controls">
      <input type="text" id="qq_code" name="qq_code" value="<?php echo $single_info['qq_code']; ?>" class="input-xxlarge" placeholder="">
      <?php echo form_error('qq_code'); ?>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('serve_status'))): ?>error<?php endif; ?>">
    <label class="control-label" for="serve_status">启用状态</label>
    <div class="controls">
      <input type="radio" id="serve_status" name="serve_status" value="1" <?php if($single_info['serve_status'] == 1): ?>checked="checked"<?php endif; ?> class="input-xxlarge">启用
      <input type="radio" id="serve_status" name="serve_status" value="0" <?php if($single_info['serve_status'] == 0): ?>checked="checked"<?php endif; ?> class="input-xxlarge">禁用
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputOrder"></label>
    <div class="controls">
      <button class="btn btn-primary" type="submit">确认提交</button>
    </div>
  </div>

  </form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>