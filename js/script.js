$(document).ready(function() {
    
    // display select brands
    $("#search").keyup(function() {
        var search = $(this).val();
        
        $.ajax({
            url: "search.php",
            data: {search: search},
            type: "POST",
            success: function(resultData) {
                $("#result").html(resultData);
            }
        });
    });

    // display all cars
    function updateCars() {
        $.ajax({
            url: "displayCars.php",
            type: "POST",
            success: function(resultCars) {
                $("#show-cars").html(resultCars);
            }
        });
    }

    setInterval(
        function() {
            updateCars();
    }, 1000);
});