@props(['subcategories'])
<a href="" class="btn w-100 filter-btn shadow-none border mb-2 d-md-none d-block">
    Product Filters
    <i class='bx bx-filter'></i>
</a>
<div class="sidebar text-capitalize">
    <a href=""
        class="btn w-100 filter-btn shadow-none border d-flex justify-content-between align-itmes-center mb-2 d-md-none d-block bg-danger text-white">
        Close Filter Categories <i class='bx bx-x fs-4'></i>
    </a>
    {{-- <div class="view-mode">
        <div
            class="rango-view-grid-container mode grid {{ request()->mode == 'grid' || request()->mode == '' ? 'active' : '' }}">
            <i class='bx bx-grid-alt'></i>
            <span>Grid view</span>
        </div>
        <div class="rango-view-list-container mode list {{ request()->mode == 'list' ? 'active' : '' }}">
            <i class='bx bx-list-ul'></i>
            <span>list view</span>
        </div>
    </div> --}}
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle w-100 mb-2" style="background:#7f385e;border:0;" href="#"
            role="button" id="sortBy" data-bs-toggle="dropdown" aria-expanded="false">
            <span id="sort_label">Sort By</span>
            <i class='bx bxs-down-arrow ps-lg-4' style="font-size: 13px;"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="sortBy">
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="sorting" name="sorting"
                        data-column="is_best_seller" data-sort="desc" value="best_seller">
                    <span class="ps-2">Best Seller</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="sorting" name="sorting"
                        data-column="created_at" data-sort="desc" value="created_at">
                    <span class="ps-2">Newest First</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="sorting" name="sorting" value="price"
                        data-column="price" data-sort="asc">
                    <span class="ps-2">Price low to high</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="sorting" name="sorting" value="price"
                        data-column="price" data-sort="desc">
                    <span class="ps-2">Price High to low</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="sorting" name="sorting" value="name"
                        data-column="name" data-sort="asc">
                    <span class="ps-2">From A-Z</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="sorting" name="sorting" value="name"
                        data-column="name" data-sort="desc">
                    <span class="ps-2">From Z-A</span>
                </label>
            </li>
        </ul>
    </div>
    {{-- <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle w-100 mb-2" style="background: #93c572;border:0;" href="#"
            role="button" id="limit" data-bs-toggle="dropdown" aria-expanded="false">
            <span id="limit_label">Per Page 100</span>
            <i class='bx bxs-down-arrow ps-lg-4' style="font-size: 13px;"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="limit">
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="per_page" name="limit"
                        value="30">
                    <span class="ps-2">Per page 30</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="per_page" name="limit"
                        value="50">
                    <span class="ps-2">Per page 50</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="per_page" name="limit"
                        value="75">
                    <span class="ps-2">Per page 75</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="per_page" name="limit"
                        value="100">
                    <span class="ps-2">Per page 100</span>
                </label>
            </li>
            <li>
                <label class="dropdown-item">
                    <input type="radio" style="height: 15px;width:15px;" class="per_page" name="limit"
                        value="750">
                    <span class="ps-2">All</span>
                </label>
            </li>
        </ul>
    </div> --}}
