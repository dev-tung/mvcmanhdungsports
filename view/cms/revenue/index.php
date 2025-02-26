<?php $this->getCmsHeader('Danh sách doanh thu'); ?>
    <table>
        <tbody><tr>
            <th>Ảnh thumbnail</th>
            <th>Tên</th>
            <th>Giá nhập vào</th>
            <th>Giá bán ra</th>
            <th>Tổng tiền nhập vào</th>
            <th>Số lượng</th>
            <th>Hành động</th>
        </tr>
        <?php
            //DD($this->_DATA['products']);
        ?>
        <?php if( !empty( $this->_DATA['products'] ) ): ?>
            <?php foreach( $this->_DATA['products'] as $product ): ?>
                <tr>
                    <td>
                        <a href="<?php echo $product['product_thumbnail']; ?>">
                            <img width="50" src="<?php echo ROOT_URL.DS.$product['product_thumbnail']; ?>" alt="<?php echo $product['product_thumbnail']; ?>">
                        </a>
                    </td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo number_format($product['product_price_input']); ?> đ</td>
                    <td><?php echo number_format($product['product_price_output']); ?> đ</td>
                    <td><?php echo number_format(($product['product_price_input'] * $product['product_quantity'])); ?> đ</td>
                    <td><?php echo $product['product_quantity']; ?></td>
                    <td>
                        <a href="<?php echo $this->route('cms/product/edit', ['id' => $product['product_id']]);?>">Sửa</a> |
                        <a href="<?php echo $this->route('cms/product/delete', ['id' => $product['product_id']]);?>" onclick="return confirm('Do you want to delete this participant?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
<?php $this->getCmsFooter(); ?>




