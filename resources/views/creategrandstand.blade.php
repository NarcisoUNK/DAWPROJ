<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Grandstand</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <header class="header">
        <h1>F1 Tickets</h1>
    </header>

    <main class="form-container">
        <h2>Create Grandstand</h2>
        <form id="createGrandstandForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="seats">Number of Seats</label>
                <input type="number" id="seats" name="seats" required>
            </div>
            <button type="submit" class="btn-primary">Add Grandstand</button>
        </form>
    </main>

    <script>
        document.getElementById('createGrandstandForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('name').value,
                seats: document.getElementById('seats').value,
            };

            try {
                const response = await axios.post('http://your-api-url/api/grandstands', formData);
                alert('Grandstand created successfully!');
                window.location.href = '/dashboard'; // Redirecionar de volta para o dashboard
            } catch (error) {
                console.error('Error creating grandstand:', error);
                alert('Failed to create grandstand. Please try again.');
            }
        });
    </script>
</body>
</html>