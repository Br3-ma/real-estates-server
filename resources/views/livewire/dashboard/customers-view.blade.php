<div class="content-body">
    <!-- row -->
                <!-- row -->
    <div class="container-fluid">
        <div class="form-head page-titles d-flex  align-items-center">
            <div class="mr-auto  d-lg-block">
                <h2 class="text-black font-w600">Customer</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Customer List</a></li>
                </ol>
            </div>
            <a href="javascript:void(0);" class="btn btn-primary rounded light mr-3">Refresh</a>
            <a href="javascript:void(0);" class="btn btn-primary rounded"><i class="flaticon-381-settings-2 mr-0"></i></a>
        </div>
       
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">

                        @foreach ($users as $user )
                        <div class="row border-bottom mx-0 pt-4 px-2 align-items-center ">
                            <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-12 mb-sm-4 mb-3 align-items-center  media">
                                <img class="mr-sm-4 mr-3 img-fluid rounded" width="90" 
                                    src="{{ $user->cover ? '/storage/app/' . $user->cover : 'https://t3.ftcdn.net/jpg/03/94/89/90/360_F_394899054_4TMgw6eiMYUfozaZU3Kgr5e0LdH4ZrsU.jpg' }}" 
                                    alt="">

                                <div class="media-body">
                                    {{-- <span class="text-primary d-block">#C01234</span> --}}
                                    <h3 class="fs-20 text-black font-w600 mb-1"> {{ $user->name  }} | {{ $user->fname.' '.$user->lname }}</h3>
                                    <span class="d-block mb-lg-0 mb-0">Join on {{ $user->created_at->toFormattedDateString() }}</span>
                                </div>
                            </div>
                            <div class="col-xl-2 col-xxl-2 col-lg-3 col-sm-4 mb-sm-4 col-6 mb-3">
                                <small class="mb-2 d-block">Location</small>
                                <span class="text-black font-w600">{{ $user->location }}</span>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-4 mb-sm-4 col-6 mb-3 text-lg-center">
                                <small class="mb-2 d-block">Phone Number</small>
                                <span class="text-black font-w600">{{ $user->phone ?? 'No Phone' }}</span>
                            </div>
                            <div class="col-xl-2 col-xxl-3 col-lg-6 col-sm-4 mb-sm-4 mb-3">
                                <small class="mb-2 d-block">Email Address</small>
                                <span class="text-black font-w600">{{ $user->email }}</span>
                            </div>
                            <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6 mb-sm-4 mb-4 d-flex ">
                                <div class="dropdown media-dropdown mt-auto mb-auto mr-auto">
                                    {{-- <div class="btn-link" data-toggle="dropdown" >
                                        <a href="javascript:void(0);" class="btn btn-outline-primary rounded">Show Order History
                                            <svg class="ml-2" width="12" height="6" viewBox="0 0 12 6" fill="none" xmlns="../../../www.w3.org/2000/svg.html">
                                                <path d="M0 -5.24537e-07L6 6L12 0" fill="#3B4CB8"/>
                                            </svg>
                                        </a>
                                    </div> --}}
                                    <div class="dropdown-menu dropdown-menu-right rounded">
                                        <div class="media mb-4">
                                            <img class="mr-sm-4 mr-3 img-fluid rounded" width="90"  src="public/images/customers/4.jpg" alt="DexignZone">
                                            <div class="media-body">
                                                <h4 class="fs-16 text-black font-w600 mb-0">James Humbly</h4>
                                                <span class="fs-14 d-block mb-3">2 June 2018 - 4 June 2019</span>
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
                                            <img class="mr-sm-4 mr-3 img-fluid rounded" width="90"  src="public/images/customers/3.jpg" alt="DexignZone">
                                            <div class="media-body">
                                                <h4 class="fs-16 text-black font-w600 mb-0">James Humbly</h4>
                                                <span class="fs-14 d-block mb-3">2 June 2018 - 4 June 2019</span>
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
                                <div class="dropdown ml-4  mt-auto mb-auto">
                                    {{-- <div class="btn-link" data-toggle="dropdown" >
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                    </div> --}}
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
