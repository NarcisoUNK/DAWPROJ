<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            <li><a href="{{ route('loginhome') }}">Login</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <section class="hero-section" id="hero-section">
            <div class="hero-text">
                <h2 id="main-race-name">Loading...</h2>
                <a href="#" id="main-race-link" class="btn-primary">Buy Tickets</a>
            </div>
            <div class="hero-image">
                <img src="path/to/your/image.jpg" alt="Race Image" id="main-race-image">
            </div>
        </section>

        <section class="events-section">
            <h2>Top Events</h2>
            <div class="events-container" id="events-container">
                <!-- Corridas serão carregadas aqui -->
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch races and upcoming race
            axios.get('/api/races')
                .then(function(response) {
                    const { races, upcomingRace } = response.data.data;

                    // Update the main race section
                    if (upcomingRace) {
                        document.getElementById('main-race-name').innerText = upcomingRace.race_name;
                        document.getElementById('main-race-link').href = `/viewrace/${upcomingRace.id_race}`;
                        // Update the image source if you have a specific image for each race
                        // document.getElementById('main-race-image').src = `path/to/your/image/${upcomingRace.image}`;
                    } else {
                        document.getElementById('main-race-name').innerText = 'No upcoming races';
                    }

                    // Update the events section
                    const eventsContainer = document.getElementById('events-container');
                    races.forEach(function(race) {
                        const eventCard = document.createElement('div');
                        eventCard.classList.add('event-card');
                        eventCard.innerHTML = `
                            <img src="path/to/your/event.jpg" alt="${race.race_name}">
                            <p>${race.race_name}</p>
                            <a href="/viewrace/${race.id_race}" class="btn-primary">Buy Tickets</a>
                        `;
                        eventsContainer.appendChild(eventCard);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching races:', error);
                });
        });

        // JavaScript for menu pop-up animation
        const menuIcon = document.getElementById('menu-icon');
        const menu = document.getElementById('menu');

        menuIcon.addEventListener('click', () => {
            console.log('Menu icon clicked'); // Debugging statement
            console.log('Menu class before toggle:', menu.classList);
            menu.classList.toggle('hidden');
            console.log('Menu class after toggle:', menu.classList);
        });
    </script>
</body>
</html>