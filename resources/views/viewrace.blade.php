<x-layout>

    <main class="race-details">
        <section class="hero-section">
            <div class="hero-image">
                <img id="race-image" alt="Race Image" width=300>
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
            <img id="circuit" alt="Circuit Image" width=300>
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
                    document.getElementById('circuit').src = `data:image/gif;base64,${race.circuit}`;
                    document.getElementById('race-image').src = `data:image/gif;base64,${race.image}`;
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
                });
        });
    </script>
</x-layout>