<?php
require ('config.php');
$dbconnection = new dbconnection();
$dbconnection->conn;





?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>


<a href="index.php">Back to Main Page</a>
<br><br>

</body>

<?php





// 3 Write the PHP script calculate sum of item quantity and insert all json data in database.

// Takes raw data from the request
$json = file_get_contents('https://apimis.in/api/jsonAPITest.php');

// Converts it into a PHP object
$data = json_decode($json);

$totalQuantity = 0;

foreach ($data->salesDetails as $salesDetail) {
    if (isset($salesDetail->itemDetails) && is_array($salesDetail->itemDetails)) {
        foreach ($salesDetail->itemDetails as $item) {
            if (isset($item->qty)) {
                $totalQuantity += (int) $item->qty; 
            }
        }
    }
}

echo "Total Quantity of Items: " . $totalQuantity . '<br><br>';



$salesDetails = $data->salesDetails; // Assuming $your_data contains the provided stdClass object


// creating table in php myadmin 
    foreach ($salesDetails as $salesDetail) {
        $MasterId = $salesDetail->MasterId;
        $date = date('Y-m-d', strtotime($salesDetail->date));
        $invoice_Number = $salesDetail->invoice_Number;
        $party_Code = $salesDetail->party_Code;
        $party_Name = $salesDetail->party_Name;
        $gst_No = $salesDetail->gst_No;
        $party_group = $salesDetail->party_group;

        // Insert main sales details into a 'sales' table
        $sql_insert_sales = "INSERT INTO sales (MasterId, date, invoice_Number, party_Code, party_Name, gst_No, party_group)
                VALUES ('$MasterId', '$date', '$invoice_Number', '$party_Code', '$party_Name', '$gst_No', '$party_group')";

        // if ($conn->query($sql) !== TRUE) {
            
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }
        if ($dbconnection->conn->query($sql_insert_sales) === TRUE) {
            echo "New record inserted into 'sales' table successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }

        // If there are item details, insert them into an 'items' table 
        if (isset($salesDetail->itemDetails) && is_array($salesDetail->itemDetails)) {
            foreach ($salesDetail->itemDetails as $item) {
                $item_code = $item->item_code;
                $item_Name = $item->item_Name;
                $item_group = $item->item_group;
                $sub_group = $item->sub_group;
                $qty = $item->qty;
                $unit = $item->unit;
                $price_without_gst = $item->price_without_gst;
                $amount_without_gst = $item->amount_without_gst;
                $gst_amount = $item->gst_amount;
                $amount_with_gst = $item->amount_with_gst;

                // Insert item details into 'items' table
                $sql_insert_items = "INSERT INTO items (MasterId, item_code, item_Name, item_group, sub_group, qty, unit, price_without_gst, amount_without_gst, gst_amount, amount_with_gst)
                        VALUES ('$MasterId', '$item_code', '$item_Name', '$item_group', '$sub_group', '$qty', '$unit', '$price_without_gst', '$amount_without_gst', '$gst_amount', '$amount_with_gst')";

                // if ($conn->query($sql) !== TRUE) {
                //     echo "Error: " . $sql . "<br>" . $conn->error;
                // }
                if ($dbconnection->conn->query($sql_insert_items) === TRUE) {
                    echo "New record inserted into 'items' table successfully<br>";
                } else {
                    echo "Error inserting record: " . $conn->error . "<br>";
                }
            }
        }
    }
    
?>

</html>