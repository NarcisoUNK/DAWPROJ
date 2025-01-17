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
    <div class="login-container">
        <div class="login-form">
            <h1>Welcome Back</h1>
            <form id="login-form">
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
                    <a href="#">Forgot Password?</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Add animation to form elements
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.login-form',
                opacity: [0, 1],
                translateY: [-50, 0],
                duration: 800,
                easing: 'easeOutQuad'
            });

            anime({
                targets: '.form-group, .btn-primary',
                opacity: [0, 1],
                translateY: [30, 0],
                delay: anime.stagger(200, { start: 300 }),
                duration: 600,
                easing: 'easeOutQuad'
            });
        });
    </script>
</body>
</html>
