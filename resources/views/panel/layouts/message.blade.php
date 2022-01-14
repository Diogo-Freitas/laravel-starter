@if (Session::has('success'))
    <div class="alert bg-success text-white fade show">
        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
        <span><i class="icon fas fa-check"></i> {!! Session::get('success') !!}</span>
    </div><!-- .alert -->
@endif
@if (Session::has('error'))
    <div class="alert bg-danger text-white fade show" role="alert">
        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
        <span><i class="icon icon fas fa-ban"></i> {!! Session::get('error') !!}</span>
    </div><!-- .alert -->
@endif
@if (Session::has('warning'))
    <div class="alert bg-warning text-white fade show" role="alert">
        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
        <span><i class="fas fa-exclamation-triangle"></i> {!! Session::get('warning') !!}</span>
    </div><!-- .alert -->
@endif
@if (Session::has('info'))
    <div class="alert bg-info text-white fade show" role="alert">
        <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
        <span><i class="fas fa-info"></i> {!! Session::get('info') !!}</span>
    </div><!-- .alert -->
@endif