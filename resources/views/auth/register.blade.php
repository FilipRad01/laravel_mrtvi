@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/app.scss' ])
<div class="w-100 h-100 d-flex justify-content-center align-items-center text-white">
    <div class="w-25 p-5 border rounded" style="background-color: #254E70">
        <form method="POST" action="{{route('register')}}">
            @csrf
        <div class="w-100 mb-2 text-center fs-2">Create Your Account</div>

        <!-- Name input -->
        <div data-mdb-input-init class="form-outline mb-2">
            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
            <label class="form-label" for="form2Example1">Name</label>
        </div>

        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-2">
            <input type="email" name="email" id="form2Example1" class="form-control" placeholder="example@gmail.com" />
            <label class="form-label" for="form2Example1">Email address</label>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init class="form-outline mb-2">
            <input type="password" name="password" id="form2Example2" class="form-control" />
            <label class="form-label" for="form2Example2">Password</label>
        </div>
        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="w-100 rounded btn-primary btn-block mb-2 py-2">Sign up</button>

        <!-- Register buttons -->
        <div class="text-center">
            <p>Are you member? <a href="http://127.0.0.1:8000/login">Login</a></p>
        </div>
        </form>
    </div>
</div>