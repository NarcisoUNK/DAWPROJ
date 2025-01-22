<x-layout>
    <main class="dashboard">
        <section class="graph-section">
            <canvas id="salesChart"></canvas>
        </section>

        <section class="stats-section">
            <div id ="salesChart" class="stats-card">
                
            </div>
        </section>

        <section class="events-section">
            <h2>Races</h2>
            <a href="{{ route('race.new') }}" class="btn-primary">CREATE NEW RACE</a>
            <div class="events-container">
                <div class="event-card">
                    <p>FORMULA 1 PIRELLI UNITED STATES GRAND PRIX 2024</p>
                    <button class="btn-info">Info</button>
                </div>
                <div class="event-card">
                    <p>FORMULA 1 MEXICO GRAND PRIX 2024</p>
                    <button class="btn-info">Info</button>
                </div>
                <div class="event-card">
                    <p>FORMULA 1 BRAZIL GRAND PRIX 2024</p>
                    <button class="btn-info">Info</button>
                </div>
            <a href="{{ route('creategrandstand') }}" class="btn-primary">CREATE NEW GRANDSTAND</a>
            <div id="events-container" class="events-container">
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js script for sales graph
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales (€)',
                    data: [120000, 140000, 150000, 170000, 200000, 230000, 250000, 270000, 290000, 310000, 330000, 350000],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    // Chart.js script for sales graph
        const ctx = document.getElementById('salesChart').getContext('2d');
        let salesChart = new Chart(ctx, {
            type: 'bar',
            data:{
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
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

        axios.get('/api/user/'+getCookie('id_user')+'/races').then(function(response) {
            const races = response.data.data;

            // Update the events section
            const eventsContainer = document.getElementById('events-container');
            races.forEach(function(race) {
                const eventCard = document.createElement('div');
                eventCard.classList.add('event-card');
                eventCard.innerHTML = `
                    <img width=300 src="data:image/gif;base64,${race.image}" alt="${race.race_name}">
                    <p>${race.race_name}</p>
                    <a href="/viewrace/${race.id_race}" class="btn-primary">Info</a>
                `;
                eventsContainer.appendChild(eventCard);

                
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

            
        }).catch(function(error) {
            console.error('Error fetching races:', error);
        });

        
    </script>
</x-layout>