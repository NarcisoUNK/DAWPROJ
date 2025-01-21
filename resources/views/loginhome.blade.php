<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('login.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
    </header>

    <main class="form-container">
        <h2>Login</h2>
        <form id="login-form" method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn-primary">Login</button>
            <p class="forgot-password">
                <a href="{{ route('sellerpage') }}">Forgot Password?</a>
            </p>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="{{ route('register') }}" class="btn-secondary">Register</a></p>
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
            
            await fetch(url, {
                method: method,
                body: formData
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirectUrl;
                } else {
                    const errorMessage = document.getElementById('error-message');
                    if (errorMessage) {
                        errorMessage.removeAttribute('hidden');
                    }
                }
            }).catch(error => {
                console.error('Error:', error);
                const errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    errorMessage.removeAttribute('hidden');
                }
            });
        });
    </script>
</body>
</html>