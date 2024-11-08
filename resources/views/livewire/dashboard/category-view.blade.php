<div class="content-body">
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Categories</h2>
            </div>
            <button id="createCategoryBtn" class="mr-3 rounded btn btn-primary light">Create One</button>
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
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="editCategory({{ $cat->id }})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete({{ $cat->id }})">Delete</a>
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

    <!-- Modal for Create/Edit -->
    <div id="categoryModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create Category</h5>
                    <button type="button" class="close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" id="categoryName" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="categoryDesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Icon Name</label>
                            <input type="text" class="form-control" id="categoryIcon">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="saveCategory()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for CRUD Operations -->
    <script>
        let editingCategoryId = null;

        document.getElementById('createCategoryBtn').addEventListener('click', () => {
            editingCategoryId = null;
            document.getElementById('modalTitle').textContent = 'Create Category';
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('categoryModal').style.display = 'none';
        }

        function saveCategory() {
            const name = document.getElementById('categoryName').value;
            const desc = document.getElementById('categoryDesc').value;
            const icon = document.getElementById('categoryIcon').value;

            const data = {
                name: name,
                desc: desc,
                icon_name: icon
            };

            let url = `{{ env('APP_URL') }}/api/categories`;
            let method = 'POST';

            if (editingCategoryId) {
                url = `{{ env('APP_URL') }}/api/categories/${editingCategoryId}`;
                method = 'PUT';
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                alert(result.message || 'Operation successful');
                window.location.reload(); // Refresh the page to see changes
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });

            closeModal();
        }

        function editCategory(id) {
            editingCategoryId = id;
            fetch(`{{ env('APP_URL') }}/api/categories/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = 'Edit Category';
                document.getElementById('categoryName').value = data.name;
                document.getElementById('categoryDesc').value = data.desc;
                document.getElementById('categoryIcon').value = data.icon_name;
                document.getElementById('categoryModal').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching category:', error);
            });
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this category?")) {
                fetch(`{{ env('APP_URL') }}/api/categories/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.message || 'Category deleted successfully');
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error deleting category:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        }
    </script>
</div>
