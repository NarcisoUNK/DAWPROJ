<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
        <div class="menu-icon" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <!-- Pop-up Menu -->
    <nav class="menu hidden" id="menu">
        <ul>
            <li><a href="#about">About</a></li>
            <li><<a href="{{ route('loginhome') }}">Login</a></li>
            </ul>
    </nav>

    <main class="main-content">
        <section class="hero-section">
            <div class="hero-text">
                <h2>FORMULA 1 PIRELLI UNITED STATES GRAND PRIX 2024</h2>
                <button class="btn-primary">Buy Tickets</button>
            </div>
            <div class="hero-image">
                <img src="path/to/your/image.jpg" alt="Race Image">
            </div>
        </section>

        <section class="events-section">
            <h2>Top Events</h2>
            <div class="events-container">
                <div class="event-card">
                    <img src="path/to/your/event1.jpg" alt="Event 1">
                    <p>Mexico Grand Prix</p>
                </div>
                <div class="event-card">
                    <img src="path/to/your/event2.jpg" alt="Event 2">
                    <p>Brazil Grand Prix</p>
                </div>
                <div class="event-card">
                    <img src="path/to/your/event3.jpg" alt="Event 3">
                    <p>Abu Dhabi Grand Prix</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        // JavaScript for menu pop-up animation
        const menuIcon = document.getElementById('menu-icon');
        const menu = document.getElementById('menu');

        menuIcon.addEventListener('click', () => {
            const isHidden = menu.classList.contains('hidden');

            if (isHidden) {
                menu.classList.remove('hidden');
                anime({
                    targets: '.menu',
                    opacity: [0, 1],
                    scale: [0.5, 1],
                    duration: 400,
                    easing: 'easeOutQuad'
                });
            } else {
                anime({
                    targets: '.menu',
                    opacity: [1, 0],
                    scale: [1, 0.5],
                    duration: 400,
                    easing: 'easeInQuad',
                    complete: () => menu.classList.add('hidden') // Add hidden class after animation ends
                });
            }
        });
    </script>
</body>
</html>
