<div class="content-body">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container-fluid">
        <!-- Header Section -->
        <div class="mb-4 form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Property Review</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('posts') }}">Properties</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Property Review</a></li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="btn-group">
                    @if($post->verified_status == 0 || $post->verified_status == 2)
                    <button id="approveButton" wire:click="approvePost" wire:loading.attr="disabled" class="mr-2 btn btn-success light">
                        <span wire:loading wire:target="approvePost"><i class="mr-2 fa fa-spinner fa-spin"></i></span>
                        <span wire:loading.remove wire:target="approvePost"><i class="mr-2 fa fa-check-circle"></i></span>
                        Approve
                    </button>
                    @endif

                    @if ($post->verified_status != 2 || $post->verified_status != 1)
                    <button id="holdButton" wire:click="holdPost" wire:loading.attr="disabled" class="mr-2 btn btn-warning light">
                        <span wire:loading wire:target="holdPost"><i class="mr-2 fa fa-spinner fa-spin"></i></span>
                        <span wire:loading.remove wire:target="holdPost"><i class="mr-2 fa fa-clock"></i></span>
                        Hold
                    </button>
                    @endif

                    @if ($post->verified_status != 3)
                    <button id="declineButton" wire:click="declinePost" wire:loading.attr="disabled" class="btn btn-danger light">
                        <span wire:loading wire:target="declinePost"><i class="mr-2 fa fa-spinner fa-spin"></i></span>
                        <span wire:loading.remove wire:target="declinePost"><i class="mr-2 fa fa-times-circle"></i></span>
                        Decline
                    </button>
                    @endif
                </div>
                <input type="hidden" id="approveButton">
                <input type="hidden" id="holdButton">
                {{-- <input type="hidden" id="deleteButton"> --}}
            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <!-- Main Property Information -->
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="pb-0 border-0 card-header">
                        <h4 class="text-black font-w600">{{ $post->title }}</h4>
                        <div class="d-flex align-items-center">
                            <span class="mr-3 fs-14">
                                <i class="mr-2 fas fa-tag"></i>ID:{{ $post->id }}
                            </span>
                            <span class="mr-3 fs-14">
                                <i class="mr-2 fas fa-map-marker-alt"></i>{{ $post->location }}
                            </span>
                            <span class="fs-14">
                                <i class="mr-2 fas fa-calendar"></i>{{ $post?->created_at?->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Property Images -->
                        <div class="mb-4 property-gallery">
                            <h4 class="mb-3 text-black font-w600">Property Images</h4>
                            <div class="row">
                                @forelse($post->images as $image)
                                    <div class="mb-3 col-md-4">
                                        <div class="position-relative">
                                            <img src="{{ env('APP_URL').'/storage/app/' .$image->path }}"
                                                 class="rounded img-fluid"
                                                 alt="Property Image">
                                            <span class="bottom-0 right-0 m-2 position-absolute badge badge-primary">
                                                Priority: {{ $image->priority }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted">No images available</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="mb-4">
                            <h4 class="mb-3 text-black font-w600">Location Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-black font-w500">Address</label>
                                        <p>{{ $post->location }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-black font-w500">Coordinates</label>
                                        <p>Latitude: {{ $post->lat }}<br>Longitude: {{ $post->long }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-black font-w500">Area Location</label>
                                        <p>{{ $post->location?->name ?? 'N/A' }}</p>
                                        <small>{{ $post->location?->desc ?? '' }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-black font-w500">Status</label>
                                        @switch($post->verified_status)
                                            @case(1)
                                                <p class="text-xl text-success font-w600">Verified</p>
                                                <small>{{ $post->created_at?->toFormattedDateString() ?? '' }}</small>
                                            @break
                                            @case(2)
                                                <p class="text-xl text-warning font-w600">Under Review</p>
                                                <small>{{ $post->created_at?->toFormattedDateString() ?? '' }}</small>
                                            @break
                                            @case(3)
                                                <p class="text-xl text-danger font-w600">Declined</p>
                                                <small>{{ $post->created_at?->toFormattedDateString() ?? '' }}</small>
                                            @break

                                            @default
                                        @endswitch
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="mb-4">
                            <h4 class="mb-3 text-black font-w600">Property Details</h4>
                            <div class="row">
                                <div class="mb-3 col-md-3 col-sm-6">
                                    <div class="p-3 text-center border rounded detail-item">
                                        <i class="mb-2 fas fa-bed fs-24"></i>
                                        <h6>{{ $post->bedrooms }} Bedrooms</h6>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3 col-sm-6">
                                    <div class="p-3 text-center border rounded detail-item">
                                        <i class="mb-2 fas fa-bath fs-24"></i>
                                        <h6>{{ $post->bathrooms }} Bathrooms</h6>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3 col-sm-6">
                                    <div class="p-3 text-center border rounded detail-item">
                                        <i class="mb-2 fas fa-vector-square fs-24"></i>
                                        <h6>{{ $post->area }} sq ft</h6>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3 col-sm-6">
                                    <div class="p-3 text-center border rounded detail-item">
                                        <i class="mb-2 fas fa-tag fs-24"></i>
                                        <h6>${{ number_format($post->price, 2) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h4 class="mb-3 text-black font-w600">Description</h4>
                            <p class="fs-14">{{ $post->description }}</p>
                        </div>

                        <!-- Amenities -->
                        <div class="mb-4">
                            <h4 class="mb-3 text-black font-w600">Amenities</h4>
                            <div class="row">
                                @forelse($post->amenities as $amenity)
                                    <div class="mb-2 col-md-4 col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <i class="mr-2 fas fa-check-circle text-success"></i>
                                            <span>{{ $amenity->amenity_name }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted">No amenities listed</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Videos -->
                        @if($post->videos->count() > 0)
                        <div class="mb-4">
                            <h4 class="mb-3 text-black font-w600">Property Video</h4>
                            <div class="row">
                                @foreach($post->videos as $video)
                                    <div class="mb-3 col-md-6">
                                        <video class="rounded w-100" controls>
                                            <source src="{{ Storage::url($video->path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="mb-4">
                            <h4 class="mb-3 text-black fw-bold">Property Documents and IDs</h4>
                            <div class="row g-3">
                                @foreach($post->files as $file)
                                    @php
                                        $fileUrl = '/storage/app/'.$file->path; // Prevent caching issues
                                        $fileExt = pathinfo($file->name, PATHINFO_EXTENSION);
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="shadow-sm card h-100">
                                            <div class="p-3 card-body">
                                                <div class="gap-2 mb-2 d-flex align-items-center">
                                                    <i class="fas fa-file-alt text-primary"></i>
                                                    <h6 class="mb-0 card-title text-truncate flex-grow-1">{{ $file->name }}</h6>
                                                    <span class="badge bg-light text-dark">{{ $fileExt }}</span>
                                                </div>
                                                <div class="gap-2 d-flex">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary flex-grow-1 preview-btn"
                                                        data-file-path="{{ $fileUrl }}"
                                                        data-file-name="{{ $file->name }}"
                                                        data-file-type="{{ strtolower($fileExt) }}"
                                                        data-file-id="{{ $file->id }}">
                                                        <i class="fas fa-eye me-1"></i> Preview
                                                    </button>
                                                    <a href="{{ $fileUrl }}"
                                                       class="btn btn-sm btn-primary"
                                                       download="{{ $file->name }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Single Reusable Modal -->
                        <!-- File Preview Modal -->
                        <div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="py-2 modal-header">
                                        <h6 class="modal-title"></h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="p-0 modal-body">
                                        <div class="p-3 text-center preview-container position-relative">
                                            <span class="text-muted">Loading preview...</span>
                                        </div>
                                    </div>
                                    <div class="py-2 modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-sm btn-success approve-btn">
                                            <i class="fas fa-check me-1"></i> Approve
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const modal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
                            const previewContainer = document.querySelector('#filePreviewModal .preview-container');
                            const modalTitle = document.querySelector('#filePreviewModal .modal-title');
                            const approveBtn = document.querySelector('#filePreviewModal .approve-btn');

                            // Handle preview clicks
                            document.querySelectorAll('.preview-btn').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    const filePath = this.dataset.filePath;
                                    const fileName = this.dataset.fileName;
                                    const fileType = this.dataset.fileType.toLowerCase();
                                    const fileId = this.dataset.fileId;

                                    modalTitle.textContent = fileName;
                                    approveBtn.dataset.fileId = fileId;

                                    // Clear previous content & show loader
                                    previewContainer.innerHTML = `<span class="text-muted">Loading preview...</span>`;

                                    // Handle different file types
                                    setTimeout(() => {
                                        if(['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileType)) {
                                            previewContainer.innerHTML = `
                                                <div class="space-y-4">
                                                    <div class="relative overflow-hidden rounded-lg aspect-video bg-gray-50">
                                                        <img src="${filePath}" alt="File preview"
                                                            class="object-contain w-full h-full" />
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="text-sm font-medium text-gray-900">${fileName}</div>
                                                        </div>
                                                        <div class="flex items-center space-x-3">
                                                            <button onclick="viewFile('${filePath}')"
                                                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                View
                                                            </button>
                                                            <button onclick="downloadFile('${filePath}', '${fileName}')"
                                                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        } else if(fileType === 'pdf') {
                                            previewContainer.innerHTML = `
                                                <div class="space-y-4">
                                                    <div class="relative aspect-[3/4] bg-gray-50 rounded-lg overflow-hidden border-2 border-gray-200">
                                                        <div class="absolute inset-0 flex items-center justify-center">
                                                            <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="text-sm font-medium text-gray-900">${fileName}</div>
                                                            <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                                                ${fileType}
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center space-x-3">
                                                            <button onclick="viewFile('${filePath}')"
                                                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                View
                                                            </button>
                                                            <button onclick="downloadFile('${filePath}', '${fileName}')"
                                                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        } else {
                                            previewContainer.innerHTML = `
                                                <div class="space-y-4">
                                                    <div class="relative overflow-hidden border-2 border-gray-200 rounded-lg aspect-square bg-gray-50">
                                                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                                                            <svg class="w-4 h-4 mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                            </svg>
                                                            <p class="text-sm font-medium text-gray-900">Preview not available for this file type</p>
                                                            <p class="mt-1 text-sm text-gray-500">${fileType.toUpperCase()} file</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="text-sm font-medium text-gray-900">${fileName}</div>
                                                            <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                                                ${fileType}
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center space-x-3">
                                                            <button onclick="viewFile('${filePath}')"
                                                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                View
                                                            </button>
                                                            <button onclick="downloadFile('${filePath}', '${fileName}')"
                                                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Download
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        }
                                    }, 500);

                                    modal.show();
                                });
                            });

                            // Handle approval
                            approveBtn.addEventListener('click', function() {
                                const fileId = this.dataset.fileId;
                                const cardButton = document.querySelector(`.preview-btn[data-file-id="${fileId}"]`);

                                // Update UI
                                this.innerHTML = '<i class="fas fa-check me-1"></i> Approved';
                                this.classList.replace('btn-success', 'btn-secondary');
                                this.disabled = true;

                                if(cardButton) {
                                    cardButton.parentElement.innerHTML = `
                                        <span class="badge bg-success w-100">
                                            <i class="fas fa-check me-1"></i> Approved
                                        </span>`;
                                }

                                // TODO: Add your approval API call here
                                // fetch('/api/approve-file/' + fileId, {method: 'POST'});
                            });
                        });

                        // Utility functions for view and download
                        function viewFile(filePath) {
                            const baseUrl = "{{ env('APP_URL') }}"; // Get Laravel APP_URL from Blade
                            window.open(baseUrl + filePath, '_blank');
                        }


                        function downloadFile(filePath, fileName) {
                            const link = document.createElement('a');
                            link.href = filePath;
                            link.download = fileName;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                        </script>
                    </div>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="col-xl-4 col-lg-12">
                <!-- Owner Information -->
                <div class="mb-4 card">
                    <div class="pb-0 border-0 card-header">
                        <h4 class="text-black font-w600">Owner Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="mr-3">
                                <img src="{{ env('APP_URL').'/storage/app/' .$post->user?->picture }}"
                                     class="rounded-sm"
                                     width="100"
                                     alt="Owner Photo">
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $post->user?->name }}</h5>
                                <p class="mb-0"><i class="mr-2 fas fa-envelope"></i>{{ $post->user?->email }}</p>
                                <p class="mb-0"><i class="mr-2 fas fa-phone"></i>{{ $post->user?->phone }}</p>
                            </div>
                        </div>
                        <div class="mt-3 user-stats">
                            <div class="row">
                                <div class="text-center col-4">
                                    <h5>{{ $post->user?->total_posts_count }}</h5>
                                    <small>Total Posts</small>
                                </div>
                                <div class="text-center col-4">
                                    <h5>{{ $post->user?->total_active_posts_count }}</h5>
                                    <small>Active Posts</small>
                                </div>
                                <div class="text-center col-4">
                                    <h5>ZMW {{ number_format($post->user?->estimate_profit ?? 0, 2) }}</h5>
                                    <small>Est. Profit</small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p><i class="mr-2 fas fa-briefcase"></i>{{ $post->user?->work }}</p>
                            <p><i class="mr-2 fas fa-map-marker-alt"></i>{{ $post->user?->location }}</p>
                            @if($post->user?->website)
                                <p><i class="mr-2 fas fa-globe"></i><a href="{{ $post->user->website }}" target="_blank">{{ $post->user->website }}</a></p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Property Status -->
                {{-- <div class="mb-4 card">
                    <div class="pb-0 border-0 card-header">
                        <h4 class="text-black font-w600">Property Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-black font-w500">Category</label>
                            <p>{{ $post->categories?->name ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="text-black font-w500">Property Type</label>
                            <p>{{ $post->propertyType?->name ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="text-black font-w500">Current Status</label>
                            <p>
                                @foreach($statusOptions as $key => $value)
                                    @if($post->status == $key)
                                        <span class="badge badge-{{ $key == 1 ? 'success' : ($key == 2 ? 'warning' : 'danger') }}">
                                            {{ $value }}
                                        </span>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div> --}}

                <!-- Bidding Information -->
                @if($post->on_bid)
                <div class="mb-4 card">
                    <div class="pb-0 border-0 card-header">
                        <h4 class="text-black font-w600">Bidding Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-black font-w500">Current Bid Value</label>
                            <h5>${{ number_format($post->bid_value, 2) }}</h5>
                        </div>
                        <div class="mb-3">
                            <label class="text-black font-w500">Bid Due Date</label>
                            <p>{{ \Carbon\Carbon::parse($post->bid_due_date)->format('M d, Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="text-black font-w500">Time Remaining</label>
                            <p>{{ \Carbon\Carbon::parse($post->bid_due_date)->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Review Actions -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-black font-w500">Review Notes</label>
                            <textarea
                                wire:model="reviewNotes"
                                class="form-control @error('reviewNotes') is-invalid @enderror"
                                rows="4"
                                placeholder="Add your review notes here..."
                            ></textarea>
                            @error('reviewNotes')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-column">
                            <button
                                wire:click="approvePost"
                                wire:loading.attr="disabled"
                                class="mb-2 btn btn-success btn-lg"
                            >
                                <span wire:loading wire:target="approvePost">
                                    <i class="mr-2 fa fa-spinner fa-spin"></i>Processing...
                                </span>
                                <span wire:loading.remove wire:target="approvePost">
                                    <i class="mr-2 fa fa-check-circle"></i>Approve Property
                                </span>
                            </button>
                            <button
                                wire:click="holdPost"
                                wire:loading.attr="disabled"
                                class="mb-2 btn btn-warning btn-lg"
                            >
                                <span wire:loading wire:target="holdPost">
                                    <i class="mr-2 fa fa-spinner fa-spin"></i>Processing...
                                </span>
                                <span wire:loading.remove wire:target="holdPost">
                                    <i class="mr-2 fa fa-clock"></i>Hold for Review
                                </span>
                            </button>
                            <button
                                wire:click="declinePost"
                                wire:loading.attr="disabled"
                                class="btn btn-danger btn-lg"
                            >
                                <span wire:loading wire:target="declinePost">
                                    <i class="mr-2 fa fa-spinner fa-spin"></i>Processing...
                                </span>
                                <span wire:loading.remove wire:target="declinePost">
                                    <i class="mr-2 fa fa-times-circle"></i>Decline Property
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const approveBtn = document.getElementById('approveButton');
            const holdBtn = document.getElementById('holdButton');
            const declineBtn = document.getElementById('declineButton');

            approveBtn.addEventListener('click', function () {
                const postId = {{ $post->id }};
                    fetch(`api/approve-post/${postId}`)
                        .then(response => response.json())
                        .then(data => {
                            window.location.reload(true);
                        })
                        .catch(error => console.error('Error approving post:', error));

            });

            holdBtn.addEventListener('click', function () {
                const postId = {{ $post->id }};
                    fetch(`api/hold-post/${postId}`)
                        .then(response => response.json())
                        .then(data => {
                            window.location.reload(true);
                        })
                        .catch(error => console.error('Error approving post:', error));

            });

            declineBtn.addEventListener('click', function () {
                const postId = {{ $post->id }};
                    fetch(`api/decline-post/${postId}`)
                        .then(response => response.json())
                        .then(data => {
                            window.location.reload(true);
                        })
                        .catch(error => console.error('Error approving post:', error));

            });
        });

    </script>
</div>
