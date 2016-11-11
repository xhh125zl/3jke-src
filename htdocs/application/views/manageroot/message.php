<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
	#main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
	table.table { width: 98%; margin: 0 auto; }
	input.span1 { margin: 0; text-align: center; }
  .alert { width: 96%; margin: 0 auto; }
  .f16 { font-size: 16px; }
</style>
<div id="main_center">
	<h1>提示消息</h1>
  <div class="alert <?php if($status == 200): ?>alert-success<?php endif; ?> <?php if($status == 0): ?>alert-error<?php endif; ?>">
    <p class="f16"><strong><?php echo $msg; ?></strong> 接下来你可以选择.</p>
    <?php if(!empty($choice)): ?>
      <?php foreach ($choice as $k => $v): ?>
        <p><a href="<?php echo $v['url']; ?>"><?php echo $v['title']; ?></a></p>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>