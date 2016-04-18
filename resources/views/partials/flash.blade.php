@if (Session::has('flash_message'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal({
                title: "{{ session('flash_message.title') }}",
                text: "{{ session('flash_message.text') }}",
                type: "{{ session('flash_message.type') }}",
                timer: 1700,
                showConfirmButton: false
            });
        });
    </script>
@endif

@if (Session::has('flash_overlay'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal({
                title: "{{ session('flash_overlay.title') }}",
                text: "{{ session('flash_overlay.text') }}",
                type: "{{ session('flash_overlay.type') }}",
                confirmButtonText: "Ok"
            });
        });
    </script>
@endif

@if (Session::has('flash_custom'))
    <script type="text/javascript">
        $(document).ready(function(){
            swal({
                title: "{{ session('flash_custom.title') }}",
                text: "{{ session('flash_custom.text') }}",
                imageUrl: "{{ session('flash_custom.imageUrl') }}"
            });
        });
    </script>
@endif

