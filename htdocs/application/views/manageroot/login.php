<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>好分销后台登录</title>
<style type="text/css">
	form { display: block; overflow: hidden; width: 600px; margin: 0 auto; }

	.txt { height: 30px; line-height: 30px; font-size: 14px; text-indent: 5px; }
	.btn { margin: 20px auto 10px; height: 25px; line-height: 25px; }
</style>
</head><body>
<?php echo validation_errors(); ?>

<?php echo form_open('manageroot/login'); ?>

<h5>用户名</h5>
<input type="text" name="username" value="" class="txt" size="50" />

<h5>密码</h5>
<input type="password" name="password" value="" class="txt" size="50" />

<div><input type="submit" value="登 录 系 统" class="btn" /></div>

</form>
</body></html>