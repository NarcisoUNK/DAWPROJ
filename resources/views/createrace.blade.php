
<style></style>
<x-layout>
    <main class="form-container">
        <h2>Create Race</h2>
        <form id="createRaceForm" method="POST" action="{{ route('race.store') }}">
            @csrf
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
    </main>
</x-layout>

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
            const response = await axios.post('{{ route('race.store') }}', formData);
            alert('Race created successfully!');
            window.location.href = '{{ route('sellerpage') }}'; // Redirect back to the seller page
        } catch (error) {
            console.error('Error creating race:', error);
            alert('Failed to create race. Please try again.');
        }
    });
</script>