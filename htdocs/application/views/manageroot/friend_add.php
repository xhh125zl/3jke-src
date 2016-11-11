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
	<h1>添加友情链接</h1>
  <?php echo form_open_multipart('manageroot/friend/add', array('class' => 'form-horizontal')); ?>

    <div class="control-group" style="display:none;">
      <label class="control-label" for="inputOrder">类型</label>
      <div class="controls">
        <label class="radio">
          <input type="radio" name="type" id="optionsRadios1" value="0" >
          合作伙伴
        </label>
        <label class="radio">
          <input type="radio" name="type" id="optionsRadios2" value="1" checked="checked">
          友情链接
        </label>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('friend_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="friend_name">名称</label>
      <div class="controls">
        <input type="text" id="friend_name" name="friend_name" class="input-xxlarge" placeholder="链接名称">
        <?php echo form_error('friend_name'); ?>
      </div>
    </div>
    <?php if ($type == 0 || empty($type)): ?>
    <div class="control-group <?php if(!empty(form_error('friend_logo'))): ?>error<?php endif; ?>">
      <label class="control-label" for="friend_logo">链接标识</label>
      <div class="controls">
        <input class="btn" type="file" name="friend_logo">
      </div>
    </div>
    <?php endif; ?>

    <div class="control-group <?php if(!empty(form_error('friend_href'))): ?>error<?php endif; ?>">
      <label class="control-label" for="friend_href">链接地址</label>
      <div class="controls">
        <input type="text" id="friend_href" name="friend_href" class="input-xxlarge" placeholder="链接地址 格式为 http://www.baidu.com  或  www.baidu.com">
        <?php echo form_error('friend_href'); ?>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="friend_status">启用状态</label>
      <div class="controls">
        <input type="radio" id="friend_status" name="friend_status" value="1" checked="checked" class="input-xxlarge">启用
        &nbsp;&nbsp;
        <input type="radio" id="friend_status" name="friend_status" value="0" class="input-xxlarge">停用
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