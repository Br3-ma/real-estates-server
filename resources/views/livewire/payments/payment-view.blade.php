<div class="content-body">
    <div class="container payment-form">
        <h2>Mobile Payment Details</h2>
        <form id="paymentForm">
            <div class="form-group">
                <label for="mobileNetwork">Mobile Network</label>
                <input type="text" value="AIRTEL_OAPI_ZMB" id="mobileNetwork" name="correspondent" required>
            </div>
            <div class="form-group">
                <label for="mobilePhone">Mobile Phone</label>
                <input type="tel" id="mobilePhone" value="260772147755" name="phone" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount (ZMW)</label>
                <input type="number" value="15" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="payingFor">Paying For</label>
                <input type="text" id="payingFor" value="subscription" name="payingFor">
            </div>
            <div class="form-group">
                <label for="boostInfo">Boost Info</label>
                <input type="text" id="boostInfo" name="boostInfo">
            </div>
            <div class="form-group">
                <label for="postID">Post ID</label>
                <input type="text" id="postID" name="post_id" required>
            </div>
            <div class="form-group">
                <label for="planID">Plan ID</label>
                <input type="text" id="planID" value="2" name="plan_id" required>
            </div>
            <div class="form-group">
                <label for="userID">User ID</label>
                <input type="text" id="userID" value="1" name="user_id" required>
            </div>
            <button type="submit" class="submit-btn">Submit Payment</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("paymentForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(event.target);

        fetch("/square-api-server/api/v1/submit-mobile-payment", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Accept": "application/json"
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw new Error(`Error: ${errorData.error} - ${errorData.details}`);
                });
            }
            return response.json();
        })
        .then(data => {
            alert("Payment submitted successfully!");
            console.log("Payment Response:", data);
            document.getElementById("paymentForm").reset();
        })
        .catch(error => {
            console.error("Error submitting payment:", error.message);
            alert(`Payment submission failed: ${error.message}`);
        });
    });
</script>

