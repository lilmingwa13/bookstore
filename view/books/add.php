<div>
    <div class="col-md-12">
        <div class="row">
            <form method="post" action="<?php echo BASE_URL . "index.php?admin=books&add"; ?>" enctype="multipart/form-data">
                <div class="col-md-6">

                    <div class="row">
                        <div class="form-group">
                            <label>Tên sách:</label>
                            <input type="text" name="title" class="form-control" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Giá (VNĐ):</label>
                            <input type="number" name="price" class="form-control" step="500" min="0" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Mô tả:</label>
                            <textarea name="description" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <input type="submit" data-loading-text="Loading..." class="btn btn-primary" value="Lưu" name="submit">
                    </div>
                    <div class="row">
                        <p>
                            <?php
                            if (isset($msg)) {
                                if ($msg['status'])
                                    $alertClass = "alert-success";
                                else
                                    $alertClass = "alert-danger";
                                echo "<div class='alert {$alertClass}'>{$msg['txt']}</div>";
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ảnh:</label>
                        <input type="file" name="file">
                    </div>
                    <?php
                    $bookImage =  BOOK_DIR . "default.jpg";
                    echo "<img src='" . BASE_URL . "{$bookImage}' class='img-thumbnail img-thumbnail-book-medium img-responsive'>";
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

