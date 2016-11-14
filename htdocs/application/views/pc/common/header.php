<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php if (!empty($webtitle)): ?><?php echo $webtitle; ?><?php else: ?><?php echo $company_info['webtitle']; ?><?php endif; ?></title>
    <meta name="keywords" content="<?php if (!empty($webkeyword)): ?><?php echo $webkeyword; ?><?php else: ?><?php echo $company_info['keywords']; ?><?php endif; ?>">
    <meta name="description" content="<?php if (!empty($webdesc)): ?><?php echo $webdesc; ?><?php else: ?><?php echo $company_info['webdesc']; ?><?php endif; ?>">
    <meta name="baidu-site-verification" content="EGxNdoNe1a" />
    <meta name="keywords" content="分销_商家入驻_开店_豆来网">
    <meta name="description" content="简介">

    <base href="<?php echo base_url(); ?>"/>
    <link rel="stylesheet" type="text/css" href="public/css/pc/common.css?t=<?php echo time(); ?>"/>
    <script src="public/js/jquery-1.11.3.min.js"></script>
    <script src="public/js/layer/layer.js"></script>
    <script type="text/javascript">
        var Users_Account = '';     //初始化
    </script>
    <script src="<?php echo rtrim(SHOP_URL, '/'); ?>/member/login-3jke.php"></script>
    <script type="text/javascript">
        $(function () {
            //判断登录状态
            if (Users_Account != '') {
                $('.login_bg').remove();
                $('.tishi').remove();
                $('#biz_login').html('<a target="_blank" href="<?php echo rtrim(SHOP_URL, '/'); ?>/member">' + Users_Account + ' 欢迎您！');
            }

            //商家注册弹窗
            $('#biz_login').click(function(){
                layer.open({
                    type: 2,
                    title: '商家入驻',
                    shadeClose: true,
                    shade: [0.5],
                    maxmin: true, //开启最大化最小化按钮
                    area: ['893px', '600px'],
                    content: '<?php echo rtrim(SHOP_URL, '/'); ?>/reg.php'
                });
            });
        });
    </script>
</head>

<body>
<div class="nav">
    <div class="nav-con">
        <div class="left-con">
            <a href=""><img src="public/images/pc/ruzhu_03.png"></a>
        </div>

        <div class="mid-con">
            <ul>
                <li <?php echo ($action == '' or $action == 'welcome') ? 'class="li1"' : ''; ?>><a href="">首页</a></li>
                <li <?php echo $action == 'shop' ? 'class="li1"' : ''; ?>><a href="shop">豆来开店</a></li>
                <li <?php echo $action == 'distribution' ? 'class="li1"' : ''; ?>><a href="distribution">豆来分销</a></li>
                <li><a href="javascript:;">豆来批发</a></li>
                <li <?php echo $action == 'company_news' ? 'class="li1"' : ''; ?>><a href="company_news">公司动态</a></li>
                <li <?php echo $action == 'about' ? 'class="li1"' : ''; ?>><a href="about">关于我们</a></li>
            </ul>
        </div>

        <div class="right-con">
            <span class="span1 tishi">没有账号？&nbsp;&nbsp;</span>
            <span class="span2" id="biz_login" style="cursor:pointer;">立即注册</span>
            <span class="span2">|</span>
            <span class="span2"><a target="_blank" href="question">常见问题</a></span>
        </div>
    </div>
</div>