<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Race Details</title>
    <link rel="stylesheet" href="{{ asset('viewrace.css') }}">
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
    </header>

    <main class="race-details">
        <section class="hero-section">
            <div class="hero-image">
                <img src="path/to/circuit-image.jpg" alt="Circuit Image">
            </div>
            <div class="race-info">
                <h2>FORMULA 1 PIRELLI UNITED STATES GRAND PRIX 2024</h2>
                <p><strong>Season:</strong> 2024</p>
                <p><strong>Location:</strong> Austin, United States</p>
            </div>
        </section>

        <section class="grandstands-section">
            <h2>Grandstands</h2>
            <div class="grandstands-container">
                <div class="grandstand-card">
                    <p>Main Grandstands</p>
                    <p>From: €799.99</p>
                    <a href="{{ route('seatselection') }}" class="btn-primary">Buy Tickets</a>
                </div>
                <div class="grandstand-card">
                    <p>Turn 1 Grandstands</p>
                    <p>From: €599.99</p>
                    <button class="btn-primary">Buy Tickets</button>
                </div>
                <div class="grandstand-card">
                    <p>Turn 15 Grandstands</p>
                    <p>From: €699.99</p>
                    <button class="btn-primary">Buy Tickets</button>
                </div>
                <div class="grandstand-card">
                    <p>General Admission</p>
                    <p>From: €299.99</p>
                    <button class="btn-primary">Buy Tickets</button>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
