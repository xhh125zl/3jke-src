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
        <?php if($role == 0): ?>    <!-- 客户可操作项 -->
        <li class="nav-header"><i class="icon-wrench"></i> 客户设置</li>
        <ul class="son_nav_item_1">
            <li class="nav_item"><a href="<?php echo site_url('manageroot/user/user_info'); ?>" target="main"><i class="icon-hand-right"></i> 个人信息</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/company_setting'); ?>" target="main"><i class="icon-hand-right"></i> 公司设置</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/web_setting'); ?>" target="main"><i class="icon-hand-right"></i> 站点设置</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/qq_add'); ?>" target="main"><i class="icon-hand-right"></i> 添加客服(QQ)</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/qq_list'); ?>" target="main"><i class="icon-hand-right"></i> 客服(QQ)列表</a></li>
            <li class="nav_item"><a href="<?php echo site_url('manageroot/join/join_list'); ?>" target="main"><i class="icon-hand-right"></i> 首页客户提交资料</a></li>
        </ul>
        <?php endif; ?>

        <?php if($role == 1): ?>    <!-- 非管理员不能查看 并在继承父类中做限制 -->
            <ul>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/company_setting'); ?>" target="main"><i class="icon-hand-right"></i> 公司设置</a></li>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/web_setting'); ?>" target="main"><i class="icon-hand-right"></i> 网站设置</a></li>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/company_history_list'); ?>" target="main"><i class="icon-hand-right"></i> 发展历程</a></li>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/company_face_list'); ?>" target="main"><i class="icon-hand-right"></i> 公司面貌</a></li>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/setting/company_recruit_list'); ?>" target="main"><i class="icon-hand-right"></i> 人才招聘</a></li>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/study/study_add'); ?>" target="main"><i class="icon-hand-right"></i> 添加文档</a></li>
                <li class="nav_item"><a href="<?php echo site_url('manageroot/study/study_list'); ?>" target="main"><i class="icon-hand-right"></i> 管理文档</a></li>
            </ul>
            
        <?php endif; ?>
        
    </ul>

<?php $this->load->view('/manageroot/admin_footer'); ?>