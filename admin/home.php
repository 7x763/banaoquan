<?php
    $total_revenue = $OrderModel->total_revenue_orders();
    $unconfirmed = $OrderModel->count_unconfirmed();
    $count_products = $OrderModel->count_products();
    $count_users = $CustomerModel->count_users();
    $top_products = $OrderModel->get_order_top_limit(5);

?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Giảm giá</p>
                    <h6 class="mb-0">20 sản phẩm</h6>
                </div>
            </div>
        </div> -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Tổng doanh thu</p>
                    <h6 class="mb-0"><?=number_format($total_revenue['tong_doanh_thu'])?>₫</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="danh-sach-san-pham" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-box fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Sản phẩm</p>
                    <h6 class="mb-0"><?=$count_products['total_products']?> sản phẩm</h6>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="danh-sach-don-cho" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Đơn chờ</p>
                    <h6 class="mb-0"><?=$unconfirmed['don_cho']?> đơn hàng</h6>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="danh-sach-khach-hang" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Khách hàng</p>
                    <h6 class="mb-0"><?=$count_users['total_users']?> khách hàng</h6>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Top sản phẩm bán chạy</h6>
            <a href="thong-ke-don-hang">Xem tất cả</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng bán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($top_products as $value) {
                        extract($value);
                        $i++;
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$product_name?></td>
                        <td><?=$total_sold_quantity?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
    // include_once "thong-ke/top-orders.php";

    include_once "thong-ke/chart-order-date.php";
?>

