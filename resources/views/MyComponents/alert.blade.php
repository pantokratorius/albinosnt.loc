@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Įvykdyda !</strong> {{ session('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Klaida!</strong> {{ session('error') }}
    </div>
@endif


@push('js')
    <script>
        $(function(){
            $('.alert-dismissible').delay(2000).fadeOut()
        })

    </script>
    
@endpush

@push('css')
<style>
    .alert-danger, .alert-success {
        position: absolute;
        right: 10px;
        top: 65px;
    }

</style>
@endpush