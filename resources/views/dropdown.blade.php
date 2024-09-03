<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel AJAX Dependent Division District Upazila Union Dropdown Example</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-primary mb-4 text-center">
                    <h4>Laravel AJAX Dependent Division District Upazila Union Dropdown Example</h4>
                </div>
                <form action="{{ route('submit') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <select name="division" id="division-dropdown" class="form-control">
                            <option value="">-- Select Division --</option>
                            @foreach ($divisions as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select name="district" id="district-dropdown" class="form-control">
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select name="upazila" id="upazila-dropdown" class="form-control">
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <select name="union" id="union-dropdown" class="form-control">
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Division Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#division-dropdown').on('change', function() {
                var idDivision = this.value;
                $("#district-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-districts') }}",
                    type: "POST",
                    data: {
                        division_id: idDivision,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#district-dropdown').html(
                            '<option value="">-- Select District --</option>');
                        $.each(result.districts, function(key, value) {
                            $("#district-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#upazila-dropdown').html(
                            '<option value="">-- Select Upazila --</option>');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            District Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#district-dropdown').on('change', function() {
                var idDistrict = this.value;
                $("#upazila-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-upazilas') }}",
                    type: "POST",
                    data: {
                        district_id: idDistrict,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#upazila-dropdown').html(
                            '<option value="">-- Select Upazila --</option>');
                        $.each(res.upazilas, function(key, value) {
                            $("#upazila-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            Upazila Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#upazila-dropdown').on('change', function() {
                var idUpazila = this.value;
                $("#union-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-unions') }}",
                    type: "POST",
                    data: {
                        upazila_id: idUpazila,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#union-dropdown').html(
                            '<option value="">-- Select Union --</option>');
                        $.each(res.unions, function(key, value) {
                            $("#union-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>
