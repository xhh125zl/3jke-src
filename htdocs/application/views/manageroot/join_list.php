<?php $this->load->view('/manageroot/admin_header'); ?>
<style type="text/css">
    #main_center h1 { display:inline; margin-left:20px; height: 65px; line-height: 65px; text-indent: 15px;  }
    #main_center form { display:inline; margin-left:100px;}
    #main_center .form-control { width:140px; }
    table.table { width: 98%; margin: 0 auto; }
</style>
<div id="main_center">
    <div style="border-bottom: 1px solid #eee;">
        <h1>首页提交信息列表</h1>
        <form class="form-inline" method="get" action="<?php echo base_url('manageroot/join/join_list'); ?>">
          <select  class="form-control" name="object">
            <option value="">请选择查询对象</option>
            <option value="1" <?php if(isset($object) && $object === '1'): ?>selected="selected"<?php endif; ?>>姓名</option>
            <option value="2" <?php if(isset($object) && $object === '2'): ?>selected="selected"<?php endif; ?>>电话</option>
            <option value="3" <?php if(isset($object) && $object === '3'): ?>selected="selected"<?php endif; ?>>邮箱</option>
            <option value="4" <?php if(isset($object) && $object === '4'): ?>selected="selected"<?php endif; ?>>QQ</option>
            <option value="5" <?php if(isset($object) && $object === '5'): ?>selected="selected"<?php endif; ?>>公司</option>
            <option value="6" <?php if(isset($object) && $object === '6'): ?>selected="selected"<?php endif; ?>>地址</option>
          </select>
          <input class="input-large" type="text" name="keyword" value="<?php if(!empty($keyword)): ?><?php echo $keyword; ?><?php endif; ?>" placeholder="请输入搜索条件" />
          <input class="input-large" type="submit" value="搜索" />
        </form>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>QQ</th>
            <th>地址</th>
            <th>提交时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($join_list)): ?>
            <?php foreach ($join_list as $k => $v): ?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['join_name']; ?></td>
                    <td><?php echo $v['join_phone']; ?></td>
                    <td><?php echo $v['join_email']; ?></td>
                    <td><?php echo $v['join_qq']; ?></td>
                    <td><?php echo $v['join_address']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>

    </table>
    <?php echo $pages; ?>
</div>
<?php $this->load->view('/manageroot/admin_footer'); ?>