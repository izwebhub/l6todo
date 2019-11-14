@if(session()->has('complete'))
<div class="alert alert-success flush">
    <i class="fa fa-check"></i> {{session()->get('complete')}}
</div>
@endif

<!-- jQuery -->
<script src="{{url('jquery/dist/jquery.min.js')}}"></script>
<script>
    $(function() {
        $('.flush').delay(5000).fadeOut();
    });
</script>