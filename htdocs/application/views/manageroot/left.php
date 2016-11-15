<?php $this->load->view('/manageroot/admin_header'); ?>
    <style type="text/css">
        li.nav-header {
            height: 30px;
            line-height: 30px;
            border-bottom: 1px solid #ccc;
            background: #eeeeee;
            margin: 0;
            cursor:pointer;
        }

        .nav li + .nav-header {
            margin: 0;
        }

        li.nav_item {
            height: 30px;
            line-height: 30px;
            text-indent: 8px;
        }
        .show{ display:none; }
    </style>
    <script type="text/javascript">
        $(function(){
            $('.nav-header').click(function(){
                $('.son_nav_item_1').addClass('show');
                $(this).next('.son_nav_item_1').removeClass('show');
            });
        });
    </script>
    <ul class="nav">

        <ul>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/company_setting'); ?>" target="main"><i class="icon-hand-right"></i> 公司设置</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/web_setting'); ?>" target="main"><i class="icon-hand-right"></i> 网站设置</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/study_catgory/catgory_add'); ?>" target="main"><i class="icon-hand-right"></i> 添加分类</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/study_catgory/catgory_list'); ?>" target="main"><i class="icon-hand-right"></i> 分类列表</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/study/study_add'); ?>" target="main"><i class="icon-hand-right"></i> 添加文档</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/study/study_list'); ?>" target="main"><i class="icon-hand-right"></i> 管理文档</a></li>
        </ul>
        
    </ul>

<?php $this->load->view('/manageroot/admin_footer'); ?>