    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('assets/login.png') }}" alt="Library Logo">
            <h2>Perpustakaan Login</h2>
        </div>
        <form>
            <div class="form-group">
                <input type="email" wire:model="email" class="form-control" id="email"
                placeholder="Email Address">
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" wire:model="password" class="form-control" id="password" 
                placeholder="Password">
                @error('password')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="button" wire:click="proses" class="btn btn-primary btn-login">Login</button>
        </form>
        <div class="text-center">
            <a href="#">Forgot password?</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
</div>
