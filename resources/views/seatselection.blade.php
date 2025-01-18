<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grandstand Seats</title>
    <link rel="stylesheet" href="{{ asset('seatselection.css') }}">
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
    </header>

    <main class="grandstand-page">
        <h2>Main Grandstands</h2>
        <p>From: €799.99</p>
        <button class="btn-primary" id="buy-tickets-btn">Buy Tickets</button>
    </main>

    <!-- Modal -->
    <div class="modal hidden" id="seat-modal">
        <div class="modal-content">
            <h2>Choose Your Seat</h2>
            <div class="seat-grid" id="seat-grid">
                <!-- Seats will be dynamically generated here -->
            </div>
            <button class="btn-primary" id="confirm-tickets-btn">Buy Tickets</button>
        </div>
    </div>

    <script>
        const buyTicketsBtn = document.getElementById('buy-tickets-btn');
        const seatModal = document.getElementById('seat-modal');
        const seatGrid = document.getElementById('seat-grid');
        const confirmTicketsBtn = document.getElementById('confirm-tickets-btn');

        // Generate seats (Example: 10 rows x 10 columns)
        const rows = 10;
        const cols = 10;

        for (let i = 0; i < rows; i++) {
            for (let j = 0; j < cols; j++) {
                const seat = document.createElement('div');
                seat.classList.add('seat');
                seat.dataset.row = i;
                seat.dataset.col = j;
                seat.addEventListener('click', () => {
                    seat.classList.toggle('selected');
                });
                seatGrid.appendChild(seat);
            }
        }

        // Show modal when "Buy Tickets" is clicked
        buyTicketsBtn.addEventListener('click', () => {
            seatModal.classList.remove('hidden');
        });

        // Close modal or confirm selection
        confirmTicketsBtn.addEventListener('click', () => {
            const selectedSeats = document.querySelectorAll('.seat.selected');
            const seatNumbers = Array.from(selectedSeats).map(seat => 
                `Row: ${seat.dataset.row}, Col: ${seat.dataset.col}`
            );
            alert(`You selected: \n${seatNumbers.join('\n')}`);
            seatModal.classList.add('hidden'); // Close the modal
        });
    </script>
</body>
</html>
