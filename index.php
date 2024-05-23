<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/vendor/autoload.php';

    // Create PDF invoice
    $mpdf = new \Mpdf\Mpdf();



    $invoice_date = date_format(date_create($_POST["date"]), 'd M, Y');
    $due_date = date_format(date_create($_POST["due_date"]), 'd M, Y');
    // Start PDF HTML content with CSS styles
    $html = '
        <style>
         


        body {
            font-family: Arial, sans-serif;
                font-size: 10px;
                line-height: 1.2;
                background-image: url("vendor/bg.png");
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
                width: 150px;
                height: 150px;

            
            }

            p { margin:1;
                            font-family: "JapaneseFont", Arial, sans-serif;
 }


            .header {
                text-align: center;
                margin-bottom: 8px;
            }

            .header img {
                max-width: 150px;
                margin-bottom: 10px;
            }

            .header h2 {
                margin: 0;
                font-size: 18px;
            }

            .header p {
                margin: 5px 0;
                font-size: 12px;
            }

            .invoice-details {
                margin-bottom: 10px;
            }

            .invoice-details p {
                margin: 5px 0;
            }

            .information-section {
                margin-bottom: 20px;
            }

            .information-section h3 {
                margin-top: 0;
                background-color: navy;
                color: #fff;
                padding: 5px 10px;
                display: inline-block;
            }

            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            .invoice-table th,
            .invoice-table td {
                padding: 4px;
                border: 1px solid black;
                text-align: left;
            }

            .invoice-table th {
                background-color: navy;
                color: #fff;
            }

            .invoice-table th:first-child,
    .invoice-table td:first-child {
        width: 25%; /* Adjust the width as needed */
    }
            

            .payment-information {
                float: right;
                margin-top: 0px;
            }

            .payment-information h4 {
                margin-top: 0;
            }

            .total-row td {
                background-color: navy;
                color: #fff;
                font-weight: bold;
            }

            .left-column {
                float: left;
                width: 35%;
            }

            .middle-column {
                float: left;
                width: 30%;
                text-align: center;
            }

            .right-column {
                float: left;
                width: 35%;
                text-align: right;
            }

            .address, .payable-to {
                background-color: navy;
                color: #fff;
                padding: 10px;
                margin-bottom: 10px;
            }

            .order-details-header {
                background-color: navy;
                color: #fff;
                border: 1px solid #000;
            }

            .order-details-column {
                float: left;
                width: 50%;
            }

            .order-details-column p {
            }

            .bordered-section {
                border: 1px solid #000;
                padding: 5px;
                margin-bottom: 5px;
            }
            .bank-information {
                border: 1px solid #000;
                padding: 10px;
                font-size: 10px;
            }
        </style>
        <body>
            <!-- PDF content starts here -->
        
           
            <div class="information-section">
                <div class="left-column">
                    
                    <p ><b>DESAI INTERNATIONAL TRADING CO.,LTD</b>
                    <b>Address:</b> IBARAKI-KEN, YUKISHI,YUKI 752-4</p>
                    <p ><b>ZIP Code: </b>307-000</p>
                    <p ><b>REG No:</b>T6-0600-01102-8574</p>
                    <h3>Invoice To:</h3>
                    <p style="margin-bottom: 1px;">Company Name: ' . $_POST["client_name"] . '</p>
                    <p style="margin-bottom: 2px;">Address: ' . $_POST["client_address"] . '</p>  
                    <p>TEL: ' . $_POST["client_tel"] . ' <br> EMAIL: ' . $_POST["client_email"] . ' </p>
                </div>
                <div class="middle-column">
                    <img src="vendor/logo.png" alt="Company Logo" width="120" height="120">

                </div>
                <div class="right-column">
                    <p><b>TEL:</b> 080-3606-8432</p>
                    <p><b>EMAIL:</b> Desailinternationaltrading@gmail.com</p>
                    <p><b>Invoice No:<b> ' . $_POST["invoice_no"] . '</p>
                    <p><b>Invoice Date:<b> ' . $invoice_date . '</p>
                    <h3>Payable To:</h3>
                    <p>DESAI INTERNATIONAL TRADING CO.,LTD</p>
                    <p>Address: IBARAKI-KEN, YUKISHI,YUKI 752-4</p>
                    <p>ZIP Code: 307-000</p>
                    <p>TEL:080-3606-8432</p>
                    <p>REG No:T6-0600-01102-8574</p>
                    
                </div>
                <div style="clear: both;"></div>
            </div>
            <div style="clear: both;"></div>
            <div class="bordered-section">
                <h3 style="background-color: navy; color: #fff; text-align:center; padding: 2px;">Order Details:</h3>

                <div class="order-details-column">
                <p>Booking: ' . $_POST["booking"] . '</p>
                <p>Carrier: ' . $_POST["carrier"] . '</p>
                <p>POL-POD: ' . $_POST["pol_pod"] . '</p>
                <p>Vessel Voyage: ' . $_POST["vessel_voyage"] . '</p>
                <p>ETD-ETA: ' . $_POST["etd_eta"] . '</p>
            </div>
            <div class="order-details-column">
                <p>Package: ' . $_POST["package"] . '</p>
                <p>Commodity: ' . $_POST["commodity"] . '</p>
                <p>Cargo Mode: ' . $_POST["cargo_mode"] . '</p>
                <p>Size: ' . $_POST["size"] . '</p>
            </div>
            <div style="clear: both;"></div>
                <div style="clear: both;"></div>
            </div>
            <table class="invoice-table">
            <tr>
            <th style="width: 40%;text-align: center;">Description</th>
            <th style="width: 5%;text-align: center;">Mode</th>
            <th style="width: 5%;text-align: center;">Basis</th>
            <th style="width: 10%;text-align: center;">Exchange rate</th>
            <th style="width: 10%;text-align: center;">USD</th>
            <th style="width: 10%;text-align: center;">JPY</th>
            <th style="width: 5%;text-align: center;">VAT %</th>
            <th style="width: 5%;text-align: center;">QTY</th>
            <th style="width: 10%;text-align: center;">Total JPY</th>
        </tr>
    ';

    // Variables to store total amounts
    $total_jpy_sum = 0;
    $total_vat = 0;

    // Loop through each product
    for ($i = 0; $i < count($_POST['product_name']); $i++) {
        // Get form inputs for the current product
        $product_name = $_POST["product_name"][$i];
        $mode = $_POST["mode"][$i];
        $basis = $_POST["basis"][$i];
        $exchange_rate = $_POST["exchange_rate"][$i];
        $price_usd = $_POST["price_usd"][$i];
        $price_jpy = $_POST["price_jpy"][$i];
        $vat = $_POST["vat"][$i];
        $quantity = $_POST["quantity"][$i];

        // Ensure numeric values
        $price_usd = is_numeric($price_usd) ? $price_usd : 0;
        $price_jpy = is_numeric($price_jpy) ? $price_jpy : 0;
        $vat = is_numeric($vat) ? $vat : 0;
        $quantity = is_numeric($quantity) ? $quantity : 0;

        // Calculate total price in JPY
        if ($price_usd != 0 && $exchange_rate != 0) {
            $price_jpy = $price_usd * floatval($exchange_rate);
        }
        $total_jpy = $price_jpy * $quantity;
        $total_jpy_sum += $total_jpy;

        // Calculate total VAT
        $total_vat += $total_jpy * ($vat / 100);

        // Check if VAT is greater than 0, then add JPY price to the total taxable amount
        if ($vat > 0) {
            $total_taxable_amount += $total_jpy;
        }

        // Append row to HTML table
        $html .= '
                <tr>
                    <td style="width: 30%;">' . $product_name . '</td>
                    <td>' . $mode . '</td>
                    <td>' . $basis . '</td>
                    <td>' . $exchange_rate . '</td>
                    <td>' . ($price_usd != 0 ? $price_usd : '-') . '</td>
                    <td>' . ($price_jpy != 0 ? $price_jpy : '-') . '</td>
                    <td>' . ($vat != 0 ? $vat : '-') . '</td>
                    <td>' . $quantity . '</td>
                    <td>' . $total_jpy . '</td>
                </tr>
        ';
    }

    // Calculate Total Including Tax and Total Excluding Tax
    $total_including_tax = $total_jpy_sum + $total_vat;
    $total_excluding_tax = $total_including_tax - $total_vat;

    // Add total rows
    $html .= '
            <tr>
                <td colspan="5"></td>
                <td colspan="3">Total Taxable Amount</td>
                <td >¥ ' . $total_taxable_amount . '</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td colspan="3">Total VAT</td>
                <td>¥ ' . $total_vat . '</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td colspan="3">Total Including Tax</td>
                <td>¥ ' . $total_including_tax . '</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td colspan="3">Total Excluding Tax</td>
                <td>¥ ' . $total_excluding_tax . '</td>
            </tr>
            <tr class="total-row">
                <td colspan="5"></td>
                <td colspan="4" style="text-align: right;">Total Amount: ¥ ' . $total_jpy_sum . '</td>
            </tr>
        </table>
        <div class="payment-information">
            <div style="background-color: navy; color: #fff;">   
                <div style="float: right; padding: 2px; font-size: 10px;">
                    <h3 style="padding: 2; text-align:center;">Total Amount: ¥ ' . $total_jpy_sum . '</h3>
                    <h3 style=" text-align:center;">Payable by: ' . $due_date . '</h3>
                </div>
            </div>
            &nbsp;

            
            <div class="bank-information">
            <h3 style="background-color: navy; color: #fff; text-align:center; padding: 2px;">BANK INFORMATION</h3>
            <div style="padding: 15px; font-size: 10px;">
                <div style="float: left; width: 40%;">

                <img src="vendor/jpaddress.png" alt="jp-address" >

             

                </div>
                <div style="float: left; width: 20%;">
              <p>    </p>
                 </div>
               
                <div class="bank-details-column" style="float: left; width: 40%;">
                <img src="vendor/enaddress.png" alt="en-address" >


        </div>
        <div style="clear: both;"></div>
            </div>
        </div>
        <br>
        <p><b> Note:</b> Please pay the total amount within 7 days of ETD, or else a late payment penaity will be applicable below:
            First five days JPY ' . ($_POST["fine_5_days"] ?? '') . '
            10 days IPY ' . ($_POST["fine_10_days"] ?? '') . ' weekty untit the shipment is refeased.</p>

        </div>
    </body>
    ';

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output PDF for download
    $mpdf->Output('invoice.pdf', 'D');
    exit;
}
?>


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