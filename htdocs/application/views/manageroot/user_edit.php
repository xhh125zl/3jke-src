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
	<h1>重置用户密码</h1>
  <?php echo form_open('manageroot/user/user_edit/'.$user_info['user_id'], array('class' => 'form-horizontal')); ?>

    <div class="control-group <?php if(!empty(form_error('user_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_name">用户名</label>
      <div class="controls">
        <?php echo $user_info['user_name']; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('user_psw'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_psw">重置密码</label>
      <div class="controls">
        <input type="text" id="user_psw" name="user_psw" class="input-xxlarge" placeholder="重置密码">
        <?php echo form_error('user_psw'); ?>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="inputOrder"></label>
      <div class="controls">
        <button class="btn btn-primary" type="submit">确认重置</button>
      </div>
    </div>

  </form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>