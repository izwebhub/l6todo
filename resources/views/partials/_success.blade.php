@if(session()->has('success'))
<div class="alert alert-success flush">
    <i class="fa fa-check"></i> {{session()->get('success')}}
</div>
@endif

<!-- jQuery -->
<script src="{{url('statistics/vendors/jquery/dist/jquery.min.js')}}"></script>
<script>
    $(function() {
        $('.flush').delay(5000).fadeOut();
    });
</script>