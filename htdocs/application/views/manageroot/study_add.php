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
<script>
  KindEditor.ready(function(K) {
    var editor1 = K.create('textarea[name="content"]', {
      cssPath : '<?php echo base_url('public/kindEditor/plugins/code/prettify.css'); ?>',
      uploadJson : '<?php echo base_url('public/kindEditor/php/upload_json.php'); ?>',
      fileManagerJson : '<?php echo base_url('public/kindEditor/php/file_manager_json.php'); ?>',
      allowFileManager : true,
      afterCreate : function() {
        var self = this;
        K.ctrl(document, 13, function() {
          self.sync();
          K('form[name=example]')[0].submit();
        });
        K.ctrl(self.edit.doc, 13, function() {
          self.sync();
          K('form[name=example]')[0].submit();
        });
      }
    });
    prettyPrint();
  });
</script>
<div id="main_center">
	<h1>添加文档</h1>
  <?php echo form_open_multipart('manageroot/study/study_add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('catgory_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="catgory_name">选择栏目</label>
    <div class="controls">
      <select class="span3" name="catgory_id">
        <?php if(!empty($cat_arr)): ?>
        <?php foreach ($cat_arr as $k => $v): ?>
          <?php if($v['catgory_id'] == 2 || $v['parent_id'] == 2): ?>
          <?php else: ?>
        <option value="<?php echo $v['catgory_id']; ?>" <?php if($v['catgory_grade'] == 2 || $v['catgory_id'] == 3 || $v['catgory_id'] == 4 || $v['catgory_id'] == 5): ?><?php else: ?>disabled<?php endif; ?>><?php echo str_repeat('----', $v['catgory_grade']); ?><?php echo $v['catgory_name']; ?></option>
      <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('title'))): ?>error<?php endif; ?>">
    <label class="control-label" for="title">标题</label>
    <div class="controls">
      <input type="text" id="title" name="title" value="<?php echo set_value('title'); ?>" class="input-xxlarge" placeholder="文档标题">
      <?php echo form_error('title'); ?>
    </div>
  </div>
  <!-- <div class="control-group <?php if(!empty(form_error('keywords'))): ?>error<?php endif; ?>">
    <label class="control-label" for="keywords">关键词</label>
    <div class="controls">
      <input type="text" id="keywords" name="keywords" value="<?php echo set_value('keywords'); ?>" class="input-xxlarge" placeholder="关键词">
      <?php echo form_error('keywords'); ?>
    </div>
  </div> -->
  <div class="control-group <?php if(!empty(form_error('description'))): ?>error<?php endif; ?>">
    <label class="control-label" for="description">描述</label>
    <div class="controls">
      <textarea rows="5" style="width:528px;" name="description"></textarea>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('cover_img'))): ?>error<?php endif; ?>">
    <label class="control-label" for="cover_img">封面图片</label>
    <div class="controls">
      <input class="btn" type="file" name="cover_img">
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('content'))): ?>error<?php endif; ?>">
    <label class="control-label" for="content">内容</label>
    <div class="controls">
      <textarea name="content" style="width:700px;height:250px;visibility:hidden;"></textarea>
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