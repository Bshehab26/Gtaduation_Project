<div class="row gy-4">

    <div class="col-md-6">
        <input type="text" id="username" name="username" class="form-control" placeholder="Your Name"
            value="{{ old('username', $user->username) }}" required="">
    </div>

    <div class="col-md-6">
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Your FirstName"
            value="{{ old('first_name', $user->first_name) }}" required="">
    </div>


    <div class="col-md-6">
        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Your LastName"
            value="{{ old('last_name', $user->last_name) }}" required="">
    </div>

    <div class="col-md-6 ">
        <input type="email" id="email" class="form-control" name="email" placeholder="Your Email"
            value="{{ old('email', $user->email) }}" required="">
    </div>
    <div class="d-flex justify-content-lg-around">
        <div class="row">
            <div class="col-lg-4">
                <input class="btn btn-success" type="submit" value="Update">
            </div>
            <div class="col-lg-8">
                <a class="btn btn-dark" href="{{ route('webusers.show', auth()->user()->id) }}">Return to profile
                    user</a>
            </div>
        </div>
    </div>
</div>
