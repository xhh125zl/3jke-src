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
	<h1>添加产品</h1>
  <?php echo form_open_multipart('manageroot/product/add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('product_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="product_name">产品名称</label>
    <div class="controls">
      <input type="text" id="product_name" name="product_name" value="<?php echo set_value('product_name'); ?>" class="input-xxlarge" placeholder="请填写产品名称">
      <?php echo form_error('product_name'); ?>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('product_cover'))): ?>error<?php endif; ?>">
    <label class="control-label" for="product_cover">封面图片</label>
    <div class="controls">
      <input class="btn" type="file" name="product_cover">
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('method_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="method_name">调用名称</label>
    <div class="controls">
      <input type="text" id="method_name" name="method_name" value="<?php echo set_value('method_name'); ?>" class="input-xxlarge" placeholder="产品链接">
      <?php echo form_error('method_name'); ?>
    </div>
  </div>
  
  <div class="control-group <?php if(!empty(form_error('product_desc'))): ?>error<?php endif; ?>">
    <label class="control-label" for="product_desc">简要描述</label>
    <div class="controls">
      <textarea rows="5" style="width:528px;" name="product_desc"></textarea>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('order'))): ?>error<?php endif; ?>">
    <label class="control-label" for="order">排序</label>
    <div class="controls">
      <input class="input-mini" id="order" type="text" name="order" placeholder="排序" value="<?php echo set_value('order'); ?>">
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