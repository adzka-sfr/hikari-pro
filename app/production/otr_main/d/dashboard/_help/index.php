<div class="x_panel">
    <div class="x_title">
        <h3>Help</h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="row">
            <div class="col-md-12">
                <!-- SESSION di create pada saat index menentukan dia sudah deploy apa develop -->
                <object data="<?= base_url('app/pdf_manual/' . $_SESSION['manual'] . '.pdf') ?>" type="application/pdf" width="100%" height="800"></object>
            </div>
        </div>

    </div>
</div>