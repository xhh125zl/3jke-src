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
<script>
  KindEditor.ready(function(K) {
    var editor1 = K.create('textarea[name="company_desc"]', {
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
	<h1>公司设置</h1>
  <?php echo form_open_multipart('manageroot/setting/company_setting', array('class' => 'form-horizontal')); ?>

    <div class="control-group <?php if(!empty(form_error('company_address'))): ?>error<?php endif; ?>">
      <label class="control-label" for="company_address">公司地址</label>
      <div class="controls">
        <input type="text" id="company_address" name="company_address" value="<?php echo $company_info['company_address']; ?>" class="input-xxlarge" placeholder="公司地址">
        <?php echo form_error('company_address'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('company_email'))): ?>error<?php endif; ?>">
      <label class="control-label" for="company_email">公司邮箱</label>
      <div class="controls">
        <input type="text" id="company_email" name="company_email" value="<?php echo $company_info['company_email']; ?>" class="input-xxlarge" placeholder="公司邮箱">
        <?php echo form_error('company_email'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('company_contactNum'))): ?>error<?php endif; ?>">
      <label class="control-label" for="company_contactNum">联系电话</label>
      <div class="controls">
        <input type="text" id="company_contactNum" name="company_contactNum" value="<?php echo $company_info['company_contactNum']; ?>" class="input-xxlarge" placeholder="联系电话">
        <?php echo form_error('company_contactNum'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('company_saleNum'))): ?>error<?php endif; ?>">
      <label class="control-label" for="company_saleNum">销售电话</label>
      <div class="controls">
        <input type="text" id="company_saleNum" name="company_saleNum" value="<?php echo $company_info['company_saleNum']; ?>" class="input-xxlarge" placeholder="销售电话">
        <?php echo form_error('company_saleNum'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('company_afterSaleNum'))): ?>error<?php endif; ?>">
      <label class="control-label" for="company_afterSaleNum">售后电话</label>
      <div class="controls">
        <input type="text" id="company_afterSaleNum" name="company_afterSaleNum" value="<?php echo $company_info['company_afterSaleNum']; ?>" class="input-xxlarge" placeholder="售后电话">
        <?php echo form_error('company_afterSaleNum'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('company_desc'))): ?>error<?php endif; ?>">
      <label class="control-label" for="company_desc">公司简介</label>
      <div class="controls">
        <textarea style="width:700px;height:250px;visibility:hidden;" name="company_desc"><?php echo $company_info['company_desc']; ?></textarea>
        <?php echo form_error('company_desc'); ?>
      </div>
    </div>

    <div class="control-group" style="clear:both;">
      <label class="control-label" for="inputOrder"></label>
      <div class="controls">
        <button class="btn btn-primary" type="submit">确认修改</button>
      </div>
    </div>

  </form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>