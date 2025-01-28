
<x-layout>
    <link rel="stylesheet" href="{{ asset('sellerpage.css') }}">
    <main class="dashboard">
        <section class="filter-section">
            <form id="filterForm">
                <label for="yearFilter">Year:</label>
                <select id="yearFilter" name="year">
                    <option value="">All</option>
                    <!-- Add options dynamically -->
                </select>
                <label for="locationFilter">Location:</label>
                <select id="locationFilter" name="location">
                    <option value="">All</option>
                    <!-- Add options dynamically -->
                </select>
                <button type="button" onclick="applyFilters()">Apply Filters</button>
            </form>
        </section>

        <section class="graph-section">
            <canvas id="salesChart"></canvas>
        </section>

        <section class="stats-section">
            <div id="salesChart" class="stats-card">
                <!-- Sales chart will be rendered here -->
            </div>
        </section>

        <section class="events-section">
            <h2>Races</h2>
            <a href="{{ route('race.new') }}" class="btn-primary">CREATE NEW RACE</a>
            <a href="{{ route('creategrandstand') }}" class="btn-primary">CREATE NEW GRANDSTAND</a>
            <div id="events-container" class="events-container">
                <!-- Races will be dynamically loaded here -->
            </div>
        </section>

        <section class="races-section">
            <h2>All Races</h2>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Race Name</th>
                            <th>Year</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="races-table-body">
                        <!-- Races will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Chart.js script for sales graph
        const ctx = document.getElementById('salesChart').getContext('2d');
        let salesChart = new Chart(ctx, {
            type: 'bar',
            data:{
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false,
            }
        });

        let allRaces = [];

        axios.get('/api/user/'+getCookie('id_user')+'/races').then(function(response) {
            allRaces = response.data.data;

            // Populate filter options
            populateFilterOptions(allRaces);

            // Update the events section
            updateEventsSection(allRaces);

            // Update the races table
            updateRacesTable(allRaces);

            // Update the sales chart
            updateSalesChart(allRaces);

        }).catch(function(error) {
            console.error('Error fetching races:', error);
        });

        function populateFilterOptions(races) {
            const yearFilter = document.getElementById('yearFilter');
            const locationFilter = document.getElementById('locationFilter');
            const years = new Set();
            const locations = new Set();

            races.forEach(function(race) {
                years.add(race.year);
                locations.add(race.city + ', ' + race.country);
            });

            years.forEach(function(year) {
                const option = document.createElement('option');
                option.value = year;
                option.text = year;
                yearFilter.appendChild(option);
            });

            locations.forEach(function(location) {
                const option = document.createElement('option');
                option.value = location;
                option.text = location;
                locationFilter.appendChild(option);
            });
        }

        function applyFilters() {
            const year = document.getElementById('yearFilter').value;
            const location = document.getElementById('locationFilter').value;

            const filteredRaces = allRaces.filter(function(race) {
                return (year === '' || race.year == year) &&
                       (location === '' || (race.city + ', ' + race.country) == location);
            });

            // Update the events section
            updateEventsSection(filteredRaces);

            // Update the races table
            updateRacesTable(filteredRaces);

            // Update the sales chart
            updateSalesChart(filteredRaces);
        }

        function updateEventsSection(races) {
            const eventsContainer = document.getElementById('events-container');
            eventsContainer.innerHTML = '';
            races.forEach(function(race) {
                const eventCard = document.createElement('div');
                eventCard.classList.add('event-card');
                eventCard.innerHTML = `
                    <img width=300 src="data:image/gif;base64,${race.image}" alt="${race.race_name}">
                    <p>${race.race_name}</p>
                    <a href="/viewrace/${race.id_race}" class="btn-primary">Info</a>
                `;
                eventsContainer.appendChild(eventCard);
            });
        }

        function updateRacesTable(races) {
            const racesTableBody = document.getElementById('races-table-body');
            racesTableBody.innerHTML = '';
            races.forEach(function(race) {
                const raceRow = document.createElement('tr');
                raceRow.innerHTML = `
                    <td>${race.race_name}</td>
                    <td>${race.year}</td>
                    <td>${race.city}, ${race.country}</td>
                    <td>
                        <a href="/viewrace/${race.id_race}" class="btn-edit">Edit</a>
                        <button class="btn-delete" onclick="deleteRace(${race.id_race})">Delete</button>
                    </td>
                `;
                racesTableBody.appendChild(raceRow);
            });
        }

        function updateSalesChart(races) {
            salesChart.data.labels = [];
            salesChart.data.datasets[0].data = [];

            races.forEach(function(race) {
                axios.get('/api/race/'+race.id_race+'/tickets').then(function(response) {      
                    const tickets = response.data.data;
                    let totalSales = 0;
                    for(let ticket in tickets) {
                        totalSales += tickets[ticket].final_price;
                    }

                    // Update the sales chart
                    salesChart.data.labels.push(race.race_name);                    
                    salesChart.data.datasets[0].data.push(totalSales);
                    salesChart.update();
                    
                }).catch(function(error) {
                    console.error('Error fetching tickets:', error);      
                });
            });
        }

        function deleteRace(raceId) {
            if (confirm('Are you sure you want to delete this race?')) {
                axios.get(`/api/race/delete/${raceId}`, {
                    headers: {
                        'Authorization': `Bearer ${getCookie('auth_token')}`
                    }
                }).then(function(response) {
                    alert('Race deleted successfully!');
                    location.reload();
                }).catch(function(error) {
                    console.error('Error deleting race:', error);
                    alert('Failed to delete race.');
                });
            }
        }

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