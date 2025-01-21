<x-layout>

    <main class="form-container">
        <h2>Login</h2>
        <form id="login-form" method="POST" action="{{ url('') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <p id="error-message" hidden>Dados errados!</p>
            </div>
            <button type="submit" class="btn-primary">Login</button>
            <p class="forgot-password">
                <a href="{{ route('sellerpage') }}">Forgot Password?</a>
            </p>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="{{ url('register') }}" class="btn-secondary">Register</a></p>
        </div>
    </main>

    <script>
        // Add animation to form elements
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.form-container',
                opacity: [0, 1],
                translateY: [-50, 0],
                duration: 800,
                easing: 'easeOutQuad'
            });

            anime({
                targets: '.form-group, .btn-primary, .register-link',
                opacity: [0, 1],
                translateY: [30, 0],
                delay: anime.stagger(200, { start: 300 }),
                duration: 600,
                easing: 'easeOutQuad'
            });
        });

        document.getElementById('login-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const url = form.getAttribute('action');
            const method = form.getAttribute('method');
            
            await fetch(url+'/api/user/login', {
                method: method,
                body: formData
            }).then(response => {
                if(!response.ok){
                    document.getElementById('error-message').removeAttribute('hidden');
                }else{
                    fetch(url+'/sanctum/csrf-cookie', {
                        method: 'GET'
                    }).then(data => {
                        window.location.replace(url);
                    });
                }
            });
        });

    </script>
</x-layout>