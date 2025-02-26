<?php $this->getCmsHeader('Danh mục sản phẩm'); ?>

    <table>
        <tbody><tr>
            <th>STT</th>
            <th>Tên</th>
            <th>ID</th>
            <th>ID cha</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
        <?php
            //DD($this->_DATA['procats']);
        ?>
        <?php if( !empty( $this->_DATA['procats'] ) ): ?>
            <?php foreach( $this->_DATA['procats'] as $key => $procat ): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $procat['procat_name']; ?></td>
                    <td><?php echo $procat['procat_id']; ?></td>
                    <td><?php echo $procat['procat_parent_id']; ?></td>
                    <td><?php echo $procat['procat_description']; ?></td>
                    <td>
                        <a href="<?php echo $this->route('cms/procat/edit', ['id' => $procat['procat_id']]);?>">Sửa</a> |
                        <a href="<?php echo $this->route('cms/procat/delete', ['id' => $procat['procat_id']]);?>" onclick="return confirm('Bạn có thực sự muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    
<?php $this->getCmsFooter(); ?>




