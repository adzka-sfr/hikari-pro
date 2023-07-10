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
        <!-- <table class="table table-bordered" style="font-size: large;">
            <thead style="text-align: center;">
                <th style="width: 20%;">Serial Number</th>
                <th style="width: 15%;">Checker</th>
                <th style="width: 40%;">Status</th>
                <th style="width: 25%;">PIC Repair</th>
            </thead>
            <tbody>
                <tr>
                    <td>J40505536</td>
                    <td><button class="btn btn-primary" style="width: 100%; font-weight: bold;" id="1" onclick="btnPrint(this.id)">Print</button></td>
                    <td style="text-align: center;">-</td>
                </tr>
                <tr>
                    <td>J40505536</td>
                    <td><button disabled class="btn btn-warning" style="width: 100%; font-weight: bold;" id="2">On Repair</button></td>
                    <td style="text-align: center;">Warsito</td>
                </tr>
            </tbody>
        </table> -->
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
        // clearInterval(auto_refresh);
        // Swal.fire({
        //     title: 'Print hasil incheck?',
        //     text: "Anda akan ditetapkan sebagai PIC dari piano dengan no seri tersebut",
        //     icon: 'question',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, print it!'
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         Swal.fire({
        //             title: 'Success!',
        //             text: "Data berhasil diprint",
        //             icon: 'success',
        //             showCancelButton: false,
        //             confirmButtonColor: '#3085d6',
        //             confirmButtonText: 'OK'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 auto_refresh = setInterval(load_data, 5000);
        //             }
        //         });
        //     }
        // })
    }
</script>