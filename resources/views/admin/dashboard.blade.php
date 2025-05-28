<x-admin-layout>
    <div class="main">
        <div class="container-fluid">
            <div class="row pt-3 pb-2 border-bottom">
                <div class="col-lg-4">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-lg-8 text-end ms-auto ">
                    <form class="row justify-content-end" id="filterFrom">
                        <div class="col-lg-3">
                            <div class="cdate">
                                <input type="date" class="form-control filter" name="from_date"
                                    value="{{ request()->from_date }}">
                            </div>
                        </div>
                        <div class="col-lg-1 text-center my-auto">
                            <span class="fw-semibold fs-6">To</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="cdate">
                                <input type="date" class="form-control filter" name="to_date"
                                    value="{{ request()->to_date ?? date('Y-m-d') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @php
            $modules = [
                'plans' => ['label' => 'Plans', 'route' => route('admin.plans')],
                'features' => ['label' => 'Features', 'route' => route('admin.features')],
                'customers' => ['label' => 'Customers', 'route' => route('admin.user')],
                'pages' => ['label' => 'Pages', 'route' => route('admin.pages')],
                'testimonials' => ['label' => 'Testimonials', 'route' => route('admin.testimonials')],
                'faqs' => ['label' => "Faq's", 'route' => route('admin.faq')],
                'subscriptions' => ['label' => 'Subscriptions', 'route' => route('admin.testimonials')],
            ];
        @endphp

        <div class="container-fluid">
            <div class="row pb-4 px-1">
                <div class="dashboard-stats">
                    <div class="row">
                        <h4 class="title_heading">Modules</h4>

                        @foreach ($modules as $key => $module)
                            <div class="col-lg-3">
                                <a href="{{ $module['route'] }}">
                                    <div class="dashboard-card">
                                        <div class="title">{{ $module['label'] }}</div>
                                        <div class="data">
                                            {{ $from_date && $to_date ? $stats[$key]['filtered'] : $stats[$key]['total'] }}
                                        </div>
                                        <div class="icon">
                                            <i class="fal fa-box-full"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('.filter').change(function() {
                $('#filterFrom').submit();
            })
        </script>
    @endpush
</x-admin-layout>
