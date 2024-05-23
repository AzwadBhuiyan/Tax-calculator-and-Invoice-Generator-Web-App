<!DOCTYPE html>

<html>

<head>
    <title>DESAI INTERNATIONAL TRADING CO.,LTD</title>
    <link rel="stylesheet" type="text/css" href="vendor/style.css">

    <style>
        .add-product-btn {
    margin: 20px auto;
    display: block;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.add-product-btn::before {
    content: "+";
    margin-right: 5px;
}



input[type="submit"] {
    background: linear-gradient(to right, #4CAF50, #2196F3);
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 5px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Style for labels */
label {
    display: block;
    margin-bottom: 5px;
    color: #333; /* Text color */
    font-weight: bold;
}

/* Style for date inputs */
input[type="date"] {
    padding: 8px; /* Padding around the input */
    border: 1px solid #ccc; /* Border color */
    border-radius: 5px; /* Rounded corners */
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Inner shadow */
    transition: border-color 0.2s; /* Smooth transition for border color */
}

/* Style for date inputs on focus */
input[type="date"]:focus {
    border-color: #66afe9; /* Highlight border color on focus */
    outline: none; /* Remove default focus outline */
}


    </style>

</head>

<body>
    <div class="container">
        <h2>DESAI INTERNATIONAL TRADING CO.,LTD</h2>
    


        <div class="form-container">
            <form method="post" onsubmit="return validateForm()">
                <div class="invoice-details">
                <div style="text-align: center;">

                    <label for="invoice_no">Invoice No:</label>
                    <input type="text" id="invoice_no" name="invoice_no" style="width: 25%; display: inline-block; margin-right: 10px;"required><br>
               
                   <label for="date">Date:</label>
<input type="date" id="date" name="date" style="width: 25%; display: inline-block; margin-right: 10px;" required>

<label for="due_date">Due Date:</label>
<input type="date" id="due_date" name="due_date" style="width: 25%; display: inline-block;" required>
</div>

                </div>

              

                <table class="invoice-table" style="width: 98%">
                    <tr>
                        <th>Description</th>
                        <th>Mode</th>
                        <th>Basis</th>
                        <th>Exchange rate</th>
                        <th>USD (Price)</th>
                        <th>JPY (Price)</th>
                        <th>VAT %</th>
                        <th>QTY</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="product_name[]" required></td>
                        <td><input type="text" name="mode[]"></td>
                        <td><input type="text" name="basis[]"></td>
                        <td><input type="number" step="0.01" name="exchange_rate[]"></td>
                        <td><input type="number" name="price_usd[]"></td>
                        <td><input type="number" name="price_jpy[]"></td>
                        <td><input type="number" name="vat[]"></td>
                        <td><input type="number" name="quantity[]" required></td>
                    </tr>
                </table>


                <button type="button" onclick="addProduct()" class="add-product-btn"> Add Product</button>


                <div class="container">
                    <div class="form-container">
                        <form method="post" onsubmit="return validateForm()">
                            <div class="invoice-details">
                                <!-- Invoice details inputs (unchanged) -->
                            </div>

                            <div class="information-section">
                                <!-- Client information inputs (unchanged) -->
                            </div>

                            <div class="information-section">
    <div class="left-column">
        <h3>Invoice To:</h3>
        <input type="text" id="client_name" name="client_name" placeholder="Client Name" required><br>

        <input type="text" id="client_address" name="client_address" placeholder="Client Address" required><br>

        <input type="text" id="client_email" name="client_email" placeholder="Client's Email" required><br>

        <input type="text" id="client_tel" name="client_tel" placeholder="Client's Contact No." required><br>
        <hr>
    </div>
    <div style="clear: both;"></div>
</div>




                            <!-- Order details section -->
                            <div class="order-details">
    <h3>Order Details:</h3>
    <div class="order-detail-item">
        <input type="text" id="booking" name="booking" placeholder="Booking">
    </div>
    <div class="order-detail-item">
        <input type="text" id="carrier" name="carrier" placeholder="Carrier">
    </div>
    <div class="order-detail-item">
        <input type="text" id="pol_pod" name="pol_pod" placeholder="POL-POD">
    </div>
    <div class="order-detail-item">
        <input type="text" id="vessel_voyage" name="vessel_voyage" placeholder="Vessel Voyage">
    </div>
    <div class="order-detail-item">
        <input type="text" id="etd_eta" name="etd_eta" placeholder="ETD-ETA">
    </div>
    <div class="order-detail-item">
        <input type="text" id="package" name="package" placeholder="Package">
    </div>
    <div class="order-detail-item">
        <input type="text" id="commodity" name="commodity" placeholder="Commodity">
    </div>
    <div class="order-detail-item">
        <input type="text" id="cargo_mode" name="cargo_mode" placeholder="Cargo Mode">
    </div>
    <div class="order-detail-item">
        <input type="text" id="size" name="size" placeholder="Size">
    </div>
</div>
<hr>



                            <!-- Product table (unchanged) -->

                            <!-- Styled "Add Product" button -->

                <!-- Bank info -->

                            <!-- <div class="bank-details">
                                <h3>Bank Information:</h3>
                                <div class="bank-detail-item">
                                    <label for="bank_name">Bank Name:</label>
                                    <input type="text" id="bank_name" name="bank_name">
                                </div>
                                <div class="bank-detail-item">
                                    <label for="branch_name">Branch Name:</label>
                                    <input type="text" id="branch_name" name="branch_name">
                                </div>
                                <div class="bank-detail-item">
                                    <label for="branch_no">Branch No:</label>
                                    <input type="text" id="branch_no" name="branch_no">
                                </div>
                                <div class="bank-detail-item">
                                    <label for="account_no">Account No:</label>
                                    <input type="text" id="account_no" name="account_no">
                                </div>
                                <div class="bank-detail-item">
                                    <label for="account_type">Account Type:</label>
                                    <input type="text" id="account_type" name="account_type">
                                </div>
                                <div class="bank-detail-item">
                                    <label for="account_name">Account Name:</label>
                                    <input type="text" id="account_name" name="account_name">
                                </div>
                            </div> -->


                            <div class="fines-section">
    <h3>Fines:</h3>
    <div class="fine-input">
        <input type="number" id="fine_5_days" name="fine_5_days" placeholder="Fine for First 5 Days">
    </div>
    <div class="fine-input">
        <input type="number" id="fine_10_days" name="fine_10_days" placeholder="Fine for 10 Days">
    </div>
</div>





                    </div>
                </div>


                <!-- <input type="submit" name="submit" value="Generate PDF"> -->
                <input type="submit" name="submit" value="Generate PDF" style="display: block; margin: 0 auto;">

            </form>

        </div>
    </div>

    <script>
function formatDate(date) {
        // Array of month names
        var monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
        
        // Get the day, month, and year from the date object
        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        
        // Format the date as "DD MMM, YYYY"
        var formattedDate = day + " " + monthNames[monthIndex] + ", " + year;
        
        return formattedDate;
    }

    // Function to update the date input value when the user selects a date
    function updateDateInput(inputId) {
        var input = document.getElementById(inputId);
        var selectedDate = new Date(input.value);
        var formattedDate = formatDate(selectedDate);
        input.value = formattedDate;
    }

        function addProduct() {
            var table = document.querySelector(".invoice-table");
            var row = table.insertRow();
            var cells = [];
            for (var i = 0; i < 9; i++) {
                cells.push(row.insertCell());
            }
            cells[0].innerHTML = '<input type="text" name="product_name[]" required>';
            cells[1].innerHTML = '<input type="text" name="mode[]">';
            cells[2].innerHTML = '<input type="text" name="basis[]">';
            cells[3].innerHTML = '<input type="number" step="0.01" name="exchange_rate[]">';
            cells[4].innerHTML = '<input type="number" name="price_usd[]">';
            cells[5].innerHTML = '<input type="number" name="price_jpy[]">';
            cells[6].innerHTML = '<input type="number" name="vat[]">';
            cells[7].innerHTML = '<input type="number" name="quantity[]" required>';
            cells[8].innerHTML = '-';
        }

        function validateForm() {
            var exchangeRates = document.getElementsByName("exchange_rate[]");
            var currencies = document.getElementsByName("currency[]");

            // Validate each exchange rate and currency
            for (var i = 0; i < exchangeRates.length; i++) {
                var exchangeRate = exchangeRates[i].value.trim();
                var currency = currencies[i].value.trim().toUpperCase();

                if (isNaN(exchangeRate) || exchangeRate <= 0) {
                    alert("Please enter a valid exchange rate for product " + (i + 1));
                    return false;
                }

                if (currency !== "JPY" && currency !== "USD") {
                    alert("Please enter either JPY or USD for currency for product " + (i + 1));
                    return false;
                }

                if (currency === "USD" && exchangeRate === "") {
                    alert("Please enter the exchange rate for product " + (i + 1));
                    return false;
                }
            }

            return true; // Form is valid
        }

        function generatePDF() {
          
            var pdfContent = '<h1>Sample PDF Content</h1>';
            document.getElementById('pdf-content').innerHTML = pdfContent;

            // Show the PDF container
            document.getElementById('pdf-container').style.display = 'block';
        }

        function downloadPDF() {
            // Code to download the displayed PDF goes here
            // You can implement this using Blob or other methods supported by the browser
            alert('Download PDF functionality will be implemented here');
        }
    </script>

    <!-- Section to display generated PDF and download button -->
    <div id="pdf-container" style="display: none;">
        <h2>Generated PDF</h2>
        <div id="pdf-content"></div>
        <button onclick="downloadPDF()">Download PDF</button>
    </div>
</body>

</html>