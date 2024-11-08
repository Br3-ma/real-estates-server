<div class="content-body">
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
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">

                        @foreach ($users as $user)
                            @if($user->role != 'admin')
                            <div class="row border-bottom mx-0 pt-4 px-2 align-items-center" id="user-{{ $user->id }}">
                                <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-12 mb-sm-4 mb-3 align-items-center media">
                                    <img class="mr-sm-4 mr-3 img-fluid rounded" width="90"
                                        src="{{ $user->cover ? '/storage/app/' . $user->cover : 'https://t3.ftcdn.net/jpg/03/94/89/90/360_F_394899054_4TMgw6eiMYUfozaZU3Kgr5e0LdH4ZrsU.jpg' }}"
                                        alt="">
                                    <div class="media-body">
                                        <h3 class="fs-20 text-black font-w600 mb-1"> {{ $user->name }} {{ $user->fname.' '.$user->lname }}</h3>
                                        <span class="d-block mb-lg-0 mb-0">Join on {{ $user->created_at->toFormattedDateString() }}</span>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-xxl-3 col-lg-3 col-sm-4 mb-sm-4 col-6 mb-3 text-lg-center">
                                    <small class="mb-2 d-block">Phone Number</small>
                                    <span class="text-black font-w600">{{ $user->phone ?? 'No Phone' }}</span>
                                </div>
                                <div class="col-xl-2 col-xxl-3 col-lg-6 col-sm-4 mb-sm-4 mb-3">
                                    <small class="mb-2 d-block">Email Address</small>
                                    <span class="text-black font-w600">{{ $user->email }}</span>
                                    <span class="text-black font-w600">{{ $user->location }}</span>
                                </div>
                                <div class="col-xl-2 col-xxl-2 col-lg-2 col-sm-2 mb-sm-2 mb-4 d-flex">
                                    {{-- <a class="dropdown-item" href="javascript:void(0);">Edit</a> --}}
                                    <a class="btn btn-danger" href="javascript:void(0);" onclick="deleteUser({{ $user->id }})">Delete</a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Send DELETE request to the server
            fetch(`{{ env('APP_URL') }}/api/users/${userId}`, {
                method: 'DELETE', // HTTP DELETE method
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for Laravel
                },
            })
            .then(response => {
                if (response.ok) {
                    alert('User deleted successfully');
                    // Optionally remove the user from the DOM
                    document.getElementById(`user-${userId}`).remove();
                } else {
                    alert('Failed to delete user');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the user');
            });
        }
    }
</script>
