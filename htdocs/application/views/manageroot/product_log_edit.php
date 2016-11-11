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
	<h1>修改日志</h1>
  <?php echo form_open('manageroot/product_log/edit_log/'.$single_info['update_log_id'], array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('product_id'))): ?>error<?php endif; ?>">
    <label class="control-label" for="product_id">选择产品</label>
    <div class="controls">
      <select class="span3" name="product_id">
      <?php foreach($product_list as $k => $v): ?>
        <option value="<?php echo $v['product_id']; ?>" <?php if($v['product_id'] == $single_info['product_id']): ?>selected="selected"<?php endif; ?>><?php echo $v['product_name']; ?></option>
      <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('log_time'))): ?>error<?php endif; ?>">
    <label class="control-label" for="log_time">更新日期</label>
    <div class="controls">
      <input type="text" id="log_time" name="log_time" value="<?php echo date('Y-m-d',$single_info['log_time']); ?>" class="input-xxlarge" placeholder="请填写更新日期; 格式：2016-10-20">
      <?php echo form_error('log_time'); ?>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('title'))): ?>error<?php endif; ?>">
    <label class="control-label" for="title">日志标题</label>
    <div class="controls">
      <input type="text" id="title" name="title" value="<?php echo $single_info['title']; ?>" class="input-xxlarge" placeholder="文档标题">
      <?php echo form_error('title'); ?>
    </div>
  </div>
  
  <div class="control-group <?php if(!empty(form_error('desc'))): ?>error<?php endif; ?>">
    <label class="control-label" for="desc">描述</label>
    <div class="controls">
      <textarea rows="5" style="width:528px;" name="desc"><?php echo $single_info['desc']; ?></textarea>
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