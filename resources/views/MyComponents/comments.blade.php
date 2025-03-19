<span class="block komentarai">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-lt-tab" data-toggle="pill" href="#custom-tabs-four-lt" role="tab" aria-controls="custom-tabs-four-lt" aria-selected="true">LT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-ru-tab" data-toggle="pill" href="#custom-tabs-four-ru" role="tab" aria-controls="custom-tabs-four-ru" aria-selected="false">RU</a>
              </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <textarea style="width: 80%" rows="5" name="notes_lt" class="tab-pane fade active show" id="custom-tabs-four-lt" role="tabpanel" aria-labelledby="custom-tabs-four-lt-tab">{{isset($data->notes_lt) ? $data->notes_lt : ''}}</textarea>
            <textarea style="width: 80%" rows="5" name="notes_ru"  class="tab-pane fade" id="custom-tabs-four-ru" role="tabpanel" aria-labelledby="custom-tabs-four-ru-tab">{{isset($data->notes_ru) ? $data->notes_ru : ''}}</textarea>
        </div>
    </div>
</span>