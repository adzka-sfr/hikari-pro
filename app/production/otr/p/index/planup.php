<div class="row">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <h2>Customize Plan QTY UP (U200)</h2>
                    <div class="separator"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-bottom: 5px; text-align: right;">
                    <label for="info" style="font-size: 11px; color: blue;  margin: 0px; margin-left: 5px;"><u><i><b><a href="#" onclick="all2o()">File format download here</a></b></i></u></label>
                </div>
                <script>
                    var myWindow;

                    function all2o() {
                        myWindow = window.open("format_up.php", "_blank");
                        setTimeout(all2c, 2000)
                    }

                    function all2c() {
                        myWindow.close();
                    }
                </script>
            </div>
            <div class="row">
                <div class="col-12">
                    <input style="border-radius: 5px;" name="filemhsw" class="form-control form-control-sm" id="formFileSm" type="file">
                </div>
            </div>
            <div class="row" style="margin-top: 10px; text-align: right;">
                <div class="col-12">
                    <button style="width: 90px;" type="submit" name="submit" class="btn btn-success btn-sm">Upload</button>
                </div>
            </div>
            <div class="row" style="margin-top:10px; margin-bottom: 10px;">
                <div class="col-5">
                    <div class="separator"></div>
                </div>
                <div class="col-2" style="text-align: center;">
                    <span>or</span>
                </div>
                <div class="col-5">
                    <div class="separator"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input style="border-radius: 5px;" type="date" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Plan Date">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input style="border-radius: 5px;" type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Plan Qty">
                        <span class="fa fa-dashboard form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;text-align: right;">
                <div class="col-12">
                    <button style="width: 90px;" type="submit" name="submit" class="btn btn-success btn-sm">Insert</button>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <h2>Customize Target</h2>
                    <div class="separator"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label for="fullname">Last Month</label>
                    <input style="text-align: center; border-radius: 5px;" type="text" id="fullname" class="form-control" name="fullname" value="50%" readonly />
                </div>
                <div class="col-4">
                    <label for="fullname">This Month</label>
                    <input style="text-align: center; border-radius: 5px;" type="text" id="fullname" class="form-control" name="fullname" value="60%" readonly />
                </div>
                <div class="col-4">
                    <label for="fullname">Next Month</label>
                    <input style="text-align: center; border-radius: 5px;" type="text" id="fullname" class="form-control" name="fullname" value="80%" readonly />
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-12">
                    <!-- <div class="form-group row"> -->
                    <!-- <label class="control-label col-md-3 col-sm-3 ">Select</label> -->
                    <div class="col-md-12 col-sm-12 ">
                        <select id="cari_nosearch" style="border-radius: 5px;">
                            <option selected disabled>Choose option</option>
                            <option>This Month</option>
                            <option>Next Month</option>
                        </select>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-12">
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input style="border-radius: 5px;" type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Work Center">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tab file -->
<!-- <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Summary</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <h2>halaman1</h2>

                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <h2>halaman2</h2>

                            </div>

                        </div>
                    </div> -->
<!-- tab file -->