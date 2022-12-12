<x-admin-layout title="Dashboard">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Dashboard">
            {{-- <x-admin.breadcrumbs>
                    <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
            </x-admin.breadcrumbs> --}}
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>

    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-xl">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <x-admin.dashboard-count-widget>
                        <x-admin.dashboard-count-widget-item title="Total Landmark"
                            description="Total landmark available in this system" :count="$count['totalLandmark']" href="#" />
                        <x-admin.dashboard-count-widget-item title="Total Blocked Landmark"
                            description="Total blocked landmark available in this system"
                            :count="$count['blockLandmark']" href="#" />
                    </x-admin.dashboard-count-widget>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <x-admin.dashboard-count-widget>
                        <x-admin.dashboard-count-widget-item title="Total Active Landmark"
                            description="Total active landmark available in this system" :count="$count['activeLandmark']"
                            href="#" />
                    </x-admin.dashboard-count-widget>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Landmark Management Chart
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div id="chartdiv"></div>
                    <div class="col-chart position-absolute bg-white"
                        style="bottom:45px; left:30px; z-index:9; height: 22px; width: 70px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Latest Landmark
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget4_tab1_content">
                            <div class="kt-widget4">
                                @if (count($landmark) > 0)
                                    @foreach ($landmark as $data)
                                        <div class="kt-widget4__item">
                                            <span
                                                class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ substr(ucfirst($data->title), 0, 1) }}</span>
                                            <div class="kt-widget4__info">
                                                <a href="{{route('landmarks.index')}}" class="kt-widget4__username" title="Click to view landmark">
                                                    &nbsp;&nbsp;{{ $data->title }}
                                                </a>
                                                <p class="kt-widget4__text">
                                                    &nbsp;&nbsp; Joined on {{ $data->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        </div>
                                        <div class="kt-widget4__info">
                                            No Landmark record found.
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <a href="{{route('landmarks.index')}}" class="btn btn-label-brand btn-bold" style="float: right;">View all landmarks</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #chartdiv {
            width: 100%;
            height: 400px;
        }

    </style>
    <script src="//cdn.amcharts.com/lib/5/index.js"></script>
    <script src="//cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="//cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!-- Chart code -->
    <script>
        am5.ready(function() {
            var root = am5.Root.new("chartdiv");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    layout: root.verticalLayout,
                    innerRadius: am5.percent(50)
                })
            );
            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "value",
                    categoryField: "category",
                    alignLabels: false
                })
            );

            series.data.setAll(
                [{
                        value: {{ $count['activeLandmark'] }},
                        category: "Active Landmark"
                    },
                    {
                        value: {{ $count['blockLandmark'] }},
                        category: "Block Landmark"
                    },
                ]
            );
            series.labels.template.set("visible", false);
            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.percent(50),
                x: am5.percent(50),
                marginTop: 15,
                marginBottom: 15,
            }));

            legend.data.setAll(series.dataItems);
            series.appear(1000, 100);
        });
    </script>
</x-admin-layout>
