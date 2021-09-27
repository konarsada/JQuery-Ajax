<?php

require "includes/init.php";
$db = require "includes/db.php";

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $conn = $db->getConn();
    $car = Database::getById($conn, $id);
}

?>

<?php if (isset($car) && $car) : ?>
    <input type="text" class="form-control" id="title-input"
        value="<?= $car[0]["title"]; ?>"
        data-row-id="<?= $car[0]["id"]; ?>">

    <button class="btn btn-success" id="update-record">Update</button>
    <button class="btn btn-danger" id="delete-record">Delete</button>
<?php endif; ?>

<?php

if(isset($_POST["id"]) && isset($_POST["title"])) {

    $updaedCar = Database::updateRecord($conn, $id, $_POST["title"]);
}

?>

<script>
    $(document).ready(function() {

        // extract id, title for update and delete
        var id = $("#title-input").data("rowId");
        var title = $("#title-input").val();

        $("#title-input").on("input", function() {
            title = $("#title-input").val();
        })

        $("#update-record").on("click", function() {
            $.post("process.php", {id: id, title: title}, function(data) {
                $("#feedback").text("Record updated successfully.");
            })
        })
    });
</script>