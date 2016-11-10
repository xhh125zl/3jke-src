<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo isset($webTitle) && $webTitle != '' ? $webTitle : '豆来网'; ?></title>
    <meta name="keywords" content="分销_商家入驻_开店_豆来网">
    <meta name="description" content="简介">

    <base href="<?php echo base_url(); ?>"/>
    <link rel="stylesheet" type="text/css" href="public/css/pc/index.css?t=<?php echo time(); ?>"/>
    <script src="public/js/jquery-1.11.3.min.js"></script>
    <script src="public/js/layer/layer.js"></script>
    <script src="<?php echo rtrim(SHOP_URL, '/'); ?>/member/login-3jke.php"></script>
</head>

<body>
<div class="nav">
    <div class="nav-con">
        <div class="left-con">
            <img src="public/images/pc/ruzhu_03.png">
        </div>

        <div class="mid-con">
            <ul>
                <li <?php echo ($action == '' or $action == 'welcome') ? 'class="li1"' : ''; ?>><a href="">首页</a></li>
                <li <?php echo $action == 'shop' ? 'class="li1"' : ''; ?>><a href="shop">豆来开店</a></li>
                <li <?php echo $action == 'distribution' ? 'class="li1"' : ''; ?>><a href="distribution">豆来分销</a></li>
                <li><a href="javascript:;">豆来批发</a></li>
                <li><a href="javascript:;">关于我们</a></li>
            </ul>
        </div>

        <div class="right-con">
            <span class="span2" id="biz_login"><a target="_blank" href="<?php echo rtrim(SHOP_URL, '/'); ?>/reg.php">没有账号？ | 立即注册</a></span>
            <span class="span1"><a href="#question">常见问题</a></span>
        </div>
    </div>
</div>