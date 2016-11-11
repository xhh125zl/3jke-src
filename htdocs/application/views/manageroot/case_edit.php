<?php $this->load->view('/manageroot/admin_header'); ?>
    <style type="text/css">
        #main_center h1 {
            height: 65px;
            line-height: 65px;
            text-indent: 15px;
            border-bottom: 1px solid #eee;
        }

        table.table {
            width: 98%;
            margin: 0 auto;
        }

        input.span1 {
            margin: 0;
            text-align: center;
        }

        .form-horizontal {
            padding: 20px 0;
        }

        .form-horizontal .control-label {
            width: 75px;
        }

        .form-horizontal .controls {
            margin-left: 85px;
        }

        .checkbox {
        }
    </style>
    <div id="main_center">
        <h1>修改客户案例</h1>
        <?php echo form_open_multipart('manageroot/customer_case/case_edit/' . $single_info['id'], array('class' => 'form-horizontal')); ?>

        <div class="control-group <?php if (!empty(form_error('product_id'))): ?>error<?php endif; ?>">
            <label class="control-label" for="product_id">选择分类</label>
            <div class="controls">
                <select class="span3" name="product_id">
                    <?php if (!empty($product_arr)): ?>
                        <?php foreach ($product_arr as $k => $v): ?>
                            <option value="<?php echo $v['product_id']; ?>" <?php if ($v['product_id'] == $single_info['product_id']): ?>selected<?php endif; ?>><?php echo $v['product_name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="control-group <?php if (!empty(form_error('case_name'))): ?>error<?php endif; ?>">
            <label class="control-label" for="case_name">案例名称</label>
            <div class="controls">
                <input type="text" id="case_name" name="case_name" value="<?php echo $single_info['case_name']; ?>" class="input-xxlarge" placeholder="案例名称">
                <?php echo form_error('case_name'); ?>
            </div>
        </div>

        <div class="control-group <?php if (!empty(form_error('case_pic'))): ?>error<?php endif; ?>">
            <label class="control-label" for="case_pic">案例图片</label>
            <div class="controls">
                <input class="btn" type="file" name="case_pic">
                <?php if (!empty($single_info['case_pic'])): ?>
                    <img src="<?php echo base_url($single_info['case_pic']); ?>" width="60px" height="30px">
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php if (!empty(form_error('customer_logo'))): ?>error<?php endif; ?>">
            <label class="control-label" for="customer_logo">企业LOGO</label>
            <div class="controls">
                <input class="btn" type="file" name="customer_logo">
                <?php if (!empty($single_info['customer_logo'])): ?>
                    <img src="<?php echo base_url($single_info['customer_logo']); ?>" width="60px" height="30px">
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php if (!empty(form_error('customer_QRcode'))): ?>error<?php endif; ?>">
            <label class="control-label" for="customer_QRcode">案例二维码</label>
            <div class="controls">
                <input class="btn" type="file" name="customer_QRcode">
                <?php if (!empty($single_info['customer_QRcode'])): ?>
                    <img src="<?php echo base_url($single_info['customer_QRcode']); ?>" width="60px" height="30px">
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputOrder"></label>
            <div class="controls">
                <button class="btn btn-primary" type="submit">确认修改</button>
            </div>
        </div>

        </form>
    </div>

<?php $this->load->view('/manageroot/admin_footer'); ?>