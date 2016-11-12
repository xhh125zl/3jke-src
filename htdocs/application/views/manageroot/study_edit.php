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
	<h1>修改文档</h1>
  <?php echo form_open_multipart('manageroot/study/study_edit/'.$single_info['study_id'], array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('catgory_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="catgory_name">选择分类</label>
    <div class="controls">
      <select class="span3" name="catgory_id">
        <option value="3">公司动态</option>
        <!-- <option value="6">常见问题</option> -->
      </select>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('title'))): ?>error<?php endif; ?>">
    <label class="control-label" for="title">标题</label>
    <div class="controls">
      <input type="text" id="title" name="title" value="<?php echo $single_info['title']; ?>" class="input-xxlarge" placeholder="文档标题">
      <?php echo form_error('title'); ?>
    </div>
  </div>
  <!-- <div class="control-group <?php if(!empty(form_error('keywords'))): ?>error<?php endif; ?>">
    <label class="control-label" for="keywords">关键词</label>
    <div class="controls">
      <input type="text" id="keywords" name="keywords" value="<?php echo $single_info['keywords']; ?>" class="input-xxlarge" placeholder="关键词">
      <?php echo form_error('keywords'); ?>
    </div>
  </div> -->
  <div class="control-group <?php if(!empty(form_error('description'))): ?>error<?php endif; ?>">
    <label class="control-label" for="description">描述</label>
    <div class="controls">
      <textarea rows="5" style="width:528px;" name="description"><?php echo $single_info['description']; ?></textarea>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('cover_img'))): ?>error<?php endif; ?>">
      <label class="control-label" for="cover_img">封面图片</label>
      <div class="controls">
        <input class="btn" type="file" name="cover_img">
        <?php if(!empty($single_info['cover_img'])): ?><img src="<?php echo base_url($single_info['cover_img']); ?>" width="60px" height="30px"><?php endif; ?>
      </div>
    </div>
  <div class="control-group <?php if(!empty(form_error('content'))): ?>error<?php endif; ?>">
    <label class="control-label" for="content">内容</label>
    <div class="controls">
      <textarea name="content" style="width:700px;height:250px;visibility:hidden;"><?php echo $single_info['content']; ?></textarea>
    </div>
  </div>
  <!-- <div class="control-group <?php if(!empty(form_error('click'))): ?>error<?php endif; ?>">
    <label class="control-label" for="click">点击量</label>
    <div class="controls">
      <input class="span2" id="click" type="text" name="click" placeholder="排序" value="<?php echo $single_info['click']; ?>">
      <?php echo form_error('click'); ?>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('order'))): ?>error<?php endif; ?>">
    <label class="control-label" for="order">排序</label>
    <div class="controls">
      <input class="input-mini" id="order" type="text" name="order" placeholder="排序" value="<?php echo $single_info['order']; ?>">
      <?php echo form_error('order'); ?>
    </div>
  </div> -->

  <div class="control-group">
    <label class="control-label" for="inputOrder">状态</label>
    <div class="controls">
        <input type="radio" name="status" id="optionsRadios1" value="1" <?php if ($single_info['status'] == '1'): ?>checked<?php endif; ?>>启用
        &nbsp;&nbsp;
        <input type="radio" name="status" id="optionsRadios2" value="0"<?php if ($single_info['status'] == '0'): ?>checked<?php endif; ?>>禁用
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