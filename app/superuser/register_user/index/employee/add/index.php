<div class="row">
  <div class="col-12">
    <h5>Input User Info</h5>
    <div class="separator"></div>
    <div class="row">
      <div class="col-md-6 col-sm-6  form-group has-feedback">
        <input type="text" name="id" class="form-control has-feedback-left" placeholder="Id">
        <span class="fa fa-barcode form-control-feedback left"></span>
      </div>
      <div class="col-md-6 col-sm-6  form-group has-feedback">
        <input type="password" name="pass" class="form-control has-feedback-left" placeholder="Pass">
        <span class="fa fa-key form-control-feedback left"></span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6  form-group has-feedback">
        <input type="text" name="id" class="form-control has-feedback-left" placeholder="Name">
        <span class="fa fa-user form-control-feedback left"></span>
      </div>
      <div class="col-md-6 col-sm-6  form-group has-feedback" style="padding-top: 3px;">
        <input type="radio" name="jenis_kelamin" value="Male"> Male<br>
        <input type="radio" name="jenis_kelamin" value="Female"> Female<br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4  form-group has-feedback">
        <select class="cari_user" style="width: 100%;" name="jabatan">
          <option value="" selected disabled>Position</option>
          <option value="Manager">Manager</option>
          <option value="Guest">Guest</option>
          <option value="Leader">Leader</option>
          <option value="Asistant Manager">Asistant Manager</option>
          <option value="Staff">Staff</option>
          <option value="Karyawan Tetap">Karyawan Tetap</option>
        </select>
      </div>
      <div class="col-md-4 col-sm-4  form-group has-feedback">
        <select class="cari_user" style="width: 100%;" name="dept">
          <option value="" selected disabled>Dept</option>
          <option value="Assembly GP">Assembly GP</option>
          <option value="Assembly UP">Assembly UP</option>
          <option value="ICTM">ICTM</option>
          <option value="General">General</option>
          <option value="Painting">Painting</option>
          <option value="Woodworking">Woodworking</option>
          <option value="General Affair">General Affair</option>
        </select>
      </div>
      <div class="col-md-4 col-sm-4  form-group has-feedback">
        <select class="cari_user" style="width: 100%;" name="role">
          <option value="" selected disabled>Role</option>
          <option value="managerial">Managerial</option>
          <option value="pic">PIC</option>
          <option value="guest">Guest</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-12" style="text-align: center;">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>