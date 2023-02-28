@extends('layouts.app')

@section('content')
    <div class="container col-4">
        <form id="userForm" class="pt-5" method="POST">
            @csrf
            <div class="form-group">
                <label class="py-3">First name</label>
                <input type="text" value="{{ old('first_name') }}" id="first_name" name="first_name" class="form-control" placeholder="Enter first name">
                <span class="error text-danger d-none"></span>
            </div>
            <div class="form-group">
                <label class="py-3">Last name</label>
                <input type="text" value="{{ old('last_name') }}" id="last_name" name="last_name" class="form-control" placeholder="Enter last name">
                <span class="error text-danger d-none"></span>
            </div>
            <div class="form-group ">
                <label class="py-3">Email</label>
                <input type="text" value="{{ old('email') }}" id="email" name="email" class="form-control" placeholder="Enter email">
                <span class="error email-error text-danger d-none"></span>
                <span id="email-message" class="d-none email-error text-danger">User already exist</span>
            </div>
            <div class="form-group">
                <label class="py-3">Password</label>
                <input type="password" value="{{ old('password') }}" id="password" name="password" class="form-control" placeholder="Password">
                <span class="error text-danger d-none"></span>
            </div>
            <div class="form-group">
                <label class="py-3">Confirm password</label>
                <input type="password" value="{{ old('password_confirmation') }}" id="password_confirmation"  name="password_confirmation" class="form-control" placeholder="Confirm password">
                <span class="error text-danger d-none"></span>
            </div>
            <div class="form-group mt-3">
                <button id="submit" class="btn btn-primary">Зареєструватись</button>
            </div>
        </form>

        <h1 id="message" class="pt-5 d-none">Registration is successful</h1>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <script>
        $('#userForm').on('submit', function (event) {
            event.preventDefault()
            let first_name = $('#first_name').val()
            let last_name = $('#last_name').val()
            let email = $('#email').val()
            let password = $('#password').val()
            let password_confirmation = $('#password_confirmation').val()

            $.ajax({
                url: "{{ route('user.store') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    first_name: first_name,
                    last_name: last_name,
                    password: password,
                    email: email,
                    password_confirmation: password_confirmation,
                },
                success: function(data) {
                    $('#userForm').addClass('d-none')
                    $("#message").removeClass('d-none')
                },
                error: function (error) {
                    if(error.responseJSON.isUserExist === true) {
                        $('#email-message').removeClass('d-none')
                    }

                    $.each(error.responseJSON.errors, function (key, value) {

                        $("#" + key).next().html(value[0]);
                        $("#" + key).next().removeClass('d-none');
                        $('#email-message').addClass('d-block')
                    });
                },
            });
        });
    </script>

@endsection

