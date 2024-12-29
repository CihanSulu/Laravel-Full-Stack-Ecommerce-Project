</div>
<!-- Javascript -->
<script src="/assets/bundles/libscripts.bundle.js"></script>
<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/bundles/flotscripts.bundle.js"></script><!-- flot charts Plugin Js -->
<script src="/assets/bundles/c3.bundle.js"></script>
<script src="/assets/bundles/knob.bundle.js"></script><!-- Jquery Knob-->

<script src="/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/js/index11.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="/assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/vendor/summernote/dist/summernote.js"></script>


<script>
    @if(session()->has('tur'))
        iziToast.{{session('tur')}}({
            title: '{{session('title')}}',
            message: '{{session('message')}}',
        });
    @endif

    @if($errors->any()){
        @foreach($errors->all() as $error)
        iziToast.error({
            title: 'Hata',
            message: '{{$error}}',
        });
        @endforeach
    }
    @endif

</script>
