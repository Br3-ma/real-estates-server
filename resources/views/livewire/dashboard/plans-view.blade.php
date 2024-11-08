<div class="content-body">
    <div class="container-fluid">
        <div class="form-head page-titles d-flex align-items-center">
            <div class="mr-auto d-lg-block">
                <h2 class="text-black font-w600">Subscription Plans</h2>
            </div>
            <button id="createPlanBtn" class="mr-3 rounded btn btn-primary light">Create One</button>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="p-0 card-body">
                        @foreach ($plans as $plan)
                        <div class="px-2 pt-4 mx-0 row border-bottom align-items-center">
                            <div class="col-xl-2 col-lg-3 col-sm-4">
                                <small class="mb-2 d-block">Plan Name</small>
                                <span class="text-black font-w600">{{ $plan->name }}</span>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-4 text-lg-center">
                                <small class="mb-2 d-block">Description</small>
                                <span class="text-black font-w600">{{ $plan->description ?? 'No Description' }}</span>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-sm-4">
                                <small class="mb-2 d-block">Amount</small>
                                <span class="text-black font-w600">K{{ $plan->amount }}</span>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-sm-6 d-flex">
                                <div class="dropdown">
                                    <button class="btn btn-link" data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="editPlan({{ $plan->id }})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete({{ $plan->id }})">Delete</a>
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
    <div id="planModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create Plan</h5>
                    <button type="button" class="close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="planForm">
                        <div class="form-group">
                            <label>Plan Name</label>
                            <input type="text" class="form-control" id="planName" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="planDesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" id="planAmount" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="savePlan()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for CRUD Operations -->
    <script>
        let editingPlanId = null;

        document.getElementById('createPlanBtn').addEventListener('click', () => {
            editingPlanId = null;
            document.getElementById('modalTitle').textContent = 'Create Plan';
            document.getElementById('planForm').reset();
            document.getElementById('planModal').style.display = 'block';
        });

        function closeModal() {
            document.getElementById('planModal').style.display = 'none';
        }

        function savePlan() {
            const name = document.getElementById('planName').value;
            const desc = document.getElementById('planDesc').value;
            const amount = document.getElementById('planAmount').value;

            const data = {
                name: name,
                description: desc,
                amount: amount
            };

            let url = `{{ env('APP_URL') }}/api/plans`;
            let method = 'POST';

            if (editingPlanId) {
                url = `{{ env('APP_URL') }}/api/plans/${editingPlanId}`;
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

        function editPlan(id) {
            editingPlanId = id;
            fetch(`{{ env('APP_URL') }}/api/plans/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalTitle').textContent = 'Edit Plan';
                document.getElementById('planName').value = data.name;
                document.getElementById('planDesc').value = data.description;
                document.getElementById('planAmount').value = data.amount;
                document.getElementById('planModal').style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching plan:', error);
            });
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this plan?")) {
                fetch(`{{ env('APP_URL') }}/api/plans/${id}`, {
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
    </script>
</div>
