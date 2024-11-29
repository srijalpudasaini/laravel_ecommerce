@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-shopping-bag"></i>
                            <div>
                                <h6>Total Orders</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['Total'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-shopping-bag"></i>
                            <div>
                                <h6>Delivered Orders</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalDelivered'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-dollar"></i>
                            <div>
                                <h6>Total Amount</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalAmount'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-dollar"></i>
                            <div>
                                <h6>Delivered Orders Amount</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalDeliveredAmount'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-shopping-bag"></i>
                            <div>
                                <h6>Pending Orders</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalOrdered'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-shopping-bag"></i>
                            <div>
                                <h6>Cancelled Orders</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalCancelled'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-dollar"></i>
                            <div>
                                <h6>Pending Order Amount</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalOrderedAmount'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="milestone rounded-4 p-3 py-4 bg-white">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-dollar"></i>
                            <div>
                                <h6>Cancelled Orders Amount</h6>
                                <h3 class="mb-0">{{ $dashboardDatas['TotalCancelledAmount'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="chart p-3 rounded-4 bg-white h-100">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-bold">Earning Revenue</h5>
                    <div class="has-dropdown pointer" data-target="#chart-dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                        <div class="chart-dropdown dropdown-menu p-2" id="chart-dropdown">
                            <ul class="ps-0 mb-0">
                                <li class="mb-2">This week</li>
                                <li>This month</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-4">
                    <div class="data-chart">
                        <p class="mb-1">
                            <i class="fa fa-circle me-1"></i>
                            Revenue
                        </p>
                        <div class="d-flex gap-2 align-items-center">
                            <h5 class="chart-amount mb-0 fw-bold">$36573</h5>
                            <i class="fa fa-line-chart"></i>
                            <h6 class="mb-0 fw-semibold">0.56%</h6>
                        </div>
                    </div>
                    <div class="data-chart">
                        <p class="mb-1">
                            <i class="fa fa-circle me-1"></i>
                            Order
                        </p>
                        <div class="d-flex gap-2 align-items-center">
                            <h5 class="chart-amount mb-0 fw-bold">$36573</h5>
                            <i class="fa fa-line-chart"></i>
                            <h6 class="mb-0 fw-semibold">0.56%</h6>
                        </div>
                    </div>
                </div>
                <div id="line-chart"></div>
            </div>
        </div>
    </div>
    <div class="table-container rounded-3 p-3 w-100 mt-4 bg-white overflow-x-auto">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="fw-bold">Recent Orders</h6>
            <a href="{{ route('admin.orders') }}" class="text-black">View All <i class="fa fa-angle-right"></i></a>
        </div>
        <div class="w-100 overflow-x-auto">
            <table class="w-100 table-bordered">
                <tr>
                    <th>Order No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Subtotal</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Total Items</th>
                    <th>Delivered On</th>
                    <th>Action</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>${{ $order->subtotal }}</td>
                        <td>${{ $order->tax }}</td>
                        <td>${{ $order->total }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->orderItems->count() }}</td>
                        <td>{{ $order->delivered_date }}</td>
                        <td><a href="{{ route('admin.order-details', ['order_id' => $order->id]) }}" class="text-primary"><i
                                    class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script>
        (function($) {

            var tfLineChart = (function() {

                var chartBar = function() {

                    var options = {
                        series: [{
                                name: 'Total',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00,
                                    0.00, 0.00, 0.00
                                ]
                            }, {
                                name: 'Pending',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00,
                                    0.00, 0.00, 0.00
                                ]
                            },
                            {
                                name: 'Delivered',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                    0.00, 0.00
                                ]
                            }, {
                                name: 'Canceled',
                                data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                    0.00, 0.00
                                ]
                            }
                        ],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                'Oct', 'Nov', 'Dec'
                            ],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return "$ " + val + ""
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart"),
                        options
                    );
                    if ($("#line-chart").length > 0) {
                        chart.render();
                    }
                };

                /* Function ============ */
                return {
                    init: function() {},

                    load: function() {
                        chartBar();
                    },
                    resize: function() {},
                };
            })();

            jQuery(document).ready(function() {});

            jQuery(window).on("load", function() {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function() {});
        })(jQuery);
    </script>
@endpush
