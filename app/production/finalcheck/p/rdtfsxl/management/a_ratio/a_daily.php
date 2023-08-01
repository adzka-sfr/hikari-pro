<div class="row">
    <div class="col-12" id="inside">
    </div>
</div>
<div class="row">
    <div class="col-12" id="completeness">
    </div>
</div>
<div class="row">
    <div class="col-12" id="outside">
    </div>
</div>

<script>
    // get data inside
    $.ajax({
        url: "management/a_ratio/chart/d_inside.php",
        type: "POST",
        success: function(data) {
            $('#inside').html(data);
        },
        error: function() {
            lostconnection()
        }
    });

    // get data completeness
    $.ajax({
        url: "management/a_ratio/chart/d_completeness.php",
        type: "POST",
        success: function(data) {
            $('#completeness').html(data);
        },
        error: function() {
            lostconnection()
        }
    });

    // get data outsdie
    $.ajax({
        url: "management/a_ratio/chart/d_outside.php",
        type: "POST",
        success: function(data) {
            $('#outside').html(data);
        },
        error: function() {
            lostconnection()
        }
    });
</script>