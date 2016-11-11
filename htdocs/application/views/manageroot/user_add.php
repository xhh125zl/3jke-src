<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
  #main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
  table.table { width: 98%; margin: 0 auto; }
  input.span1 { margin: 0; text-align: center; }
  .form-horizontal { padding: 20px 0; }
  .form-horizontal .control-label { width: 75px; }
  .form-horizontal .controls { margin-left: 85px; }
  .checkbox {  }
  .tab { display: inline-block; -webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box; padding: 0 12px; height: 32px; line-height: 32px; font-size: 16px; border: 1px solid #d0d0d0; border-color: #d0d0d0; background: #f3f3f3; background: -webkit-gradient(linear,0% 0%,0% 100%,from(#fefefe),to(#e7e7e7)); background: -webkit-linear-gradient(#fefefe,#e7e7e7); background: -moz-linear-gradient(#fefefe,#e7e7e7); background: -ms-linear-gradient(#fefefe,#e7e7e7); background: linear-gradient(#fefefe,#e7e7e7); margin-left: -1px; font-size: 14px; color: #333; }
  .tab_left { border-radius: 5px 0 0 5px;  }
  .tab_right { border-radius: 0 5px 5px 0;  }
  .tab:hover { text-decoration: none; color: #333; }
  .active { background: #5FA325; color: #fff; }
  .active:hover { color: #FFF; }
</style>
<div id="main_center">
	<h1>添加用户</h1>
  <?php echo form_open('manageroot/user/user_add', array('class' => 'form-horizontal')); ?>

    <div class="control-group <?php if(!empty(form_error('user_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_name">用户名</label>
      <div class="controls">
        <input type="text" id="user_name" name="user_name" class="input-xxlarge" placeholder="用户名">
        <?php echo form_error('user_name'); ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('user_psw'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_psw">密码</label>
      <div class="controls">
        <input type="password" id="user_psw" name="user_psw" class="input-xxlarge" placeholder="密码">
        <?php echo form_error('user_psw'); ?>
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