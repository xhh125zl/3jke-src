<!--头部-->
<?php $this->load->view('pc/common/header'); ?>

<link href="public/css/pc/question.css" rel="stylesheet" type="text/css">

<div class="header">
    <!-- <div id="banner"></div>
    <div class="clear"></div> -->
    <div class="search">
        <div class="action_search">
        <form method="get" action="<?php echo base_url('question/search'); ?>" id="search_form">
            <input type="text" name="keyword" maxlength="15" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" class="search_content"/>
            <input type="submit" value="" class="search_btn"/>
        </form>
        </div>
        <div class="search_keywords">
        <?php if(!empty($search_keywords)): ?>
            <?php foreach($search_keywords as $k => $v): ?>
                <a href="<?php echo base_url('question/search?keyword='.$v['title']); ?>"><?php echo $v['title']; ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>
</div>
<div class="clear"></div>

<div class="main">

    <div class="main_right">
        <div id="content">
            <?php if(!empty($question_list)): ?>
                <?php foreach($question_list as $k => $v): ?>
                    <div style="clear:both;width:930px;height:30px;">
                        <div style="float:left;">
                            <a href="<?php echo base_url('question/index').'/'.$v['study_id'].'.html'; ?>" style="text-align:left;" class="a_cover"><?php echo mb_substr($v['title'], 0, 45, 'utf-8'); ?></a>
                        </div>
                        <div style="float:right;">
                            <span style="text-align:right;"><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php elseif (!empty($question_con)): ?>
                <div><a class="a_cover" href="javascript:history.back();"><<返回</a></div>
                <h1 style="text-align:center; width:98%; line-height:40px; font-size:18px;"><?php echo $question_con['title']; ?></h3>
                <?php echo $question_con['content']; ?>

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