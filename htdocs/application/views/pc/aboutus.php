<?php $this->load->view('pc/common/header'); ?>

    <link href="<?php echo base_url('public/css/pc/aboutus.css'); ?>" rel="stylesheet" type="text/css">

    <div class="banner"></div>
    <!--————————————————nav结束——————————————————-->

    <div class="tit1">
        <div class="t1">
            <img src="public/images/pc/jj_05.png">
        </div>
    </div>

    <div class="jianjie">
        <div class="jianjie-con">
            <img src="public/images/pc/jj_09.png">
            <?php echo $company_info['company_desc']; ?>
        </div>
    </div>

    <div class="wenhau">
        <div class="wenhau-con">
            <img src="public/images/pc/jj_13.png">
        </div>

        <div class="img-con">
            <div><img src="public/images/pc/jj_16.png"></div>
            <div><img src="public/images/pc/jj_18.png"></div>
            <div><img src="public/images/pc/jj_20.png"></div>
            <div><img src="public/images/pc/jj_22.png"></div>
        </div>
    </div>

    <div class="tit1">
        <div class="t1">
            <img src="public/images/pc/jj_29.png">
        </div>
    </div>

    <div class="lianxi">
        <div class="lianxi-con">
            <div class="l-con">
                <p><img src="public/images/pc/tubiao_05.png"><span>电话：<?php echo $company_info['company_contactNum']; ?></span></p>
                <p><img src="public/images/pc/tubiao_08.png"><span>邮箱：<?php echo $company_info['company_email']; ?></span></p>
                <p><img src="public/images/pc/tubiao_11.png"><span>全国统一售前咨询：<?php echo $company_info['company_contactNum']; ?></span></p>
                <p class="p4"><img src="public/images/pc/tubiao_15.png"><span>地址：<?php echo $company_info['company_address']; ?></span></p>
            </div>

            <div class="r-con">
                <img src="public/images/pc/jj_33.png">
            </div>
        </div>
    </div>
    <div class="clear"></div>

    <!--——————————————————footer开始————————————————————————-->
<?php $this->load->view('pc/common/footer'); ?>