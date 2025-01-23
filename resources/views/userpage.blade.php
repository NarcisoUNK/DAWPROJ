<x-layout>
    <link rel="stylesheet" href="{{ asset('userpage.css') }}">
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
                <tbody>
                    <!-- Tickets will be dynamically generated here -->
                </tbody>
            </table>
    </main>
    <script>
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

        document.addEventListener('DOMContentLoaded', async function() {
            const id_user = getCookie('id_user');
            console.log('id_user:', id_user); // Debugging statement

            if (id_user) {
                // Fetch user data
                axios.get('/api/user/' + id_user)
                .then(function(response) {
                    const user = response.data.data;
                    console.log('User data:', user); // Debugging statement
                    document.getElementById('username').innerText += (' ' + user.name);

                    axios.get('/api/user/' + user.id_user + '/tickets')
                    .then(function(response) {
                        const tickets = response.data.data;
                        console.log('Tickets data:', tickets); // Debugging statement
                        const ticketsContainer = document.getElementById('tickets').getElementsByTagName('tbody')[0];

                        tickets.forEach(function(ticket, index) {
                            const ticketItem = document.createElement('tr');
                            ticketItem.classList.add('new-ticket');
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

                            // Highlight the new ticket row
                            setTimeout(() => {
                                ticketItem.classList.remove('new-ticket');
                                ticketItem.querySelectorAll('td').forEach(td => td.classList.add('highlight'));
                            }, 500);
                        });

                    })
                    .catch(function(error) {
                        console.error('Error fetching tickets:', error);
                    });
                    
                })
                .catch(function(error) {
                    console.error('Error fetching user:', error);
                });
            } else {
                console.error('id_user cookie not found');
            }
        });
    </script>
</x-layout>