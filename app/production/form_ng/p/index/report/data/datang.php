<ul class="nav nav-tabs bar_tabs" id="myTabng" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="outside-tab" data-toggle="tab" href="#outside" role="tab" aria-controls="outside" aria-selected="true">Outside</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="inside-tab" data-toggle="tab" href="#inside" role="tab" aria-controls="inside" aria-selected="false">Inside</a>
    </li>
</ul>

<div class="tab-content" id="myTabContentng">
    <div class="tab-pane fade show active" id="outside" role="tabpanel" aria-labelledby="outside-tab">
        <?php include 'data/datang-outside.php' ?>
    </div>
    <div class="tab-pane fade" id="inside" role="tabpanel" aria-labelledby="inside-tab">
        <?php include 'data/datang-inside.php' ?>
    </div>
</div>