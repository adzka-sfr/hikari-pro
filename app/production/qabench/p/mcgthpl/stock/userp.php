<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <h5>User Package Stock</h5>
            </div>
            <div class="col-4" style="text-align: right;">
                <a href="main.php?page=adjust-userp"><button class="btn btn-sm btn-warning">Adjust</button></a>
                <a href="main.php?page=log-userp"><button class="btn btn-sm btn-info">Log</button></a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="card">
            <h5 class="card-header">UP Stock</h5>
            <div class="card-body">
                <h2 id="upstock" style="font-size: 50px; text-align: center;">
                    <svg class="spinner" width="30px" height="30px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h2>
                <!-- <p class="card-text">Show detail</p> -->
                <a href="main.php?page=st-userp-stckup">Show detail</a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <h5 class="card-header">UP Today Used</h5>
            <div class="card-body">
                <h2 id="uptod" style="font-size: 50px; text-align: center;">
                    <svg class="spinner" width="30px" height="30px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h2>
                <!-- <p class="card-text">Show detail</p> -->
                <a href="main.php?page=st-userp-tousedup">Show detail</a>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <h5 class="card-header">UP All Time Used</h5>
            <div class="card-body">
                <h2 id="upall" style="font-size: 50px; text-align: center;">
                    <svg class="spinner" width="30px" height="30px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h2>
                <!-- <p class="card-text">Show detail</p> -->
                <a href="main.php?page=st-userp-alltimup">Show detail</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-3">
        <div class="card">
            <h5 class="card-header">GP Stock</h5>
            <div class="card-body">
                <h2 id="gpstock" style="font-size: 50px; text-align: center;">
                    <svg class="spinner" width="30px" height="30px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h2>
                <!-- <p class="card-text">Show detail</p> -->
                <a href="main.php?page=st-userp-stckgp">Show detail</a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <h5 class="card-header">GP Today Used</h5>
            <div class="card-body">
                <h2 id="gptod" style="font-size: 50px; text-align: center;">
                    <svg class="spinner" width="30px" height="30px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h2>
                <!-- <p class="card-text">Show detail</p> -->
                <a href="main.php?page=st-userp-tousedgp">Show detail</a>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <h5 class="card-header">GP All Time Used</h5>
            <div class="card-body">
                <h2 id="gpall" style="font-size: 50px; text-align: center;">
                    <svg class="spinner" width="30px" height="30px" viewBox="0 0 66 66">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </h2>
                <!-- <p class="card-text">Show detail</p> -->
                <a href="main.php?page=st-userp-alltimgp">Show detail</a>
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(ajaxCall, 2000);

    function ajaxCall() {
        $.ajax({
            url: 'stock/getstock2.php',
            success: function(response) {
                var response = JSON.parse(response);
                $('#upstock').html(response.upstock);
                $('#gpstock').html(response.gpstock);
                $('#uptod').html(response.uptod);
                $('#gptod').html(response.gptod);
                $('#upall').html(response.upall);
                $('#gpall').html(response.gpall);
            }
        });
    }
</script>