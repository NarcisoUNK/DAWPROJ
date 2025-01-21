<x-layout>
    <main class="grandstand-page">
        <h2>Grandstand Seats</h2>
        <div class="seat-grid" id="seat-grid">
            <!-- Seats will be dynamically generated here -->
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const grandstandId = {{ $id }};
            axios.get(`/api/grandstand/${grandstandId}/seats`)
                .then(function(response) {
                    const seats = response.data.data;
                    const seatGrid = document.getElementById('seat-grid');
                    seats.forEach(function(seat) {
                        const seatElement = document.createElement('div');
                        seatElement.classList.add('seat');
                        seatElement.innerText = seat.n_seat_grandstand;
                        seatGrid.appendChild(seatElement);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching seats:', error);
                });
        });
    </script>
</x-layout>