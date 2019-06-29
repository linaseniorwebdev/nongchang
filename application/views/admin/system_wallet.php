<style>
    div.dataTables_wrapper div.dataTables_filter label {
        margin-top: 0;
    }

    table.dataTable tbody td, th {
        vertical-align: middle;
        text-align: center;
    }

    .badge[class*='badge-'] span {
        bottom: 0;
        font-size: 1rem;
    }

    img {
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .content-wrapper table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before, .content-wrapper table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child:before {
        top: 50%;
        transform: translateY(-50%);
        left: 6px;
    }
</style>
<!-- BEGIN::Content -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header">
        </div>
        <div class="content-body">
            <div class="card border-info">
                <div class="card-header card-head-inverse bg-blue">
                    <h4 class="card-title text-white">卖出收入</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="sell">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>订单编号</th>
                                <th>佣金</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card border-success">
                <div class="card-header card-head-inverse bg-success">
                    <h4 class="card-title text-white">卖提现收入</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="withdraw">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>银行卡号码</th>
                                <th>金额</th>
                                <th>实支付</th>
                                <th>佣金</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END::Content -->