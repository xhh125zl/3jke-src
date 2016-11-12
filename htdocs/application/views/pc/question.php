<!--头部-->
<?php $this->load->view('pc/common/header'); ?>

<link href="<?php echo base_url('public/css/pc/dynamic.css'); ?>" rel="stylesheet" type="text/css">

<script type="text/javascript">
    /*$(function(){
        $('.search_btn').click(function(){
            var keyword = $.trim($('input[name="keyword"]').val());
            if(keyword == '') {
                layer.alert('请填写搜索的内容');
            } else {
                $('#search_form').submit();
            }
        });
    });*/
</script>

<div class="header">
    <!-- <div id="banner"></div>
    <div class="clear"></div> -->
    <div class="search">
        <div class="action_search">
        <form method="get" action="<?php echo base_url('company_news/search'); ?>" id="search_form">
            <input type="text" name="keyword" maxlength="15" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" class="search_content"/>
            <input type="submit" value="" class="search_btn"/>
            <!-- <input type="image" value="" src="public/images/pc/search.jpg" style="" class="search_btn"/> -->
        </form>
        </div>
        <div class="search_keywords">
        <?php if(!empty($search_keywords)): ?>
        <?php foreach($search_keywords as $k => $v): ?>
            <a href="<?php echo base_url('company_news/search?keyword='.$v['title']); ?>"><?php echo $v['title']; ?></a>
        <?php endforeach; ?>
    <?php endif; ?>
        </div>
    </div>
</div>
<div class="clear"></div>

<div class="main">

    <div class="main_right">
        <div id="content">
            <?php if(!empty($company_news)): ?>
                <?php foreach($company_news as $k => $v): ?>
                <div class="news">
                    <a href="<?php echo base_url('company_news/index').'/'.$v['study_id'].'.html'; ?>">
                        <div class="new_img">
                            <img src="<?php if(!empty($v['cover_img'])){echo base_url($v['cover_img']);} else{echo 'public/images/pc/action_01.jpg';} ?>" alt="网中网_<?php echo $v['title']; ?>" style="width:100%; height:100%;">
                        </div>
                    </a>
                    <div class="new_msg">
                        <div class="new_title"><a href="<?php echo base_url('company_news/index').'/'.$v['study_id'].'.html'; ?>"><?php echo mb_substr($v['title'],0,20,'utf8'); ?></a></div>
                        <div class="new_content"><a href="<?php echo base_url('company_news/index').'/'.$v['study_id'].'.html'; ?>"><?php echo mb_substr($v['description'],0,90,'utf8'); ?></a></div>
                    </div>
                </div>
                <?php endforeach; ?>

            <?php elseif (!empty($study_content)): ?>
                <div><a class="a_cover" href="javascript:history.back();"><<返回</a></div>
                <h1 style="text-align:center; width:98%; line-height:40px; font-size:18px;"><?php echo $study_content['title']; ?></h3>
                <?php echo $study_content['content']; ?>

            <?php elseif(!empty($study_list)): ?>
                <?php foreach($study_list as $k => $v): ?>
                    <div style="clear:both;width:930px;height:30px;">
                        <div style="float:left;">
                            <a href="<?php echo base_url('company_news/index').'/'.$v['study_id'].'.html'; ?>" style="text-align:left;" class="a_cover"><?php echo mb_substr($v['title'], 0, 45, 'utf-8'); ?></a>
                        </div>
                        <div style="float:right;">
                            <span style="text-align:right;"><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p style="text-align:center;">没有找到你要的内容...</p>
            <?php endif; ?>

            <div class="page">
                <?php if (!empty($pages)) {echo $pages;} ?>
            </div>
        </div>
    </div>
</div>

<!--底部-->
<?php $this->load->view('pc/common/footer'); ?>