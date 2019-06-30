<style>
    table.order-main {
        font-size: 16px;
    }
    
    table.order-main tbody tr {
        height: 2.5em;
    }

    table.order-main tbody tr td:first-child {
        font-weight: bold;
        text-align: right;
    }
    
    table.order-main tbody tr td:last-child {
        padding-left: 5px;
    }

    .badge[class*='badge-'] span {
        position: inherit;
    }
</style>

<!-- BEGIN::Content -->
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-body">
			<div class="card">
				<div class="card-header card-head-inverse bg-blue">
					<h4 class="card-title text-white">订单详情</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<table class="order-main">
							<tbody>
                            <?php
                            $status = array('待付款', '待发货', '待收货', '已完成', '已关闭', '已取消');
                            $colors = array('secondary', 'info', 'primary', 'success', 'warning', 'danger');
                            ?>
                            <tr><td>订单号：</td><td><?php echo $order['orderno']; ?></td></tr>
                            <tr><td>买家名称：</td><td><?php echo $order['user']['fullname']; ?></td></tr>
                            <tr><td>付款金额：</td><td><?php echo $order['total']; ?></td></tr>
                            <tr><td>运费：</td><td><?php echo $order['delivery']; ?></td></tr>
                            <tr><td>发货地址：</td><td><?php echo $order['destination']['province'] . $order['destination']['city'] . $order['destination']['district'] . $order['destination']['detail']; ?></td></tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 7px;">优品：</td>
                                <td style="vertical-align: top; padding-top: 7px;">
                                    <table class="order-products">
                                        <tbody>
                                        <?php
                                        $products = $order['product'];
                                        foreach ($products as $product) {
	                                        echo '<tr>';
	                                        echo '<td><img src="' . base_url($product['detail']['image']) . '" alt="Product Image" draggable="false" style="width: 64px;" /></td>';
	                                        echo '<td style="padding-left: 10px;;">' . $product['detail']['name'] . '（' . $product['detail']['scale'] . $order['units'][$product['detail']['unit']]['name'] . '）</td>';
	                                        echo '<td>X ' . $product['amount'] . '</td>';
	                                        echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr><td>收货人：</td><td><?php echo $order['destination']['receipt']; ?></td></tr>
                            <tr><td>收货人手机：</td><td><?php echo $order['destination']['phone']; ?></td></tr>
                            <tr><td>备注：</td><td><?php echo ($order['remark'])?:'【没有备注】'; ?></td></tr>
                            <tr><td>订单状态：</td><td><?php echo '<div class="badge badge-' . $colors[$order['status']] . ' round"><span>' . $status[$order['status']] . '</span></div>'; ?></td></tr>
                            <tr><td>订单日期：</td><td><?php echo $order['created_at']; ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>
                <div class="card-footer">
                    <a href="<?php echo base_url('admin/order/product'); ?>" class="btn btn-primary" style="float:right;">回去</a>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- END::Content -->
