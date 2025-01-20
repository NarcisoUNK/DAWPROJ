<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Race</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
    </header>

    <main class="form-container">
        <h2>Create Race</h2>
        <form id="createRaceForm">
            <div class="form-group">
                <label for="race_name">Race Name</label>
                <input type="text" id="race_name" name="race_name" required>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <button type="submit" class="btn-primary">Create Race</button>
        </form>
        <a href="{{ route('/grandstand/new') }}" class="btn-primary">ADD GRANDSTAND</a>
    </main>

    <script>
        document.getElementById('createRaceForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = {
                race_name: document.getElementById('race_name').value,
                year: document.getElementById('year').value,
                country: document.getElementById('country').value,
                city: document.getElementById('city').value,
            };

            try {
                const response = await axios.post('http://your-api-url/api/races', formData);
                alert('Race created successfully!');
                window.location.href = '/dashboard'; // Redirecionar de volta para o dashboard
            } catch (error) {
                console.error('Error creating race:', error);
                alert('Failed to create race. Please try again.');
            }
        });
    </script>
</body>
</html>