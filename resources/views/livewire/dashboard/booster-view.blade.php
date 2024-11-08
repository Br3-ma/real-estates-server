<div>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head page-titles d-flex align-items-center">
                <div class="mr-auto d-lg-block">
                    <h2 class="text-black font-w600">Boost Plans</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Boost Plans</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Property Boost Plans List</a></li>
                    </ol>
                </div>
                <!-- Button to open the Create Plan modal -->
                <a href="javascript:void(0);" onclick="openCreatePlanModal()" class="mr-3 rounded btn btn-primary light">Create One</a>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="p-0 card-body">
                            @foreach ($boosts as $boost)
                            <div class="px-2 pt-4 mx-0 row border-bottom align-items-center">
                                <div class="mb-3 col-xl-2 col-xxl-2 col-lg-3 col-sm-4 mb-sm-4 col-6">
                                    <small class="mb-2 d-block">Boost</small>
                                    <span class="text-black font-w600">K{{ $boost->amount }}</span>
                                </div>
                                <div class="mb-3 col-xl-4 col-xxl-3 col-lg-3 col-sm-4 mb-sm-4 col-6 text-lg-center">
                                    <small class="mb-2 d-block">Description</small>
                                    <span class="text-black font-w600">{{ $boost->desc }}</span>
                                    <span class="text-black font-w600">{{ $boost->duration }}</span>
                                    <span class="text-black font-w600">{{ $boost->duration_type.' plan' }}</span>
                                </div>
                                <div class="mb-3 col-xl-2 col-xxl-3 col-lg-6 col-sm-4 mb-sm-4">
                                    <small class="mb-2 d-block">Icon</small>
                                    <span class="text-black font-w600">{{ $boost->icon ?? 'No Icon' }}</span>
                                </div>
                                <div class="mb-4 col-xl-3 col-xxl-4 col-lg-6 col-sm-6 mb-sm-4 d-flex">
                                    <a class="btn btn-primary" href="javascript:void(0);" onclick="editPlan({{ $boost->id }})">Edit</a>
                                    <a class="btn btn-secondary" href="javascript:void(0);" onclick="confirmDelete({{ $boost->id }})">Delete</a>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Creating and Editing Boost Plans -->
    <div id="planModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalTitle" class="modal-title">Create Boost Plan</h5>
                    <button type="button"  onclick="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="planForm">
                        <div class="form-group">
                            <label for="planName">Plan Name</label>
                            <input type="text" id="planName" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="planDesc">Description</label>
                            <textarea id="planDesc" name="desc" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="planAmount">Amount</label>
                            <input type="number" id="planAmount" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="planIcon">Icon</label>
                            <input type="text" id="planIcon" name="icon" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="planDuration">Duration</label>
                            <input type="number" id="planDuration" name="duration" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="planDurationType">Duration Type</label>
                            <select id="planDurationType" name="planDurationType" class="form-control">
                                <option value="day">Day</option>
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="savePlan()">Save Plan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Handle Create, Edit, and Delete Logic -->
    <script>
        let editingPlanId = null;

        // Open the create plan modal
        function openCreatePlanModal() {
            editingPlanId = null; // Clear any editing state
            document.getElementById('modalTitle').textContent = 'Create Boost Plan';
            // document.getElementById('planForm').reset(); // Reset form
            document.getElementById('planModal').style.display = 'block';
        }

        // Open the edit plan modal
        function editPlan(id) {
            editingPlanId = id;
            fetch(`{{ env('APP_URL') }}/api/boostplans/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = 'Edit Boost Plan';
                document.getElementById('planName').value = data.name;
                document.getElementById('planDesc').value = data.description;
                document.getElementById('planAmount').value = data.amount;
                document.getElementById('planIcon').value = data.icon;
                document.getElementById('planDuration').value = data.duration;
                document.getElementById('planDurationType').value = data.duration_type;
                document.getElementById('planModal').style.display = 'block';
            })
            .catch(error => console.error('Error fetching plan:', error));
        }

        // Save or Update the plan
        function savePlan() {

            const name = document.getElementById('planName').value;
            const desc = document.getElementById('planDesc').value;
            const amount = document.getElementById('planAmount').value;
            const icon = document.getElementById('planIcon').value;
            const duration = document.getElementById('planDuration').value;
            const durationType = document.getElementById('planDurationType').value;

            const data = {
                name: name,
                description: desc,
                amount: amount,
                icon: icon,
                duration: duration,
                duration_type: durationType
            };

            let url = `{{ env('APP_URL') }}/api/boostplans`;
            let method = 'POST';

            if (editingPlanId) {
                url = `{{ env('APP_URL') }}/api/boostplans/${editingPlanId}`;
                method = 'PUT';
            }

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                alert(result.message || 'Operation successful');
                window.location.reload(); // Refresh to see changes
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });

            closeModal();
        }

        // Delete plan with confirmation
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this plan?")) {
                fetch(`{{ env('APP_URL') }}/api/boostplans/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.message || 'Plan deleted successfully');
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error deleting plan:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        }

        // Close the modal
        function closeModal() {
            document.getElementById('planModal').style.display = 'none';
        }
    </script>

</div>
