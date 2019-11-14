@if(session()->has('error'))
<div class="alert alert-danger flush">
    <i class="fa fa-check"></i> {{session()->get('success')}}
</div>
@endif

<!-- jQuery -->
<script src="{{url('jquery/dist/jquery.min.js')}}"></script>
<script>
    $(function() {
        $('.flush').delay(5000).fadeOut();
    });
</script>