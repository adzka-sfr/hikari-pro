<a href="#" class="btn btn-warning btn btn-md" data-toggle="modal" data-target="#myModal<?php echo $no ?>"><i class="fa fa-recycle"></i></a>




<div class="modal fade" id="myModal<?php echo $no ?>" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update NG Cabinet</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="ngubah.php">
                    <input type="hidden" name="gmc" value="<?= $roww['gmc_c'] ?>">
                    <div class="form-group row">
                        <label for="kabinet" style="text-align: left;" class=" col-sm-5 col-form-label">Cabinet</label>
                        <div class="col-sm-7">
                            <input style="border-radius: 0.25rem; text-align: left " type="text" name="name_cabinet" class="form-control" value="<?= $roww['name_cabinet'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <label for="ng" style="text-align: left;" class="col-sm-5 col-form-label">Status Update</label>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-auto mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ng" value="notgood" id="notgoodd<?= $no  ?>" required>
                                        <label class="form-check-label" for="notgoodd<?= $no  ?>">Not Good</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ng" value="repair" id="repair<?= $no  ?>" required>
                                        <label class="form-check-label" for="repair<?= $no  ?>">Repair</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" style="text-align: left;" class=" col-sm-5 col-form-label">Quantity</label>
                        <div class="col-sm-7">
                            <input type="number" style="border-radius: 0.25rem; text-align: center;" name="qty" min="1" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" data-target="ngubah.php" name="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>