<x-layout>
    <main class="main">
        <div>
            <h2 id="username">Hello </h2>
        </div>
        <div>
            <h3>Your Tickets</h3>
            <table id="tickets">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Grandstand</th>
                        <th>Seat</th>
                        <th>Price</th>
                    </tr>
                </thead>
            </table>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            // Fetch user data
            axios.get('/api/user/'+getCookie('id_user'))
            .then(function(response) {
                const user = response.data.data;
                document.getElementById('username').innerText += (' '+user.name);

                axios.get('/api/user/'+user.id_user+'/tickets')
                .then(function(response) {
                    const tickets = response.data.data;
                    const ticketsContainer = document.getElementById('tickets');

                    for(const ticket of tickets) {
                        const ticketItem = document.createElement('tr');
                        const ticketEvent = document.createElement('td');
                        const ticketGrandstand = document.createElement('td');
                        const ticketSeat = document.createElement('td');
                        const ticketPrice = document.createElement('td');

                        ticketEvent.innerText = ticket.seat.grandstand.race.race_name;
                        ticketGrandstand.innerText = ticket.seat.grandstand.name;
                        ticketSeat.innerText = ticket.seat.n_seat_grandstand;
                        ticketPrice.innerText = ticket.final_price;

                        ticketItem.appendChild(ticketEvent);
                        ticketItem.appendChild(ticketGrandstand);
                        ticketItem.appendChild(ticketSeat);
                        ticketItem.appendChild(ticketPrice);
                        ticketsContainer.appendChild(ticketItem);
                    };

                })
                .catch(function(error) {
                    console.error('Error fetching user:', error);
                });
                
            })
            .catch(function(error) {
                console.error('Error fetching user:', error);
            });
        });
    </script>
    
</x-layout>