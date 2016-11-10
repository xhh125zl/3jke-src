<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo isset($webTitle) && $webTitle != '' ? $webTitle : '豆来网'; ?></title>
    <meta name="keywords" content="分销_商家入驻_开店_豆来网">
    <meta name="description" content="简介">

    <base href="<?php echo base_url(); ?>"/>
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
            &nbsp;&nbsp;<a href="#question" style="color:#3e3c3c;">常见问题</a>
        </p>
    </div>
</div>

<div id="nav">
    <div class="nav-con">
        <ul>
            <li <?php echo ($action == '' or $action == 'welcome') ? 'class="li1"' : ''; ?>><a href="">首页</a></li>
            <li <?php echo $action == 'shop' ? 'class="li1"' : ''; ?>><a href="shop">无货源开店</a></li>
            <li <?php echo $action == 'distribution' ? 'class="li1"' : ''; ?>><a href="distribution">三级分销平台</a></li>
            <li><a href="javascript:;">有货源要供货</a></li>
        </ul>
    </div>
</div>