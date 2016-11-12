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
    var editor1 = K.create('textarea[name="post_desc"]', {
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
	<h1>添加招聘信息</h1>
  <?php echo form_open_multipart('manageroot/setting/company_recruit_add', array('class' => 'form-horizontal')); ?>

  <div class="control-group <?php if(!empty(form_error('recruit_post'))): ?>error<?php endif; ?>">
    <label class="control-label" for="recruit_post">招聘职位</label>
    <div class="controls">
      <input type="text" id="recruit_post" name="recruit_post" value="<?php echo set_value('recruit_post'); ?>" class="input-xxlarge" placeholder="请填写职位">
      <?php echo form_error('recruit_post'); ?>
    </div>
  </div>
  
  <div class="control-group <?php if(!empty(form_error('post_desc'))): ?>error<?php endif; ?>">
    <label class="control-label" for="post_desc">简要描述</label>
    <div class="controls">
      <textarea style="width:700px;height:250px;visibility:hidden;" name="post_desc"></textarea>
      <?php echo form_error('history_desc'); ?>
    </div>
  </div>

  <div class="control-group <?php if (!empty(form_error('order'))): ?>error<?php endif; ?>">
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