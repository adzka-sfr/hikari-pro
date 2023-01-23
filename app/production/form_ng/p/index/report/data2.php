    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="ng-tab" data-toggle="tab" href="#ng" role="tab" aria-controls="ng" aria-selected="true">Inside Check</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cabinet-tab" data-toggle="tab" href="#cabinet" role="tab" aria-controls="cabinet" aria-selected="false">Completeness Check</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dept-tab" data-toggle="tab" href="#dept" role="tab" aria-controls="dept" aria-selected="false">Outside Check</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ng" role="tabpanel" aria-labelledby="ng-tab">
            <?php include 'data/process-inside.php' ?>
        </div>
        <div class="tab-pane fade" id="cabinet" role="tabpanel" aria-labelledby="cabinet-tab">
            <?php include 'data/process-complete.php' ?>
        </div>
        <div class="tab-pane fade" id="dept" role="tabpanel" aria-labelledby="dept-tab">
            <?php include 'data/process-outside.php' ?>
        </div>
    </div>