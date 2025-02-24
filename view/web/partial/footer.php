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
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/product/index');?>" class="modalBodyAnchor">SẢN PHẨM danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/product/add');?>" class="modalBodyAnchor">SẢN PHẨM thêm mới</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/procat/index');?>" class="modalBodyAnchor">DANH MỤC SẢN PHẨM danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/procat/add');?>" class="modalBodyAnchor">DANH MỤC SẢN PHẨM thêm mới</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/product/insert');?>" class="modalBodyAnchor">CHI PHÍ danh sách</a></li>
                        <li class="modalBodyLi"><a href="<?php echo $this->route('cms/product/insert');?>" class="modalBodyAnchor">CHI PHÍ thêm mới</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show cms menu
        document.querySelectorAll('.cmsMenuToggle').forEach( e => {
            e.onclick = () => {
                document.getElementById('modalMenu').style.display = "block";
            }
        });

        // Hide cms menu
        document.querySelectorAll('.modalClsIcon, .modalOverlay').forEach( e => {
            e.onclick = () => {
                document.querySelectorAll('.modal').forEach((e) => {
                    e.style.display = "none";
                });
            }
        });
    </script>
</body>
</html>
