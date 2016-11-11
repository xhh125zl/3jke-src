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
    var editor1 = K.create('textarea[name="talk_content"]', {
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
	<h1>添加感言</h1>
  <?php echo form_open_multipart('manageroot/customer_talk/talk_add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('user_name'))): ?>error<?php endif; ?>">
    <label class="control-label" for="user_name">感言作者</label>
    <div class="controls">
      <input type="text" id="user_name" name="user_name" value="" class="input-xxlarge" placeholder="感言作者">
      <?php echo form_error('user_name'); ?>
    </div>
  </div>
  <div class="control-group <?php if(!empty(form_error('talk_title'))): ?>error<?php endif; ?>">
    <label class="control-label" for="talk_title">感言标题</label>
    <div class="controls">
      <input type="text" id="talk_title" name="talk_title" value="" class="input-xxlarge" placeholder="感言标题">
      <?php echo form_error('talk_title'); ?>
    </div>
  </div>

  <div class="control-group <?php if(!empty(form_error('talk_content'))): ?>error<?php endif; ?>">
    <label class="control-label" for="talk_content">感言描述</label>
    <div class="controls">
      <textarea name="talk_content" style="width:700px;height:250px;visibility:hidden;"></textarea>
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