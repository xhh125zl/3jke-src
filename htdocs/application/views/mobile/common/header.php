<base href="<?php  echo base_url();?>"/>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo isset($webTitle) && $webTitle != '' ? $webTitle : '豆来网'; ?></title>
    <meta name="description" content="简介">
    <meta name="keywords" content="关键字">
    <link rel="stylesheet" type="text/css" href="public/css/mobile/index.css?t=<?php echo time(); ?>"/>
</head>

<body>

<div id="header">
    <div class="logo">
        <h1>
            <a href="<?php echo base_url(); ?>">
                <img src="public/images/mobile/ruzhu_03.png" alt="豆来分销"/>
            </a>
        </h1>
    </div>
    <div class="right-a">
        <p>
            <a href="<?php echo rtrim(B2C_URL, '/'); ?>/user/reg.php">没有账号&nbsp;|&nbsp;立即注册</a>
            &nbsp;&nbsp;常见问题
        </p>
    </div>
</div>

<div id="nav">
    <div class="nav-con">
        <ul>
            <li <?php if ($action == '' || $action == 'welcome') {echo 'class="li1"';} ?>><a href="<?php echo site_url(); ?>">首页</a></li>
            <li <?php if ($action == 'shop') {echo 'class="li1"';} ?>><a href="<?php echo site_url('shop'); ?>">无货源开店</a></li>
            <li <?php if ($action == 'distribution') {echo 'class="li1"';} ?>><a href="<?php echo site_url('distribution'); ?>">三级分销平台</a></li>
            <li><a href="javascript:;">有货源要供货</a></li>
        </ul>
    </div>
</div>