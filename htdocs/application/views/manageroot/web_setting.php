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
	<h1>站点设置</h1>
  <?php echo form_open_multipart('manageroot/setting/web_setting', array('class' => 'form-horizontal')); ?>

    <div class="control-group <?php if(!empty(form_error('web_record_number'))): ?>error<?php endif; ?>">
      <label class="control-label" for="web_record_number">网站备案号</label>
      <div class="controls">
        <input type="text" id="web_record_number" name="web_record_number" value="<?php echo $company_info['web_record_number']; ?>" class="input-xxlarge" placeholder="">
        <?php echo form_error('web_record_number'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('webtitle'))): ?>error<?php endif; ?>">
      <label class="control-label" for="webtitle">网站标题</label>
      <div class="controls">
        <input type="text" id="webtitle" name="webtitle" value="<?php echo $company_info['webtitle']; ?>" class="input-xxlarge" placeholder="网站标题">
        <?php echo form_error('webtitle'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('keywords'))): ?>error<?php endif; ?>">
      <label class="control-label" for="keywords">关键词</label>
      <div class="controls">
        <input type="text" id="keywords" name="keywords" value="<?php echo $company_info['keywords']; ?>" class="input-xxlarge" placeholder="关键词">
        <?php echo form_error('keywords'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('webdesc'))): ?>error<?php endif; ?>">
      <label class="control-label" for="webdesc">网站描述</label>
      <div class="controls">
        <textarea rows="5" style="width:528px;" name="webdesc"><?php echo $company_info['webdesc']; ?></textarea>
      </div>
    </div>

    <!-- <div class="control-group <?php if(!empty(form_error('consult_url'))): ?>error<?php endif; ?>">
      <label class="control-label" for="consult_url">咨询地址</label>
      <div class="controls">
        <input type="text" id="consult_url" name="consult_url" value="<?php echo $company_info['consult_url']; ?>" class="input-xxlarge" placeholder="咨询地址   格式为  http://www.baidu.com  或  www.baidu.com">
        <?php echo form_error('consult_url'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('online_code'))): ?>error<?php endif; ?>">
      <label class="control-label" for="online_code">在线交流<br>代码段</label>
      <div class="controls">
        <textarea rows="5" style="width:528px;" name="online_code"><?php echo $company_info['online_code']; ?></textarea>
      </div>
    </div> -->

    <div class="control-group" style="clear:both;">
      <label class="control-label" for="inputOrder"></label>
      <div class="controls">
        <button class="btn btn-primary" type="submit">确认修改</button>
      </div>
    </div>

  </form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>