<div class="row">
    <div class="col-12">
        <h3>Update Plan</h3>
        <div class="separator"></div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <form action="upload" method="post">
            <div class="mb-3">
                <label for="formFileSm" class="form-label"><i>Last update in : Wednesday, 26-08-2022 08:80:00 by Haryanti</i></label>
                <input style="border-radius: 5px;" class="form-control form-control-sm" id="formFileSm" type="file">
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12 " >
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>plan Number</th>
                    <th>FG Code</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Destination</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con_pro, "SELECT * from plan order by tanggal asc");
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?= $data['pln_no'] ?></td>
                        <td><?= $data['fg_code'] ?></td>
                        <td><?= $data['model'] ?></td>
                        <td><?= $data['color'] ?></td>
                        <td><?= $data['destin'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>