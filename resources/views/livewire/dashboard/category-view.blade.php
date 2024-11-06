<div class="content-body">
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Categories</h2>
            </div>
            <button wire:click="create" class="mr-3 rounded btn btn-primary light">Create One</button>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="p-0 card-body">
                        @foreach ($categories as $cat)
                        <div class="px-2 pt-4 mx-0 row border-bottom align-items-center">
                            <div class="col-xl-2 col-lg-3 col-sm-4">
                                <small class="mb-2 d-block">Category</small>
                                <span class="text-black font-w600">{{ $cat->name }}</span>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-4 text-lg-center">
                                <small class="mb-2 d-block">Description</small>
                                <span class="text-black font-w600">{{ $cat->desc ?? 'No Description' }}</span>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-sm-4">
                                <small class="mb-2 d-block">Icon</small>
                                <span class="text-black font-w600">{{ $cat->icon_name }}</span>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 d-flex">
                                <div class="dropdown">
                                    <button class="btn btn-link" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" wire:click="edit({{ $cat->id }})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" wire:click="confirmDelete({{ $cat->id }})">Delete</a>
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

    {{-- Modal for Create/Edit --}}
    @if($showModal)
    <div class="modal show d-block" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $categoryId ? 'Edit Category' : 'Create Category' }}</h5>
                    <button type="button" wire:click="$set('showModal', false)" class="close">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" wire:model.defer="name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" wire:model.defer="desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Icon Name</label>
                            <input type="text" class="form-control" wire:model.defer="icon_name">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Delete Confirmation --}}
    <script>
        window.addEventListener('show-delete-confirmation', event => {
            if (confirm("Are you sure you want to delete this category?")) {
                @this.call('delete')
            }
        });
    </script>
</div>
