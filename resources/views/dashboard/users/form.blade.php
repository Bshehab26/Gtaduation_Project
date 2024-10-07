<div class="row mb-3">
    <label for="username" class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>
</div>

<div class="row mb-3">
<<<<<<< HEAD
    <label for="role" class="col-sm-2 col-form-label">User Type <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="role" id="role" class="form-control">
            <option selected>---------- Please select a user type ----------</option>
            @if((auth()->user()->role === "moderator" && Route::is('users.create')))
            <option value="customer" {{ $user->role === "customer" ? 'selected' : '' }}>customer</option>
            @endif
            @if((auth()->user()->role === "moderator" && Route::is('users.edit', auth()->user()->id)))
            <option value="moderator" {{ $user->role === "moderator" ? 'selected' : '' }}>Moderator</option>
            @endif

            @if(auth()->user()->role === "admin" && auth()->user()->id != $user->id)
            <option value="customer" {{ $user->role === "customer" ? 'selected' : '' }}>customer</option>
            <option value="moderator" {{ $user->role === "moderator" ? 'selected' : '' }}>Moderator</option>
            <option value="admin" {{ $user->role === "admin" ? 'selected' : '' }}>Admin</option>
            @elseif(auth()->user()->role === "admin" && auth()->user()->id == $user->id)
            <option value="admin" {{ $user->role === "admin" ? 'selected' : '' }}>Admin</option>
=======
    <label for="user_type" class="col-sm-2 col-form-label">User Type <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="user_type" id="user_type" class="form-control">
            <option selected>---------- Please select a user type ----------</option>
            @if((auth()->user()->user_type === "moderator" && Route::is('users.create')))
            <option value="customer" {{ $user->user_type === "customer" ? 'selected' : '' }}>customer</option>
            @endif
            @if((auth()->user()->user_type === "moderator" && Route::is('users.edit', auth()->user()->id)))
            <option value="moderator" {{ $user->user_type === "moderator" ? 'selected' : '' }}>Moderator</option>
            @endif

            @if(auth()->user()->user_type === "admin" && auth()->user()->id != $user->id)
            <option value="customer" {{ $user->user_type === "customer" ? 'selected' : '' }}>customer</option>
            <option value="moderator" {{ $user->user_type === "moderator" ? 'selected' : '' }}>Moderator</option>
            <option value="admin" {{ $user->user_type === "admin" ? 'selected' : '' }}>Admin</option>
            @elseif(auth()->user()->user_type === "admin" && auth()->user()->id == $user->id)
            <option value="admin" {{ $user->user_type === "admin" ? 'selected' : '' }}>Admin</option>
>>>>>>> main
            @endif
        </select>
    </div>
</div>
