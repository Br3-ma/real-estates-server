<div class="content-body">
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Property Types</h2>
            </div>
            <button id="createPropertyTypeBtn" class="mr-3 rounded btn btn-primary light">Create One</button>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="p-0 card-body">
                        @foreach ($types as $propertyType)
                        <div class="px-2 pt-4 mx-0 row border-bottom align-items-center">
                            <div class="col-xl-2 col-lg-3 col-sm-4">
                                <small class="mb-2 d-block">Property Type</small>
                                <span class="text-black font-w600">{{ $propertyType->name }}</span>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-4 text-lg-center">
                                <small class="mb-2 d-block">Description</small>
                                <span class="text-black font-w600">{{ $propertyType->desc ?? 'No Description' }}</span>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-sm-4">
                                <small class="mb-2 d-block">Icon</small>
                                <span class="text-black font-w600">{{ $propertyType->icon_name }}</span>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 d-flex">
                                <a class="btn btn-primary" href="javascript:void(0);" onclick="editPropertyType({{ $propertyType->id }})">Edit</a>
                                <a class="btn btn-danger" href="javascript:void(0);" onclick="confirmDelete({{ $propertyType->id }})">Delete</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Create/Edit -->
    <div id="propertyTypeModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create Property Type</h5>
                    <button type="button" class="close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="propertyTypeForm">
                        <div class="form-group">
                            <label>Property Type Name</label>
                            <input type="text" class="form-control" id="propertyTypeName" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="propertyTypeDesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Icon Name</label>
                            <select type="text" class="form-control" id="propertyTypeIcon">
                                <option value="home-city">home-city</option>
                                <option value="home">home</option>
                                <option value="office-building">office-building</option>
                                <option value="apartment-building">apartment-building</option>
                                <option value="store">store</option>
                                <option value="city">city</option>
                                <option value="city-variant">city-variant</option>
                                <option value="map-marker">map-marker</option>
                                <option value="map">map</option>
                                <option value="home-floor">home-floor</option>
                                <option value="warehouse">warehouse</option>
                                <option value="key">key</option>
                                <option value="bank">bank</option>
                                <option value="home-outline">home-outline</option>
                                <option value="building">building</option>
                                <option value="location-enter">location-enter</option>
                                <option value="home-analytics">home-analytics</option>
                                <option value="door">door</option>
                                <option value="home-account">home-account</option>
                                <option value="garage">garage</option>
                                <option value="leaf">leaf</option>
                                <option value="building-cog">building-cog</option>
                                <option value="ruler-square">ruler-square</option>
                                <option value="key-chain">key-chain</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="savePropertyType()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for CRUD Operations -->
    <script>
        let editingPropertyTypeId = null;

        document.getElementById('createPropertyTypeBtn').addEventListener('click', () => {
            editingPropertyTypeId = null;
            document.getElementById('modalTitle').textContent = 'Create Property Type';
            document.getElementById('propertyTypeForm').reset();
            document.getElementById('propertyTypeModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('propertyTypeModal').style.display = 'none';
        }

        function savePropertyType() {
            const name = document.getElementById('propertyTypeName').value;
            const desc = document.getElementById('propertyTypeDesc').value;
            const icon = document.getElementById('propertyTypeIcon').value;

            const data = {
                name: name,
                desc: desc,
                icon_name: icon
            };

            let url = `{{ env('APP_URL') }}/api/property-types`;
            let method = 'POST';

            if (editingPropertyTypeId) {
                url = `{{ env('APP_URL') }}/api/property-types/${editingPropertyTypeId}`;
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

        function editPropertyType(id) {
            editingPropertyTypeId = id;
            fetch(`{{ env('APP_URL') }}/api/property-types/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = 'Edit Property Type';
                document.getElementById('propertyTypeName').value = data.name;
                document.getElementById('propertyTypeDesc').value = data.desc;
                document.getElementById('propertyTypeIcon').value = data.icon_name;
                document.getElementById('propertyTypeModal').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching property type:', error);
            });
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this property type?")) {
                fetch(`{{ env('APP_URL') }}/api/property-types/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.message || 'Property type deleted successfully');
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error deleting property type:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        }
    </script>
</div>
