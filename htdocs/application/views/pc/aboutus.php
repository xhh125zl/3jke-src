<!--头部-->
<?php $this->load->view('pc/common/header'); ?>

<link href="<?php echo base_url('public/css/pc/aboutus.css'); ?>" rel="stylesheet" type="text/css">

<!--banner部分-->
<div class="header" style=" background: url(<?php echo base_url($company_info['aboutus_banner']); ?>) no-repeat center; height:392px;">
</div>

<div id="con">
    <ul id="tags">
        <li class="selectTag"><a onClick="selectTag('tagContent0',this)" href="javascript:void(0)">关于我们</a></li>
        <li><a onClick="selectTag('tagContent1',this)" href="javascript:void(0)">公司面貌</a></li>
        <li><a onClick="selectTag('tagContent2',this)" href="javascript:void(0)">联系我们</a></li>
        <li><a onClick="selectTag('tagContent3',this)" href="javascript:void(0)">人才招聘</a></li>
    </ul>
    <div id="tagContent">
        <!-- 关于我们  公司简介 start -->
        
        <div class="tagContent selectTag" id="tagContent0" style=" background:#eeefef; padding:40px 98px 40px 98px; width:900px;font-size:16px;line-height:25px;">
        <?php if(!empty($company_info['company_desc'])): ?>
            <p style=" width:900px; margin:0 auto;"><?php echo $company_info['company_desc'];?></p>
        <?php endif; ?>
        </div>
        <!-- 关于我们  公司简介 end -->

        <!-- 公司面貌 start -->
        <div class="tagContent" id="tagContent1">
        <?php if(!empty($company_face)): ?>
            <div class="div2">
                <?php foreach($company_face as $k => $v): ?>
                <div class="xf"><img src="<?php echo base_url($v['face_pic']); ?>" alt="网中网_微信分销_三级分销_<?php echo $v['face_title']; ?>">
                    <div class="hover1"><p class="pp"><?php echo $v['face_title']; ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
        <!-- 公司面貌 start -->

        <!-- 联系我们 start -->
        <div class="tagContent" id="tagContent2">
            <div class="div3">
                <div class="div3_1" id="dituContent"><img src="<?php if(!empty($company_info['address_img'])): ?><?php echo base_url($company_info['address_img']); ?><?php endif; ?>" alt="网中网_微信分销_三级分销_联系我们"></div>
                <div class="div3_2">
                    <ul>
                        <li><img src="public/images/pc/lianxiw_03.png">&nbsp;&nbsp;&nbsp;&nbsp;总部地址：<?php if(!empty($company_info['company_address'])): ?><?php echo $company_info['company_address'];?><?php endif; ?></li>
                        <li><img src="public/images/pc/lianxiw_07.png">&nbsp;&nbsp;&nbsp;&nbsp;全国统一售前咨询：<?php if(!empty($company_info['company_contactNum'])): ?><?php echo $company_info['company_contactNum'];?><?php endif; ?></li>
                        <li><img src="public/images/pc/lianxiw_11.png">&nbsp;&nbsp;&nbsp;&nbsp;电话：<?php if(!empty($company_info['company_contactNum'])): ?><?php echo $company_info['company_contactNum'];?><?php endif; ?></li>
                        <li><img src="public/images/pc/lianxiw_15.png">&nbsp;&nbsp;&nbsp;&nbsp;邮箱：<?php if(!empty($company_info['company_email'])): ?><?php echo $company_info['company_email'];?><?php endif; ?></li>
                    </ul>
                    <a target="_blank" href="<?php echo $company_info['consult_url']; ?>"><img src="public/images/pc/an.png"></a>
                </div>
            </div>
        </div>
        <!-- 联系我们 end -->

        <!-- 人才招聘 start -->
        <div class="tagContent" id="tagContent3">
        <?php if(!empty($company_recruit)): ?>
        <?php foreach($company_recruit as $k => $v): ?>
            <div class="div4">
                <p class="recruit_tit"><?php echo $v['recruit_post']; ?></p>
                <p><?php echo $v['post_desc']; ?></p>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <!-- 人才招聘 end -->
    </div>
</div>

<script type="text/javascript">
    function selectTag(showContent, selfObj) {
        // 操作标签
        var tag = document.getElementById("tags").getElementsByTagName("li");
        var taglength = tag.length;
        for (i = 0; i < taglength; i++) {
            tag[i].className = "";
        }
        selfObj.parentNode.className = "selectTag";
        // 操作内容
        for (i = 0; j = document.getElementById("tagContent" + i); i++) {
            j.style.display = "none";
        }
        document.getElementById(showContent).style.display = "block";
    }
</script>

<!-- 公司发展历程 start -->
<?php if(!empty($company_history)): ?>
<div class="li_cheng">
    <div class="li_cheng1">
        <img src="public/images/pc/lianxiw_04.png" alt="网中网_微信分销_三级分销_发展历程">
        <ul>
        <?php foreach($company_history as $k => $v): ?>
            <li>
                <p class="p_1"><?php echo $v['history_time']; ?>年</p>
                <p class="p_2"><?php echo $v['history_desc']; ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
<!-- 公司发展历程 end -->

<!-- 企业文化 start -->
<div class="company_con">
    <img src="public/images/pc/lianxi11_02.png" class="t_t" alt="网中网_微信分销_三级分销_企业文化">
    <div class="company_con1">
        <img src="public/images/pc/lianxi11_05.png" alt="网中网_微信分销_三级分销_企业文化">
        <img src="public/images/pc/lianxi11_08.png" alt="网中网_微信分销_三级分销_企业使命">
        <img src="public/images/pc/lianxi11_10.png" alt="网中网_微信分销_三级分销_企业目标">
        <img src="public/images/pc/lianxi11_13.png" alt="网中网_微信分销_三级分销_企业口号">
    </div>
</div>
<!-- 企业文化 end -->

<!--底部-->
<?php $this->load->view('pc/common/footer'); ?>