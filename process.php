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
    <input type="text" class="form-control"
        id="title-input" value="<?= $car[0]["title"]; ?>"
        data-row-id="<?= $car[0]["id"]; ?>">

    <button class="btn btn-success" id="update-record">Update</button>
    <button class="btn btn-danger" id="delete-record">Delete</button>
    <button class="btn btn-close" id="close-record"></button>
<?php endif; ?>

<?php

if (isset($_POST["updatethis"])) {
    $updaedCar = Database::updateRecord($conn, $_POST["id"], $_POST["title"]);
}

if (isset($_POST["deletethis"])) {
    $deleteCar = Database::deleteRecord($conn, $_POST["id"]);
}

?>

<script>
    $(document).ready(function() {

        // extract id, title for update and delete
        var id = $("#title-input").data("rowId");
        var title = $("#title-input").val();

        // update button functionality
        $("#title-input").on("input", function() {
            title = $("#title-input").val();
        });

        $("#update-record").on("click", function() {
            $.post("process.php", {
                id: id,
                title: title,
                updatethis: "updatethis"
            }, function(data) {
                $("#feedback").text("Record updated successfully.");
            });
        });

        // delete button functionality
        $("#delete-record").on("click", function() {
            if(confirm("Are you sure you want to delete this record")) {
                $.post("process.php", {
                    id: id,
                    deletethis: "deletethis"
                }, function(data) {
                    if(data) {
                        $("#feedback").text("Record deleted.");
                        $("#action-container").hide();
                    }
                });
            }
        });

        // close functionality
        $("#close-record").on("click", function() {
            $("#action-container").hide();
        });
    });
</script>