</div>
@push('scripts')
    <script>
        var accordionButtons = document.querySelectorAll('.arcdion-btn');
        accordionButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var collapseId = button.getAttribute('href');
                var collapse = document.querySelector(collapseId);
                if (collapse.classList.contains('show')) {
                    collapse.classList.remove('show');
                } else {
                    var collapses = document.querySelectorAll('.arcdi.show');
                    collapses.forEach(function(collapse) {
                        collapse.classList.remove('show');
                    });
                    collapse.classList.add('show');
                }
            });
        });
    </script>
    <script>
        var table = {
            is_new: '',
            is_best_seller: '',
            brand: '',
            price: '',
            sale: '',
            mode: '',
            sortBy: '',
            sortOrder: '',
            paginate: null,
            flavour: '',
            source: '',
            form: '',
        }

        $(document).ready(function() {
            let is_new = new URLSearchParams(window.location.search).get("is_new");
            let is_best_seller = new URLSearchParams(window.location.search).get("is_best_seller");
            let brands = new URLSearchParams(window.location.search).get("brand");
            // let price = new URLSearchParams(window.location.search).get("price");
            // let sale = new URLSearchParams(window.location.search).get("sale");
            let mode = new URLSearchParams(window.location.search).get("mode");
            let paginate = new URLSearchParams(window.location.search).get("paginate");
            let sort = new URLSearchParams(window.location.search).get("sort");
            let order = new URLSearchParams(window.location.search).get("order");
            // let flavours = new URLSearchParams(window.location.search).get("flavour");
            // let sources = new URLSearchParams(window.location.search).get("source");
            // let forms = new URLSearchParams(window.location.search).get("form");
            // if (brands) {
            //     $('.brand').each(function() {
            //         var arr = brands.split(',');
            //         if (arr.indexOf($(this).val()) !== -1) {
            //             $(this).prop('checked', true);
            //         }
            //     });
            // }
            // if (price) {
            //     $('.price').each(function() {
            //         if ($(this).val() == price) {
            //             $(this).prop('checked', true);
            //         }
            //     });
            // }
            // if (sale) {
            //     if ($('#sale').val() == sale) {
            //         $('#sale').prop('checked', true);
            //     }
            // }
            // if (flavours) {
            //     $('.flavour').each(function() {
            //         var arr = flavours.split(',');
            //         if (arr.indexOf($(this).val()) !== -1) {
            //             $(this).prop('checked', true);
            //         }
            //     });
            // }
            // if (sources) {
            //     $('.source').each(function() {
            //         var arr = sources.split(',');
            //         if (arr.indexOf($(this).val()) !== -1) {
            //             $(this).prop('checked', true);
            //         }
            //     });
            // }
            // if (forms) {
            //     $('.form').each(function() {
            //         var arr = forms.split(',');
            //         if (arr.indexOf($(this).val()) !== -1) {
            //             $(this).prop('checked', true);
            //         }
            //     });
            // }

            table.paginate = paginate ? paginate : null;
            if (paginate) {
                $(".per_page").each(function() {
                    if ($(this).val() === paginate) {
                        $(this).prop('checked', true);
                    }
                });
                var checkedLabel = $('input[name="limit"]:checked').next('span').text();
                $('#limit_label').text(checkedLabel);
            } else {
                $(".per_page[value='100']").prop('checked', true);
            }

            if (sort && order && sort !== "" && order !== "") {
                $('.sorting').each(function() {
                    if ($(this).data('column') === sort && $(this).data('sort') === order) {
                        $(this).prop('checked', true);
                    }
                });
                updateSortLabel();
            }
        });
        // $('.brand').on('change', function() {
        //     var selectedBrands = [];
        //     $('.brand:checked').each(function() {
        //         selectedBrands.push($(this).val());
        //     });
        //     table.brand = selectedBrands;
        //     filter('brand', selectedBrands.toString());
        // });
        // $('.flavour').on('change', function() {
        //     var selectedflavours = [];
        //     $('.flavour:checked').each(function() {
        //         selectedflavours.push($(this).val());
        //     });
        //     table.flavour = selectedflavours;
        //     filter('flavour', selectedflavours.toString());
        // });
        // $('.source').on('change', function() {
        //     var selectedsources = [];
        //     $('.source:checked').each(function() {
        //         selectedsources.push($(this).val());
        //     });
        //     table.source = selectedsources;
        //     filter('source', selectedsources.toString());
        // });
        // $('.form').on('change', function() {
        //     var selectedforms = [];
        //     $('.form:checked').each(function() {
        //         selectedforms.push($(this).val());
        //     });
        //     table.form = selectedforms;
        //     filter('form', selectedforms.toString());
        // });
        // $('.price').on('change', function() {
        //     let price = $(this).val();
        //     table.price = price;
        //     filter('price', price);
        // });
        // $('#sale').on('change', function() {
        //     if ($(this).prop('checked')) {
        //         let sale = $(this).val();
        //         table.sale = sale;
        //         filter('sale', sale);
        //     } else {
        //         filter('sale', '');
        //     }
        // });
        // $('.mode').on('click', function() {
        //     let mode = 'grid';
        //     if ($(this).hasClass('grid')) {
        //         mode = 'grid';
        //     } else {
        //         mode = 'list';
        //     }
        //     table.mode = mode;
        //     filter('mode', mode);
        // });
        $('.per_page').on('change', function() {
            let paginate = $(this).val();
            table.paginate = paginate;
            filter('paginate', paginate);
        });

        $(document).on('click', '.sorting', function() {
            var column = $(this).data('column');
            var sort = $(this).data('sort');
            table.sortBy = column;
            table.sortOrder = sort;
            applyFilters();
        });

        function updateSortLabel() {
            var checkedLabel = $('input[name="sorting"]:checked').next('span').text();
            $('#sort_label').text(checkedLabel);
        }


        function filter(key, value) {
            let uri = window.location.href
            let url = '';
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                url = uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                url = uri + separator + key + "=" + value;
            }
            window.location.href = url;
        }

        function applyFilters() {
            let uri = window.location.href;
            let params = new URLSearchParams(window.location.search);
            if (table.is_best_seller) params.set("is_best_seller", table.is_best_seller);
            if (table.is_new) params.set("is_new", table.is_new);
            if (table.brand) params.set("brand", table.brand);
            if (table.price) params.set("price", table.price);
            if (table.sale) params.set("sale", table.sale);
            if (table.mode) params.set("mode", table.mode);
            if (table.sortOrder !== '') params.set("order", table.sortOrder);
            if (table.sortBy !== '') params.set("sort", table.sortBy);
            window.location.href = uri.split('?')[0] + '?' + params.toString();
        }

        $(document).ready(function() {
            $(".filter-btn").click(function(e) {
                e.preventDefault();
                $(".sidebar").toggleClass("open");
            });
        });
        // function getRecords() {
        //     let route_name = $('#current_route').val();
        //     let url = route_name + '?' + $.param(table);
        //     window.location.href = url;
        // }
    </script>
@endpush