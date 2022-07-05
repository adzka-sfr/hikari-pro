
<script>
    $(document).ready(function() {
        load_data();

        function load_data(query = "") {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    query: query,
                },
                success: function(data) {
                    $("#body").html(data);
                },
            });
        }
        $("#multi_search_filter").change(function() {
            $("#hidden_date").val($("#multi_search_filter").val());
            var query = $("#hidden_date").val();
            load_data(query);
        });

        $("#multi_search_filter").change(function() {
            $("#hidden_date").val($("#multi_search_filter").val());
            var query = $("#hidden_date").val();
            load_data(query);
        });
    });
</script>