<div class="content-body">
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Locations</h2>
            </div>
            <button id="createLocationBtn" class="mr-3 rounded btn btn-primary light">Create One</button>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="p-0 card-body">
                        @foreach ($locations as $loc)
                        <div class="px-2 pt-4 mx-0 row border-bottom align-items-center">
                            <div class="col-xl-2 col-lg-3 col-sm-4">
                                <small class="mb-2 d-block">Location</small>
                                <span class="text-black font-w600">{{ $loc->name }}</span>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-4 text-lg-center">
                                <small class="mb-2 d-block">Description</small>
                                <span class="text-black font-w600">{{ $loc->desc ?? 'No Description' }}</span>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-sm-4">
                                <small class="mb-2 d-block">Icon</small>
                                <span class="text-black font-w600">{{ $loc->icon_name }}</span>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 d-flex">
                                <div class="dropdown">
                                    <button class="btn btn-link" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="editLocation({{ $loc->id }})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete({{ $loc->id }})">Delete</a>
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
    <div id="locationModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create Location</h5>
                    <button type="button" class="close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="locationForm">
                        <div class="form-group">
                            <label>Location Name</label>
                            <input type="text" class="form-control" id="locationName" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="locationDesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Icon Name</label>
                            <input type="text" class="form-control" id="locationIcon">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="saveLocation()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for CRUD Operations -->
    <script>
        let editingLocationId = null;

        document.getElementById('createLocationBtn').addEventListener('click', () => {
            editingLocationId = null;
            document.getElementById('modalTitle').textContent = 'Create Location';
            document.getElementById('locationForm').reset();
            document.getElementById('locationModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('locationModal').style.display = 'none';
        }

        function saveLocation() {
            const name = document.getElementById('locationName').value;
            const desc = document.getElementById('locationDesc').value;
            const icon = document.getElementById('locationIcon').value;

            const data = {
                name: name,
                desc: desc,
                icon_name: icon
            };

            let url = `{{ env('APP_URL') }}/api/locations`;
            let method = 'POST';

            if (editingLocationId) {
                url = `{{ env('APP_URL') }}/api/locations/${editingLocationId}`;
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

        function editLocation(id) {
            editingLocationId = id;
            fetch(`{{ env('APP_URL') }}/api/locations/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = 'Edit Location';
                document.getElementById('locationName').value = data.name;
                document.getElementById('locationDesc').value = data.desc;
                document.getElementById('locationIcon').value = data.icon_name;
                document.getElementById('locationModal').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching location:', error);
            });
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this location?")) {
                fetch(`{{ env('APP_URL') }}/api/locations/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.message || 'Location deleted successfully');
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error deleting location:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        }
    </script>
</div>
