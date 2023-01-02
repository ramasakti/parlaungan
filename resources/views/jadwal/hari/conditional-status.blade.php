@if ($jadwal->status == 'H')
    <span class="uk-label uk-label-success">Hadir</span>
@elseif ($jadwal->status == '')
    
@else
    <span class="uk-label uk-label-warning">Inval</span>
    <div class="uk-card uk-card-body uk-card-default uk-padding-small" uk-drop="pos: bottom-center">Diinval oleh</div>
@endif