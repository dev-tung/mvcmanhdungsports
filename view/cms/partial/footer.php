            </div><!-- cmsContent -->
        </div><!-- cmsBody -->
    </div><!-- cms -->

    <!-- Modal menu layout -->
    <div class="modal" id="modalMenu">
        <div class="modalOverlay"></div>
        <div class="modalContentLeft">
            <div class="modalHeader">
                <div class="modalWidth">
                    <h3 class="modalTitle">MENU</h3>
                    <img class="modalClsIcon" src="<?php echo $this->asset('/img/icon/close.png'); ?>">
                </div>
            </div>
            <div class="modalBody">
                <div class="modalWidth">
                    <ul class="modalBodyUl">
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/procat/index');?>" class="modalBodyAnchor">DANH MỤC SẢN PHẨM danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/procat/add');?>" class="modalBodyAnchor">DANH MỤC SẢN PHẨM thêm mới</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/product/index');?>" class="modalBodyAnchor">SẢN PHẨM danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/product/add');?>" class="modalBodyAnchor">SẢN PHẨM thêm mới</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/expense/index');?>" class="modalBodyAnchor">CHI PHÍ danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/expense/add');?>" class="modalBodyAnchor">CHI PHÍ thêm mới</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/revenue/index');?>" class="modalBodyAnchor">DOANH THU danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/revenue/add');?>" class="modalBodyAnchor">DOANH THU thêm mới</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $this->asset('/js/function.js'); ?>"></script>
    <script src="<?php echo $this->asset('/js/validate.js'); ?>"></script>
    <script src="<?php echo $this->asset('/js/modal.js'); ?>"></script>
</body>
</html>
