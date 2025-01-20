<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Race Details</title>
    <link rel="stylesheet" href="{{ asset('viewrace.css') }}">
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
    </header>

    <main class="race-details">
        <section class="hero-section">
            <div class="hero-image">
                <img src="path/to/circuit-image.jpg" alt="Circuit Image">
            </div>
            <div class="race-info">
                <h2 id="race-name">Loading...</h2>
                <p><strong>Season:</strong> <span id="race-year"></span></p>
                <p><strong>Location:</strong> <span id="race-location"></span></p>
            </div>
        </section>

        <section class="grandstands-section">
            <h2>Grandstands</h2>
            <div class="grandstands-container">
                <!-- Grandstands will be dynamically loaded here -->
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const raceId = {{ $id }};
            axios.get(`/api/race/${raceId}`)
                .then(function(response) {
                    const race = response.data.data;
                    document.getElementById('race-name').innerText = race.race_name;
                    document.getElementById('race-year').innerText = race.year;
                    document.getElementById('race-location').innerText = `${race.city}, ${race.country}`;
                })
                .catch(function(error) {
                    console.error('Error fetching race:', error);
                });

            // Fetch grandstands for the race
            axios.get(`/api/race/${raceId}/grandstands`)
                .then(function(response) {
                    const grandstands = response.data.data;
                    const grandstandsContainer = document.querySelector('.grandstands-container');
                    grandstands.forEach(function(grandstand) {
                        const grandstandCard = document.createElement('div');
                        grandstandCard.classList.add('grandstand-card');
                        grandstandCard.innerHTML = `
                            <p>${grandstand.name}</p>
                            <a href="/grandstand/${grandstand.id_grandstand}/seats" class="btn-primary">Buy Tickets</a>
                        `;
                        grandstandsContainer.appendChild(grandstandCard);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching grandstands:', error);
                });
        });
    </script>
</body>
</html>