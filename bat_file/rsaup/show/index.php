<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama kabinet</th>
                <th>GMC</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody id="data">

        </tbody>
    </table>

    <script src="jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {
            selesai();
        });

        function selesai() {
            setTimeout(function() {
                update();
                selesai();
            }, 200);
        }

        function update() {
            $.getJSON("data.php", function(data) {
                $("#data").empty();
                var no = 1;
                $.each(data.result, function() {
                    $("#data").append("<tr><td>" + this['updated'] + "</td><td>" + this['nama_panjang'] + "</td><td style='text-align: center;'>" + this['gmc_kabinet'] + "</td><td style='text-align: center;'>" + this['qty'] + "</td></tr>");
                    no++;
                });
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>