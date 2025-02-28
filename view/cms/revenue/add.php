<?php $this->getCmsHeader('Thêm mới doanh thu'); ?>
    <form class="cmsForm" action="<?php echo $this->route('cms/revenue/insert');?>" method="POST" id="revenueAdd" enctype="multipart/form-data">
        <div class="grid gridTwo ipadGridFour desktopGridThree">
            <div class="cmsSelectGroup validate">
                <label class="cmsLabel">Danh mục <span class="requiredSymbol">*</span></label>
                <select class="cmsSlb" name="revenue_category" id="revenue_category">
                    <option value="">Chọn</option>
                    <?php if( !empty( $this->_DATA['procats'] ) ): ?>
                        <?php foreach( $this->_DATA['procats'] as $key => $procat ): ?>
                            <option class="cmsSlbOption" value="<?php echo $procat['procat_id']; ?>"><?php echo $procat['procat_name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <small class="error-message"></small>
                <input type="hidden" name="revenue_category_name" id="revenue_category_name" value="">
            </div>
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Tên sản phẩm<span class="requiredSymbol">*</span></label>
                <input type="text" name="revenue_name" class="cmsInput" id="revenue_name" data-modal-action="toggle" data-modal-target="#popupSearchModal">
                <input type="hidden" name="revenue_id" class="cmsInput" id="revenue_id">
                <small class="error-message"></small>
            </div>
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Số lượng <span class="requiredSymbol">*</span></label>
                <input type="number" name="revenue_quantity" class="cmsInput" id="revenue_quantity">
                <small class="error-message"></small>
            </div>
        </div>

        <div class="grid gridTwo ipadGridFour desktopGridFour">
            <div class="cmsInputGroup validate">
                <label class="cmsLabel">Tiền phải thanh toán <span class="requiredSymbol">*</span></label>
                <input type="text" name="revenue_price_output" class="cmsInput inputCurrency" id="revenue_price_output" disabled>
                <small class="error-message"></small>
            </div>
            <div class="cmsInputGroup">
                <label class="cmsLabel">Tên khách hàng <span class="requiredSymbol">*</span></label>
                <input type="text" name="customer_name" class="cmsInput">
            </div>
            <div class="cmsInputGroup">
                <label class="cmsLabel">SĐT khách hàng</label>
                <input type="text" name="customer_phone" class="cmsInput">
            </div>
            <div class="cmsSelectGroup validate">
                <label class="cmsLabel">Người bán hàng <span class="requiredSymbol">*</span></label>
                <select class="cmsSlb" name="revenue_category" id="revenue_category">
                    <option value="">Chọn</option>
                    <?php if( !empty( $this->_DATA['procats'] ) ): ?>
                        <?php foreach( $this->_DATA['procats'] as $key => $procat ): ?>
                            <option class="cmsSlbOption" value="<?php echo $procat['procat_id']; ?>"><?php echo $procat['procat_name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <small class="error-message"></small>
                <input type="hidden" name="revenue_category_name" id="revenue_category_name" value="">
            </div>
        </div>
        <button class="cmsFormBtnSave">Lưu</button>
    </form>


    <div class="popupSearch" id="popupSearch">
        <div class="popupSearchModal" id="popupSearchModal">
            <div class="popupSearchBox">
                <form class="popupSearchForm">
                    <svg class="popupSearchFormIcon" viewBox="0 0 20 20" aria-hidden="true"><path d="M14.386 14.386l4.0877 4.0877-4.0877-4.0877c-2.9418 2.9419-7.7115 2.9419-10.6533 0-2.9419-2.9418-2.9419-7.7115 0-10.6533 2.9418-2.9419 7.7115-2.9419 10.6533 0 2.9419 2.9418 2.9419 7.7115 0 10.6533z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <input class="popupSearchFormInput" id="popupSearchFormInput" type="text" placeholder="Tìm kiếm sản phẩm">
                    <button type="reset" title="Clear the query" class="popupSearchFormReset" aria-label="Clear the query"><svg width="20" height="20" viewBox="0 0 20 20"><path d="M10 10l5.09-5.09L10 10l5.09 5.09L10 10zm0 0L4.91 4.91 10 10l-5.09 5.09L10 10z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
                </form>
                <div class="popupSearchResult" id="popupSearchResult">
                    <p class="popupSearchResultNo">Không có kết quả!</p>
                </div>
                <div class="popupSearchNote">
                    <div class="popupSearchNoteGroup">
                        <span class="popupSearchNoteText">Nhập tên sản phẩm để tìm kiếm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End popupSearch -->

    

<?php $this->getCmsFooter(); ?>
<script src="<?php echo $this->asset('/js/cms/revenue.js'); ?>"></script>