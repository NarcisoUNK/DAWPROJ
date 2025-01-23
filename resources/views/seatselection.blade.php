<x-layout>
    <link rel="stylesheet" href="{{ asset('seatselection.css') }}">
    <main class="grandstand-page">
        <h2>Grandstand Seats</h2>
        <div class="seat-grid" id="seat-grid">
            <!-- Seats will be dynamically generated here -->
        </div>
        <button id="buy-button" class="btn-primary" style="display: none;">Buy Selected Seat</button>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const grandstandId = {{ $id }};
            axios.get(`/api/grandstand/${grandstandId}/seats`)
                .then(function(response) {
                    const seats = response.data.data;
                    const seatGrid = document.getElementById('seat-grid');
                    const buyButton = document.getElementById('buy-button');
                    let selectedSeat = null;

                    seats.forEach(function(seat) {
                        const seatElement = document.createElement('div');
                        seatElement.classList.add('seat');
                        seatElement.innerText = seat.n_seat_grandstand;

                        // Check if the seat has a ticket
                        axios.get(`/api/ticket/seat/${seat.id_seat}`)
                            .then(function(ticketResponse) {
                                const tickets = ticketResponse.data.data;
                                if (tickets.length > 0) {
                                    seatElement.classList.add('taken');
                                } else {
                                    seatElement.addEventListener('click', function() {
                                        if (selectedSeat) {
                                            selectedSeat.classList.remove('selected');
                                        }
                                        seatElement.classList.add('selected');
                                        selectedSeat = seatElement;
                                        buyButton.style.display = 'block';
                                    });
                                }
                            })
                            .catch(function(error) {
                                console.error('Error checking ticket for seat:', error);
                            });

                        seatGrid.appendChild(seatElement);
                    });

                    buyButton.addEventListener('click', function() {
                        if (selectedSeat) {
                            const seatNumber = selectedSeat.innerText;
                            const seatId = seats.find(seat => seat.n_seat_grandstand == seatNumber).id_seat;

                            // Implement the logic to handle the purchase
                            axios.post('/api/ticket', {
                                id_seat: seatId,
                                id_user: {{ auth()->user()->id_user }},
                                final_price: seats.find(seat => seat.id_seat == seatId).price
                            })
                            .then(function(response) {
                                alert(`Seat ${seatNumber} purchased successfully.`);
                                selectedSeat.classList.add('taken');
                                selectedSeat.classList.remove('selected');
                                buyButton.style.display = 'none';
                            })
                            .catch(function(error) {
                                console.error('Error purchasing seat:', error);
                                alert('Failed to purchase seat.');
                            });
                        }
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching seats:', error);
                });
        });
    </script>
</x-layout>