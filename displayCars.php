<?php

require "includes/init.php";
$db = require "includes/db.php";

$conn = $db->getConn();

$results = Database::getAll($conn);

?>

<?php foreach($results as $indexes=>$row): ?>
    <tr>
        <td><?= htmlspecialchars($row["id"]); ?></td>
        <td><a class="title-link" href="#" data-row-id="<?= htmlspecialchars($row["id"]); ?>"><?= htmlspecialchars($row["title"]); ?></a></td>
    </tr>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
    
        // action-container
        $(".title-link").on("click", function(e) {
            e.preventDefault();

            var id = $(this).data("rowId");

            $.post("process.php", {id: id}, function(data) {
                $("#action-container").html(data);
            });
        });
    });
</script>