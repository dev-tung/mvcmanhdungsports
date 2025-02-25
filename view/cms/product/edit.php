<?php $this->getCmsHeader('Sửa sản phẩm'); ?>
    <form class="cmsForm" action="<?php echo $this->route('cms/product/update', ['id' => $this->_DATA['product']['product_id']]);?>" method="POST" id="productEdit">
        <div class="grid gridTwo ipadGridFour desktopGridThree">
            <div class="cmsSelectGroup">
                <label class="cmsLabel">Danh mục</label>
                <select class="cmsSlb" name="product_category" id="">
                    <?php if( !empty( $this->_DATA['procats'] ) ): ?>
                        <?php foreach( $this->_DATA['procats'] as $key => $procat ): ?>
                            <option class="cmsSlbOption" value="<?php echo $procat['procat_id']; ?>"><?php echo $procat['procat_name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Tên <span class="requiredSymbol">*</span></label>
                <input type="text" name="product_name" class="cmsInput" id="product_name" value="<?php echo $this->_DATA['product']['product_name']; ?>">
                <small class="error-message"></small>
            </div>
            <div class="cmsInputGroup">
                <label class="cmsLabel">Mô tả</label>
                <input type="text" name="product_description" class="cmsInput" value="<?php echo $this->_DATA['product']['product_description']; ?>">
            </div>
        </div>

        <div class="grid gridTwo ipadGridFour desktopGridFive">
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Giá nhập vào <span class="requiredSymbol">*</span></label>
                <input type="text" name="product_price_input" class="cmsInput inputCurrency" id="product_price_input" value="<?php echo $this->_DATA['product']['product_price_input']; ?>">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Giá bán ra <span class="requiredSymbol">*</span></label>
                <input type="text" name="product_price_output" class="cmsInput inputCurrency" id="product_price_output" value="<?php echo $this->_DATA['product']['product_price_output']; ?>">
                <small class="error-message"></small>
            </div>


            
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Số lượng <span class="requiredSymbol">*</span></label>
                <input type="number" name="product_quantity" class="cmsInput" id="product_quantity" value="<?php echo $this->_DATA['product']['product_quantity']; ?>">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup validate">
                <label class="cmsLabel">% Cộng tác viên</label>
                <input type="number" name="product_seller_commission" class="cmsInput" id="product_seller_commission" value="<?php echo $this->_DATA['product']['product_seller_commission']; ?>">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup">
                <label class="cmsLabel">Ảnh thumbnail</label>
                <input type="file" name="product_thumbnail" class="cmsInput" >
            </div>
        </div>
        <button class="cmsFormBtnSave">Lưu</button>
    </form>

    <script src="<?php echo $this->asset('/js/validate.js'); ?>"></script>
    <script src="<?php echo $this->asset('/js/function.js'); ?>"></script>
    <script>
        Validator({
            form: '#productEdit',
            rules: [
                Validator.tbRequired({
                    selector: '#product_name',
                    submit: true
                }),
                Validator.tbRequired({
                    selector: '#product_price_input',
                    submit: true
                }),
                Validator.currency({
                    selector: '#product_price_input',
                    submit: true
                }),
                Validator.tbRequired({
                    selector: '#product_price_output',
                    submit: true
                }),
                Validator.currency({
                    selector: '#product_price_output',
                    submit: true
                }),
                Validator.tbRequired({
                    selector: '#product_quantity',
                    submit: true
                }),
                Validator.isPInt({
                    selector: '#product_seller_commission',
                    submit: true
                })
            ],
            onSubmit: (data) => {
                data.form.submit();
            }
        });



    </script>

<?php $this->getCmsFooter(); ?>