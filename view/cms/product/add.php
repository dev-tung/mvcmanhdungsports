<?php $this->getCmsHeader('Thêm mới sản phẩm'); ?>
    <form class="cmsForm" action="<?php echo $this->route('cms/product/insert');?>" method="POST" id="productAdd">
        <div class="gridTwo ipadGridFour desktopGridSix">
            <div class="cmsSelectGroup">
                <label class="cmsLabel">Danh mục</label>
                <select class="cmsSlb" name="product_category" id="">
                    <option class="cmsSlbOption" value="">Vợt cầu lông</option>
                </select>
            </div>

            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Tên <span class="requiredSymbol">*</span></label>
                <input type="text" name="product_name" class="cmsInput" id="product_name">
                <small class="error-message"></small>
            </div>
            
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Giá nhập vào <span class="requiredSymbol">*</span></label>
                <input type="text" name="product_price_input" class="cmsInput" id="product_price_input">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Giá bán ra <span class="requiredSymbol">*</span></label>
                <input type="text" name="product_price_output" class="cmsInput" id="product_price_output">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup">
                <label class="cmsLabel">Mô tả</label>
                <input type="text" name="product_description" class="cmsInput">
            </div>
            
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Số lượng <span class="requiredSymbol">*</span></label>
                <input type="number" name="product_quantity" class="cmsInput" id="product_quantity">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup">
                <label class="cmsLabel">Hoa hồng CTV</label>
                <input type="text" name="product_seller_commission" class="cmsInput">
            </div>

            <div class="cmsInputGroup">
                <label class="cmsLabel">Ảnh thumbnail</label>
                <input type="file" name="product_thumbnail" class="cmsInput" >
            </div>
        </div>
        <button class="cmsFormBtnSave">Lưu</button>
    </form>

    <script src="<?php echo $this->asset('/js/validate.js'); ?>"></script>
    <script>
        Validator({
            form: '#productAdd',
            rules: [
                Validator.tbRequired({
                    selector: '#product_name',
                    submit: true
                }),
                Validator.tbRequired({
                    selector: '#product_price_input',
                    submit: true
                }),
                Validator.tbRequired({
                    selector: '#product_price_output',
                    submit: true
                }),
                Validator.tbRequired({
                    selector: '#product_quantity',
                    submit: true
                })
            ],
            onSubmit: (data) => {
                data.form.submit();
            }
        });

    </script>

<?php $this->getCmsFooter(); ?>