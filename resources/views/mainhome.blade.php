<x-layout>

    <main class="main-content">
        <section class="hero-section" id="hero-section">
            <div class="hero-text">
                <h2 id="main-race-name">FORMULA 1 PIRELLI UNITED STATES GRAND PRIX 2024</h2>
                <a id="main-race-link" href="{{ url('race') }}" class="btn-primary">Buy Tickets</a> <!-- TODO:send race id -->
            </div>
            <div class="hero-image">
                <img id="main-race-image" src="path/to/your/image.jpg" alt="Race Image" width="500">
            </div>
        </section>

        <section class="events-section">
            <h2>Top Events</h2>
            <div class="events-container" id="events-container">
                <!-- Races will be loaded here -->
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
                        document.getElementById('main-race-image').src = `data:image/gif;base64,${upcomingRace.image}`;
                    } else {
                        document.getElementById('main-race-name').innerText = 'No upcoming races';
                    }

                    // Update the events section
                    const eventsContainer = document.getElementById('events-container');
                    races.forEach(function(race) {
                        const eventCard = document.createElement('div');
                        eventCard.classList.add('event-card');
                        eventCard.innerHTML = `
                            <img src="data:image/gif;base64,${race.image}" alt="${race.race_name}">
                            <p>${race.race_name}</p>
                            <a href="/viewrace/${race.id_race}" class="btn-primary buy-tickets">Buy Tickets</a>
                        `;
                        eventsContainer.appendChild(eventCard);
                    });

                    // Add event listeners to the Buy Tickets buttons
                    document.querySelectorAll('.buy-tickets').forEach(function(button) {
                        button.addEventListener('click', function(event) {
                            if (!getCookie('id_user')) {
                                event.preventDefault();
                                alert('You need to log in to buy tickets.');
                                window.location.href = '{{ url("login") }}';
                            }
                        });
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching races:', error);
                });
        });

        function getCookie(name) {
            const nameEquals = name + '=';
            const cookieArray = document.cookie.split(';');

            for (let cookie of cookieArray) {
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.slice(1, cookie.length);
                }

                if (cookie.indexOf(nameEquals) == 0) {
                    return decodeURIComponent(cookie.slice(nameEquals.length, cookie.length));
                }
            }

            return null;
        }
    </script>
</x-layout>