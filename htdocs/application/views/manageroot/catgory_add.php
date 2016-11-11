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
  <h1>添加分类</h1>

  <?php echo form_open('manageroot/study_catgory/catgory_add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('catgory_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="catgory_name">分类名称</label>
    <div class="controls">
      <input type="text" id="catgory_name" name="catgory_name" value="<?php echo set_value('catgory_name'); ?>" placeholder="分类名称">
      <?php echo form_error('catgory_name'); ?>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('parent_id'))): ?>error<?php endif; ?>">
    <label class="control-label" for="parent_id">选择分类</label>
    <div class="controls">
      <select class="span3" name="parent_id">
        <!-- <option value="0">根目录</option> -->
        <?php if(!empty($catgory_list)): ?>
        <?php foreach ($catgory_list as $k => $v): ?>
        <?php if($v['catgory_id'] != 3 && $v['catgory_id'] != 4 && $v['catgory_id'] != 5): ?>
        <option value="<?php echo $v['catgory_id']; ?>" <?php if($v['catgory_grade'] == 2): ?>disabled<?php elseif($v['parent_id'] == 2 && $v['catgory_grade'] == 1): ?>disabled<?php endif; ?>><?php echo str_repeat('----', $v['catgory_grade']); ?><?php echo $v['catgory_name']; ?></option>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
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