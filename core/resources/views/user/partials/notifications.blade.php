@if($errors->any())
    <script>
        $(document).ready(function () {
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}', "Opps!")
            @endforeach
        })
    </script>
@endif
@if(session()->has('success'))
    <script>
        $(document).ready(function () {
            toastr.success('{{ session('success') }}', "Success")
        })
    </script>
@endif
