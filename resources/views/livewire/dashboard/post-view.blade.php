<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Posts</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Posts</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Posts List</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="p-0 card-body">

                        @foreach ($posts as $post)
                            @if($post->role != 'admin')
                            <div class="px-2 pt-4 mx-0 row border-bottom align-items-center" id="post-{{ $post->id }}">
                                <div class="mb-3 col-xl-3 col-xxl-4 col-lg-6 col-sm-12 mb-sm-4 align-items-center media">
                                    <img class="mr-3 rounded mr-sm-4 img-fluid" width="90"
                                        src="{{ env('APP_URL').'/storage/app/' . $post->images->first()?->path }}"
                                        alt="">
                                        <p class="mb-1 text-black fs-10 font-w600"> {{ $post->title }} </p>

                                </div>
                                <div class="mb-3 col-xl-2 col-xxl-3 col-lg-3 col-sm-4 mb-sm-4 col-6">
                                    <small class="mb-2 d-block">Phone Number</small>
                                    <span class="text-black font-w600">{{ $post->description ?? 'No Phone' }}</span>
                                    @switch($post->verified_status)
                                        @case(1)
                                            <p class="text-md text-success font-w600">Verified</p>
                                        @break
                                        @case(2)
                                            <p class="text-md text-warning font-w600">Under Review</p>
                                        @break
                                        @case(3)
                                            <p class="text-md text-danger font-w600">Declined</p>
                                        @break
                                            <p class="text-md text-primary font-w600">Pending Review</p>
                                        @default
                                    @endswitch
                                </div>
                                <div class="mb-3 col-xl-2 col-xxl-3 col-lg-6 col-sm-4 mb-sm-4">
                                    <small class="mb-2 d-block">Number of Rooms</small>
                                    <span class="text-black font-w600">{{ $post->bedrooms }} Bedrooms</span>
                                    <span class="text-black font-w600">{{ $post->bathrooms }} Bathrooms</span>
                                </div>
                                <div class="mb-4 col-xl-2 col-xxl-2 col-lg-2 col-sm-2 mb-sm-2 d-flex">
                                    <a class="btn btn-primary btn-xs" href="{{ route('post-review', ['post'=>$post->id]) }}">Review Post</a>
                                    <a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="deletePost({{ $post->id }})">Delete Post</a>
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
    function deletePost(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            // Send DELETE request to the server
            fetch(`{{ env('APP_URL') }}/api/delete-post/${postId}`, {
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
                    document.getElementById(`user-${postId}`).remove();
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

