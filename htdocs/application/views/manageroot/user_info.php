<?php $this->load->view('/manageroot/admin_header'); ?>

<style type="text/css">
  #main_center h1 { height: 65px; line-height: 65px; text-indent: 15px; border-bottom: 1px solid #eee; }
  table.table { width: 98%; margin: 0 auto; }
  input.span1 { margin: 0; text-align: center; }
  .form-horizontal { padding: 20px 0; }
  .form-horizontal .control-label { width: 100px; }
  .form-horizontal .controls { margin-left: 110px; }
  .checkbox {  }
</style>
<script type="text/javascript">
  function bind_url(user_id , method) {
    //prompt层
    layer.prompt({
      title: '请输入你的登陆密码，并确认',
      formType: 1 //prompt风格，支持0-2
    }, function(pass){
        $.ajax({
          type:'post',
          url:'<?php echo base_url('manageroot/user/check_psw'); ?>',
          data:"user_id="+user_id+"&user_psw="+pass,
          success:function(data){
            if(data['status'] == 1) {
              layer.prompt({title: '填写你要绑定的域名，并确认', formType: 2}, function(text){
                if($.trim(text) == '') {
                  layer.alert('没有填写信息');
                }
                $.ajax({
                  type:'post',
                  url:'<?php echo base_url('manageroot/user').'/'; ?>'+method,
                  data:"user_id="+user_id+"&user_url="+text,
                  success:function(data1) {
                    if(data1['status'] == 1) {
                      layer.msg(data1['content']);
                      location.reload();
                    } else {
                      layer.alert(data1['content']);
                    }
                  },
                  error:function() {
                    layer.alert('数据提交失败，请重试');
                  },
                  dataType:'json'
                });
              });
            } else {
              layer.alert(data['content']);
            }
          },
          error:function(){
              layer.alert('数据提交失败');
          },
          dataType:'json'
      });      
    });
  }
</script>
<div id="main_center">
	<h1>个人信息</h1>
<form class="form-horizontal">
    <div class="control-group <?php if(!empty(form_error('user_name'))): ?>error<?php endif; ?>">
      <label class="control-label" for="user_name">用户名</label>
      <div class="controls">
        <?php echo $user_info['user_name']; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('addtime'))): ?>error<?php endif; ?>">
      <label class="control-label" for="addtime">分配域名</label>
      <div class="controls">
        <?php echo base_url('/').'?UserId='.$user_info['user_id']; ?>
      </div>
    </div>

    <div class="control-group <?php if(!empty(form_error('login_nums'))): ?>error<?php endif; ?>">
      <label class="control-label" for="login_nums">绑定域名</label>
      <div class="controls">
      <?php if(!empty($user_info['user_url'])): ?>
        <?php echo $user_info['user_url']; ?>
        <a href="javascript:bind_url(<?php echo $user_info['user_id']; ?> , 'url_edit')">修改域名</a>
      <?php else: ?>
        没有绑定个人域名
        <a href="javascript:bind_url(<?php echo $user_info['user_id']; ?> , 'set_url')">绑定域名</a>
      <?php endif?>
      </div>
    </div>

</form>
</div>

<?php $this->load->view('/manageroot/admin_footer'); ?>