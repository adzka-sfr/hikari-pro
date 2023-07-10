<div class="row">
    <div class="col-12">
        <h5>Repair Inside</h5>
        <hr>
    </div>
</div>
<script src="../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
<script src="../source/dropdown_search/select2.min.js"></script>
<script src="../source/sweetalert2/dist/sweetalert2.all.min.js"></script>
<div class="row">
    <div class="col-12">
        <div id="tabele"></div>
    </div>
</div>

<script>
    $('#tabele').load('repairinside/data.php').fadeIn("slow");

    function load_data() {
        $('#tabele').load('repairinside/data.php').fadeIn("slow");
    }

    auto_refresh = setInterval(load_data, 5000);

    function btnPrint(id, serialnumber) {
        clearInterval(auto_refresh);
        console.log(id);

        $.ajax({
            url: 'repairinside/data1.php',
            type: 'POST',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 'OK') {
                    window.open("repairinside/print.php", "_self");
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        html: 'Silahkan coba lagi nanti',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke',
                        cancelButtonText: 'Tidak'
                    })
                }

            }
        });
    }

    function btnPrint1(id, serialnumber) {
        clearInterval(auto_refresh);
        console.log(id);

        $.ajax({
            url: 'repairinside/data1.php',
            type: 'POST',
            data: {
                "serialnumber": serialnumber
            },
            success: function(response) {
                var response = JSON.parse(response);
                if (response.status == 'OK') {
                    window.open("repairinside/print1.php", "_self");
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        icon: 'error',
                        html: 'Silahkan coba lagi nanti',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke',
                        cancelButtonText: 'Tidak'
                    })
                }

            }
        });
    }
</script>