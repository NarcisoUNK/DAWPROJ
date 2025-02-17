<x-layout>
    <link rel="stylesheet" href="{{ asset('viewrace.css') }}">

    <main class="race-details">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-image">
                <img id="race-image" alt="Race Image" />
            </div>
            <div class="race-info">
                <h2 id="race-name">Loading...</h2>
                <p><strong>Season:</strong> <span id="race-year"></span></p>
                <p><strong>Location:</strong> <span id="race-location"></span></p>
            </div>
        </section>

        <!-- Grandstands and Circuit Section -->
        <section class="grandstands-circuit-section">
            <!-- Grandstands Section -->
            <div class="grandstands-section">
                <h2>Grandstands</h2>
                <div class="grandstands-container">
                    <!-- Grandstands will be dynamically loaded here -->
                </div>
            </div>

            <!-- Circuit Section -->
            <div class="circuit-section">
                <h2>Circuit</h2>
                <div class="circuit-image">
                    <img id="circuit" alt="Circuit Image" />
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const raceId = {{ $id }};

            // Function to set loading states
            const setLoadingState = () => {
                document.getElementById('race-name').innerText = 'Loading...';
                document.getElementById('race-year').innerText = '';
                document.getElementById('race-location').innerText = '';
                document.getElementById('race-image').src = '';
                document.getElementById('circuit').src = '';
            };

            // Fetch race details
            axios.get(`/api/race/${raceId}`)
                .then(response => {
                    const race = response.data.data;

                    // Update race information
                    document.getElementById('race-name').innerText = race.race_name;
                    document.getElementById('race-year').innerText = race.year;
                    document.getElementById('race-location').innerText = `${race.city}, ${race.country}`;
                    document.getElementById('race-image').src = `data:image/jpeg;base64,${race.image}`;
                    document.getElementById('circuit').src = `data:image/jpeg;base64,${race.circuit}`;
                })
                .catch(error => {
                    console.error('Error fetching race details:', error);
                    setLoadingState(); // Reset the state if fetching fails
                });

            // Fetch grandstands for the race
            axios.get(`/api/race/${raceId}/grandstands`)
                .then(function(response) {
                    const grandstands = response.data.data;
                    const grandstandsContainer = document.querySelector('.grandstands-container');
                    // Check if there are grandstands
                    if (grandstands.length == 0) {
                        grandstandsContainer.innerHTML = `<p>No grandstands available for this race.</p>`;
                        return;
                    }
                    grandstands.forEach(function(grandstand) {
                        const grandstandCard = document.createElement('div');
                        grandstandCard.classList.add('grandstand-card');
                        let lowestPrice = Infinity;
                        grandstand.seats.forEach(function(seat) {
                            if (seat.price < lowestPrice) {
                                lowestPrice = seat.price;
                            }
                        });
                        grandstandCard.innerHTML = `
                            <p>${grandstand.name}</p>
                            <p>Price: ${lowestPrice}€</p>
                            <a href="/grandstand/${grandstand.id_grandstand}/seats" class="btn-primary">Buy Tickets</a>
                        `;
                        grandstandsContainer.appendChild(grandstandCard);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching grandstands:', error);
                    document.querySelector('.grandstands-container').innerHTML = `<p>Failed to load grandstands.</p>`;
                });
        });
    </script>
</x-layout>