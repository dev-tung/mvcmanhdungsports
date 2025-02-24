<?php $this->getCmsHeader('Danh sách sản phẩm'); ?>
    <table>
        <tbody><tr>
            <th>Ảnh thumbnail</th>
            <th>Tên</th>
            <th>Giá nhập vào</th>
            <th>Giá bán ra</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Hoa hồng CTV</th>
            <th>Hành động</th>
        </tr>
        <?php
            //HelperDD($this->_DATA['products']);
        ?>
        <?php if( !empty( $this->_DATA['products'] ) ): ?>
            <?php foreach( $this->_DATA['products'] as $product ): ?>
                <tr>
                    <td>
                        <a href="<?php echo $this->asset('img/default/77Pro.png'); ?>">
                            <img width="50" src="<?php echo $this->asset('img/default/77Pro.png'); ?>" alt="">
                        </a>
                    </td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_price_input']; ?></td>
                    <td><?php echo $product['product_price_output']; ?></td>
                    <td><?php echo $product['product_description']; ?></td>
                    <td><?php echo $product['product_quantity']; ?></td>
                    <td><?php echo $product['product_seller_commission']; ?></td>
                    <td>
                        <a href="edit.html">Sửa</a> |
                        <a href="" onclick="return confirm('Do you want to delete this participant?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    


<?php $this->getCmsFooter(); ?>




