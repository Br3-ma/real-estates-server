<div class="content-body">
    <!-- row -->
                <!-- row -->
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Subscription Plans</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Subscription Plans</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Plans List</a></li>
                </ol>
            </div>
            <a href="javascript:void(0);" class="mr-3 rounded btn btn-primary light">Create One</a>
            {{-- <a href="javascript:void(0);" class="rounded btn btn-primary"><i class="mr-0 flaticon-381-settings-2"></i></a> --}}
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="p-0 card-body">

                        @foreach ($plans as $plan )
                        <div class="px-2 pt-4 mx-0 row border-bottom align-items-center ">

                            <div class="mb-3 col-xl-2 col-xxl-2 col-lg-3 col-sm-4 mb-sm-4 col-6">
                                <small class="mb-2 d-block">Category</small>
                                <span class="text-black font-w600">{{ $plan->name }}</span>
                            </div>
                            <div class="mb-3 col-xl-4 col-xxl-3 col-lg-3 col-sm-4 mb-sm-4 col-6 text-lg-center">
                                <small class="mb-2 d-block">Description</small>
                                <span class="text-black font-w600">{{ $plan->description ?? 'No Description' }}</span>
                            </div>
                            <div class="mb-3 col-xl-2 col-xxl-3 col-lg-6 col-sm-4 mb-sm-4">
                                <small class="mb-2 d-block">Amount</small>
                                <span class="text-black font-w600">{{ $plan->amount }}</span>
                            </div>
                            <div class="mb-4 col-xl-3 col-xxl-4 col-lg-6 col-sm-6 mb-sm-4 d-flex ">
                                <div class="mt-auto mb-auto mr-auto dropdown media-dropdown">
                                    {{-- <div class="btn-link" data-toggle="dropdown" >
                                        <a href="javascript:void(0);" class="rounded btn btn-outline-primary">Show Order History
                                            <svg class="ml-2" width="12" height="6" viewBox="0 0 12 6" fill="none" xmlns="../../../www.w3.org/2000/svg.html">
                                                <path d="M0 -5.24537e-07L6 6L12 0" fill="#3B4CB8"/>
                                            </svg>
                                        </a>
                                    </div> --}}
                                    <div class="rounded dropdown-menu dropdown-menu-right">
                                        <div class="mb-4 media">
                                            <img class="mr-3 rounded mr-sm-4 img-fluid" width="90"  src="public/images/customers/4.jpg" alt="DexignZone">
                                            <div class="media-body">
                                                <h4 class="mb-0 text-black fs-16 font-w600">James Humbly</h4>
                                                <span class="mb-3 fs-14 d-block">2 June 2018 - 4 June 2019</span>
                                                <div class="star-icons">
                                                    <i class="las la-star fs-18"></i>
                                                    <i class="las la-star fs-18"></i>
                                                    <i class="las la-star fs-18"></i>
                                                    <i class="las la-star fs-18"></i>
                                                    <i class="las la-star fs-18"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <img class="mr-3 rounded mr-sm-4 img-fluid" width="90"  src="public/images/customers/3.jpg" alt="DexignZone">
                                            <div class="media-body">
                                                <h4 class="mb-0 text-black fs-16 font-w600">James Humbly</h4>
                                                <span class="mb-3 fs-14 d-block">2 June 2018 - 4 June 2019</span>
                                                <div class="star-icons">
                                                    <i class="las la-star"></i>
                                                    <i class="las la-star"></i>
                                                    <i class="las la-star"></i>
                                                    <i class="las la-star"></i>
                                                    <i class="las la-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-auto mb-auto ml-4 dropdown">
                                    <div class="btn-link" data-toggle="dropdown" >
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
