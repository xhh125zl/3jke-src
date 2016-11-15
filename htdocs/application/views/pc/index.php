<?php $this->load->view('pc/common/header'); ?>

<link href="public/css/pc/index.css?t=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <div class="banner"></div>

    <div class="login_bg">
        <iframe src="<?php echo rtrim(SHOP_URL, '/'); ?>/member/login.php" style="width:100%; height:100%; border:0;" scrolling="no"></iframe>
    </div>

    <div class="gonggao">
        <div class="gonggao-con">
            <!-- <div class="more_news"><a target="_blank" href="company_news">查看更多 ></a></div> -->
            <div class="system_news">
            <?php if (! empty($company_news)): ?>
                <?php foreach ($company_news as $k => $v): ?>
                <a target="_blank" href="company_news/index/<?php echo $v['study_id']; ?>.html" title="<?php echo $v['title']; ?>"><?php echo mb_substr($v['title'], 0, 10, 'utf-8'); ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="yewu">
        <div class="tit1">
            <img src="public/images/pc/ruzhu_13.png">
        </div>
    </div>

    <div class="yewy-con">
        <div class="con">
            <div class="con-con1 wd">
                <p class="p1">产品库挑选</p>
                <p class="p2"><span>适合：</span>没有产品，想开分销商城的用户，不能发布自己的产品，只能代销。</p>
                <a target="_blank" href="<?php echo rtrim(SHOP_URL, '/'); ?>/member/">立即进入</a>
            </div>

            <div class="con-con2 wd">
                <p class="p1">开通官方分销商城</p>
                <p class="p2"><span>适合：</span>有产品，可绑定自己的微信公众号，独立运营，同时还可以把产品推荐到产品库，同其他代销。</p>
                <a target="_blank" href="<?php echo rtrim(SHOP_URL, '/'); ?>/member/">立即进入</a>
            </div>

            <div class="con-con3 wd">
                <p class="p1">供货商，只供货</p>
                <p class="p2"><span>适合：</span>只向平台提供货源，不做自己的独立的店铺</p>
                <a target="_blank" href="<?php echo rtrim(SHOP_URL, '/'); ?>/member/">立即进入</a>
            </div>
        </div>
    </div>

    <div class="yewu">
        <div class="tit1">
            <img src="public/images/pc/ruzhu_17.png">
        </div>
    </div>

    <div class="youshi">
        <div class="youshi-con">
            <div class="youshi1 dd">
                <p class="bt">1. 产品互卖，业务互推</p>
                <p class="tu"><img src="public/images/pc/ruzhu_23.png"><span>布偶牛奴迪今年的<br>诉苦了比率女想吃</span></p>
            </div>

            <div class="youshi2 dd">
                <p class="bt">2. 分销系统，会员推广</p>
                <p class="tu"><img src="public/images/pc/ruzhu_20.png"><span>布偶牛奴迪今年的<br>诉苦了比率女想吃</span></p>
            </div>

            <div class="youshi3 dd">
                <p class="bt">3. 豪华店铺一键生成</p>
                <p class="tu"><img src="public/images/pc/bi_03.png"><span>布偶牛奴迪今年的<br>诉苦了比率女想吃</span></p>
            </div>
            <div class="youshi4 dd">
                <p class="bt">4. 手机管理，随时随地</p>
                <p class="tu"><img src="public/images/pc/ruzhu_28.png"><span>布偶牛奴迪今年的<br>诉苦了比率女想吃</span></p>
            </div>

            <div class="youshi5 dd">
                <p class="bt">5. 数据分析，精准营销</p>
                <p class="tu"><img src="public/images/pc/ruzhu_30.png"><span>布偶牛奴迪今年的<br>诉苦了比率女想吃</span></p>
            </div>

            <div class="youshi6 dd">
                <p class="bt">6. 原创文案，一键代发</p>
                <p class="tu"><img src="public/images/pc/bi_07.png"><span>布偶牛奴迪今年的<br>诉苦了比率女想吃</span></p>
            </div>
        </div>
    </div>

    <br>
    <div class="lizi">
        <div class="lizi-con">
            <img src="public/images/pc/ruzhu_40.png">
        </div>
    </div>

    <div class="s">
        <div class="sh">
            <div style=" background:url(public/images/pc/f_03.png) 0px 0px no-repeat;"><p>服装</p></div>
            <div style=" background:url(public/images/pc/f_05.png) 0px 0px no-repeat;"><p>化妆品</p></div>
            <div style=" background:url(public/images/pc/f_071.png) 0px 0px no-repeat;"><p>食品</p></div>
            <div style=" background:url(public/images/pc/f_09.png) 0px 0px no-repeat;"><p>电器</p></div>
            <div style=" background:url(public/images/pc/f_11.png) 0px 0px no-repeat;"><p>家居</p></div>
            <div style=" background:url(public/images/pc/f_13.png) 0px 0px no-repeat;"><p>健身</p></div>
            <div style=" background:url(public/images/pc/f_15.png) 0px 0px no-repeat;"><p>旅游</p></div>
            <div style=" background:url(public/images/pc/f_17.png) 0px 0px no-repeat;"><p>批发零售</p></div>
            <div style=" background:url(public/images/pc/f_20.png) 0px 0px no-repeat;"><p>微商电商</p></div>
            <div style=" background:url(public/images/pc/f_32.png) 0px 0px no-repeat;"><p>教育培训</p></div>
            <div style=" background:url(public/images/pc/f_34.png) 0px 0px no-repeat;"><p>金融理财</p></div>
            <div style=" background:url(public/images/pc/f_36.png) 0px 0px no-repeat;"><p>酒店</p></div>
            <div style=" background:url(public/images/pc/f_38.png) 0px 0px no-repeat;"><p>餐饮</p></div>
            <div style=" background:url(public/images/pc/f_43.png) 0px 0px no-repeat;"><p>KTV</p></div>
            <div style=" background:url(public/images/pc/f_45.png) 0px 0px no-repeat;"><p>婚庆</p></div>
            <div style=" background:url(public/images/pc/f_48.png) 0px 0px no-repeat;"><p>医疗</p></div>
            <div style=" background:url(public/images/pc/f_50.png) 0px 0px no-repeat;"><p>房产</p></div>
            <div style=" background:url(public/images/pc/ffff_03.png) 0px 0px no-repeat;"><p>家政服务</p></div>
        </div>
    </div>

    <br>
    <div class="wenti" id="question">
        <div class="wenti-con">
            <img src="public/images/pc/ruzhu_42.png">
        </div>
    </div>

    <div class="question">
        <div class="question-con">

            <div>
                <p class="ask"><img src="public/images/pc/fang_03.png"><span>&nbsp;&nbsp;1、什么是邀请入驻？</span></p>
                <p class="da"><span>解答：</span>邀请入驻是不对外公开招商，平台将根据消费者需求及平台定位综合评估后邀请符合需求的商户或品牌进驻。</p>
            </div>

            <div>
                <p class="ask"><img src="public/images/pc/fang_03.png"><span>&nbsp;&nbsp;2、入驻企业和个人的区别？</span></p>
                <p class="da"><span>解答：</span>入驻时选择企业，则要上传企业三证：企业营业执照、组织机构代码、税务登记证。 选择个人入驻，则需要上传身份证原件正反面、个人近照及手持身份。</p>
            </div>

            <div>
                <p class="ask"><img src="public/images/pc/fang_03.png"><span>&nbsp;&nbsp;3、经营的产品类目比较多，入驻时只能选择一个主营类目怎么办？</span></p>
                <p class="da"><span>解答：</span>入驻平台时，先选重要主营类目，后期还可申请添加销售其他类目产品，类目一旦选择后，便不能再更改。</p>
            </div>

            <div>
                <p class="ask"><img src="public/images/pc/fang_03.png"><span>&nbsp;&nbsp;4、为什么商家填写邮箱资料时，提示邮箱不合法？</span></p>
                <p class="da"><span>解答：</span>如若填写QQ邮箱，则一定要填写小写的@qq.com。还有填写的邮箱最好是同一个类型的邮箱（例如：都是qq邮箱）。</p>
            </div>

            <div>
                <p class="ask"><img src="public/images/pc/fang_03.png"><span>&nbsp;&nbsp;5、保证金以后可以退吗？</span></p><br>
                <p class="da"><span>解答：</span>
                    当商家退出拼多多平台时，保证金会退还给商家。退保证金的流程为：<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;①商家申请关闭其在拼多多平台运营的店铺；<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;②商家下架要关闭的店铺中所有售卖商品；<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;③以该店铺最后一个确认收货订单的时间为基准，经过30天无售后监测期；<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;④完成关店的最终审核，保证金会在最终审核后的工作日30天内到账。<br>
                </p>
            </div>

        </div>
    </div>
    <div class="clear"></div>

<?php $this->load->view('pc/common/footer'); ?>