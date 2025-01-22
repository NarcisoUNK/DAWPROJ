<x-layout>
    <main class="dashboard">
        <section class="graph-section">
            <canvas id="salesChart"></canvas>
        </section>

        <section class="stats-section">
            <div class="stats-card">
                <h2>2024</h2>
                <ul>
                    <li>Outubro 2024 - 1,234,567.89€</li>
                    <li>Novembro 2024 - 1,567,890.12€</li>
                    <li>Dezembro 2024 - 1,890,123.45€</li>
                </ul>
            </div>
        </section>

        <section class="events-section">
            <h2>Grandstands</h2>
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
            </div>
        </section>
    </main>

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
    </script>
</x-layout>