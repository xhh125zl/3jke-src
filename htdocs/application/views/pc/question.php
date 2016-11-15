<!--头部-->
<?php $this->load->view('pc/common/header'); ?>

<link href="public/css/pc/question.css?t=<?php echo time(); ?>" rel="stylesheet" type="text/css">

<div class="header">
    <div class="question-tit">
        <div class="tit">
            <span class="tit1">Problems</span>&nbsp;&nbsp;<span class="tit2">常见问题</span>
        </div>
        <div class="search">
            <form method="get" action="<?php echo base_url('question/search'); ?>" id="search_form">
                <input type="text" name="keyword" maxlength="15" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" class="search_content" placeholder="输入要查询的内容"/>
                <input type="submit" value="搜索" class="search_btn"/>
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>

<div class="main">
    <div class="question_nav">
        <ul>
            <li>分类1</li>
            <li>
                <ul>
                    <li>分类2</li>
                    <li>分类2</li>
                    <li>分类2</li>
                    <li>分类2</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="clear"></div>

    <div class="question">
        <div class="content">
            <?php if(!empty($question_list)): ?>
                <?php foreach($question_list as $k => $v): ?>
                    <div style="clear:both;width:1100px;height:30px;">
                        <div style="float:left;">
                            <a href="<?php echo base_url('question/index').'/'.$v['study_id'].'.html'; ?>" style="text-align:left;" class="a_cover"><?php echo mb_substr($v['title'], 0, 45, 'utf-8'); ?></a>
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