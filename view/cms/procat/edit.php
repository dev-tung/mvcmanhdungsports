<?php
    //DD($this->_DATA['procat']);
?>
<?php $this->getCmsHeader('Sửa danh mục sản phẩm'); ?>
    <form class="cmsForm" action="<?php echo $this->route('cms/procat/update', ['id' => $this->_DATA['procat']['procat_id']]);?>" method="POST" id="procatEdit">
        <div class="gridTwo ipadGridFour desktopGridSix">
            <div class="cmsSelectGroup">
                <label class="cmsLabel">Danh mục cha</label>
                <select class="cmsSlb" name="procat_parent_id" id="">
                    <option value="0">Không</option>
                    <?php if( !empty( $this->_DATA['procats'] ) ): ?>
                        <?php foreach( $this->_DATA['procats'] as $procat ): ?>
                            <?php $selected = ( $procat['procat_id'] == $this->_DATA['procat']['procat_parent_id'] ) ? 'selected' : ''; ?>
                            <option class="cmsSlbOption" value="<?php echo $procat['procat_id']?>" <?php echo $selected; ?>><?php echo $procat['procat_name']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Tên <span class="requiredSymbol">*</span></label>
                <input type="text" name="procat_name" class="cmsInput" id="procat_name" value="<?php echo $this->_DATA['procat']['procat_name']; ?>">
                <small class="error-message"></small>
            </div>

            <div class="cmsInputGroup">
                <label class="cmsLabel">Mô tả</label>
                <input type="text" name="procat_description" class="cmsInput" value="<?php echo $this->_DATA['procat']['procat_description']; ?>">
            </div>
            
        </div>
        <button class="cmsFormBtnSave">Lưu</button>
    </form>

    <script src="<?php echo $this->asset('/js/validate.js'); ?>"></script>
    <script>
        Validator({
            form: '#procatEdit',
            rules: [
                Validator.tbRequired({
                    selector: '#procat_name',
                    submit: true
                })
            ],
            onSubmit: (data) => {
                console.log(data);
                data.form.submit();
            }
        });

    </script>

<?php $this->getCmsFooter(); ?>