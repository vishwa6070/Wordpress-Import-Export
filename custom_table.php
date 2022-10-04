<?php

use function PHPSTORM_META\type;

require_once(ABSPATH . "wp-admin/includes/class-wp-list-table.php");

class Import_Data extends WP_List_Table
{


    public function prepare_items()
    {
        $datas = $this->list_table_data();
        $this->items = $datas;
        $columns = $this->get_columns();
        $this->_column_headers = array($columns);
    }
    public function get_columns()
    {
        $columns = array(
            "cb" => "<input type='checkox' class=''/>",
            "ID" => "ID",
            "first_name" => "First Name",
            "last_name" => "Last name",
            "address" => "Address",
            "phone_no" => "Phone"
        );
        return $columns;
    }

    public function column_default($item, $columns)
    {
        // echo"<pre>";
        // print_r($item);
        // print_r($item->ID);
        switch ($columns) {
            case 'ID':
                return $item->ID;
                break;
            case 'first_name':
                return $item->first_name;
                break;
            case 'last_name':
                return $item->last_name;
                break;
            case 'address':
                return $item->address;
                break;
            case 'phone_no':
                return $item->phone_no;
                break;
            default:
                return "No List Found Value";
        }
    }

    public function list_table_data()
    {
        global $wpdb;
        $all_datas = $wpdb->get_results("SELECT * FROM `wp_import_data`");
        return  $all_datas;
    }
    public function column_cb($items)
    {

        $top_checkbox = '<input type="checkbox" class="clt-selected" />';
        return $top_checkbox;
    }
}

?>

<body>
    <div class="container">
        <h1 align="center">Import Data from Custom Table </h1>
        <br />
        <div class="panel-heading">
            <h3 class="panel-title">Import CSV File</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action='<?= $_SERVER['REQUEST_URI']; ?>' enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-4 control-label">Select CSV File</label>
                    <input type="file" name="import_file" />
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="import" id="import" value="Import" />
                    <input type="submit" name="export" id="export" value="Export" />
                </div>
            </form>
        </div>
    </div>
</body>

<?php

/*
csv import code
*/

if (isset($_POST['import'])) {

    global $wpdb;

    $extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);

    if (!empty($_FILES['import_file']['name']) && $extension == 'csv') {

        $totalInserted = 0;

        $csvFile = fopen($_FILES['import_file']['tmp_name'], 'r');

        fgetcsv($csvFile);

        while (($csvData = fgetcsv($csvFile)) !== FALSE) {
            $csvData = array_map("utf8_encode", $csvData);

            $dataLen = count($csvData);

            $first_name = trim($csvData[0]);
            $last_name = trim($csvData[1]);
            $address = trim($csvData[2]);
            $phone_no = trim($csvData[3]);

            $cntSQL = "SELECT count(*) as count FROM `wp_import_data` where `first_name` ='" . $first_name . "'";

            $record = $wpdb->get_results($cntSQL, OBJECT);

            if ($record[0]->count == 0) {

                $wpdb->insert('wp_import_data', array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'address' => $address,
                    'phone_no' => $phone_no,
                ));

                if ($wpdb->insert_id > 0) {
                    $totalInserted++;
                }
            }
        }
        echo "<h3 style='color: green;'>Total record Inserted : " . $totalInserted . "</h3>";
    } else {
        echo "<h3 style='color: red;'>Invalid Extension</h3>";
    }
}

/*
csv export code
*/

global $wpdb;
if (isset($_POST["export"])) {
    $filename = 'test';
    $date = date("Y-m-d H:i:s");
    $output = fopen('php://output', 'w');
    $result = $wpdb->get_results('SELECT * FROM `wp_import_data`', ARRAY_A);
    fputcsv($output, array('ID', 'Title', ' Date'));
    foreach ($result as $key => $value) {
        $modified_values = array(
            $value['ID'],
            $value['first_name'],
            $value['last_name'],
            $value['address'],
            $value['phone_no'],
        );
        fputcsv($output, $modified_values);
    }
    // header("Pragma: public");
    // header("Expires: 0");
    // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    // header("Cache-Control: private", false);
    // header('Content-Type: text/csv; charset=utf-8');
    // // header("Content-Type: application/octet-stream");
    // header("Content-Disposition: attachment; filename=\"" . $filename . " " . $date . ".csv\";");
    // // header('Content-Disposition: attachment; filename=lunchbox_orders.csv');
    // header("Content-Transfer-Encoding: binary");
    exit;
}
?>

<?php

/*
wp_listtable_stu
*/

function data_list_table()
{
    $table = new Import_Data();
    $table->prepare_items();
    $table->display();
}
data_list_table();
