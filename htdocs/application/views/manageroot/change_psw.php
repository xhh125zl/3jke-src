<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
  table.table { width: 98%; margin: 0 auto; }
  input.span1 { margin: 0; text-align: center; }
  .form-horizontal { padding: 20px 0; }
  .form-horizontal .control-label { width: 75px; }
  .form-horizontal .controls { margin-left: 85px; }

</style>

<div id="main_center">
	<h1>修改用户登录信息</h1>
  <?php echo form_open('manageroot/user/change_psw/', array('class' => 'form-horizontal')); ?>
    <div class="control-group <?php if(!empty(form_error('user_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_name">用户名</label>
      <div class="controls">
        <input type="text" name="user_name" value="<?php echo $user_info['user_name']; ?>" />
        <?php echo form_error('user_name'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('user_opsw'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_opsw">原密码</label>
      <div class="controls">
        <input type="password" id="user_opsw" name="user_opsw" class="input-xxlarge" placeholder="原密码">
        <?php echo form_error('user_opsw'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('user_npsw'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_npsw">新密码</label>
      <div class="controls">
        <input type="password" id="user_npsw" name="user_npsw" class="input-xxlarge" placeholder="新密码">
        <?php echo form_error('user_npsw'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('user_spsw'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_spsw">确认密码</label>
      <div class="controls">
        <input type="password" id="user_spsw" name="user_spsw" class="input-xxlarge" placeholder="确认密码">
        <?php echo form_error('user_spsw'); ?>
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