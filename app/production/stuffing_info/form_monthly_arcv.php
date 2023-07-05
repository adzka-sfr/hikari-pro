<form id="form_arcv" name="form_arcv" action = "" class="form-horizontal form-label-left">
<div class="row" style="padding-left: 50px;">
                              
<label>Select Month Year Archive</label>


<div class="col-md-2 col-sm-2 col-xs-12">
<select class="form-control"  name='Bmonth' id='Bmonth' required>
<option value=''></option>
<option value='01'>January</option>
<option value='02'>February </option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
</div>


<div class="col-md-2 col-sm-2 col-xs-12">
<select name="year" id="year" class="form-control" required>
<option value=''></option>
<?php
for($i=-1;$i<=0;$i++){
$year=date('Y',strtotime("last day of +$i year"));
?>
<option value='<?php echo $year;?>'><?php echo $year;?></option>
<?php
}
?>
</select>
</div>


<div class="col-md-2 col-sm-2 col-xs-12">
<button type="submit" class="btn btn-success">
Submit
</button>
</div>

</div>
</form>

<div class = "ln_solid"></div>
<div class="clearfix"></div>
<div id="get_stuffing_arcv"></div>


<script>
    $("#form_arcv").submit(function (event) {

    var formData = {
    month: $("#Bmonth").val(),
    year : $("#year").val()
    };

    $.ajax({
    type: "POST",
    url: "r_stuffing_dashboard_montly_arcv.php",
    data: formData,
    success: function(data){
                $("#get_stuffing_arcv").html(data);
            }
    });

    event.preventDefault();
    });
</script>