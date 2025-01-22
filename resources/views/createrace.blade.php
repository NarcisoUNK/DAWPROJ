
<style></style>
<x-layout>
    <main class="form-container">
        <h2>Create Race</h2>
        <form id="createRaceForm" method="POST">
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
            <div class="form-group">
                <label for="image">Background image</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="circuit">Circuit Image</label>
                <input type="file" id="circuit" name="circuit" required>
            </div>
            <button type="submit" class="btn-primary">Create Race</button>
        </form>
    </main>
</x-layout>

<script>
    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
    });
    document.getElementById('createRaceForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        image = await toBase64(document.getElementById('image').files[0])
        image = image.split(',')[1]
        circuit = await toBase64(document.getElementById('circuit').files[0])
        circuit = circuit.split(',')[1]

        const formData = {
            race_name: document.getElementById('race_name').value,
            year: document.getElementById('year').value,
            country: document.getElementById('country').value,
            city: document.getElementById('city').value,
            id_user: getCookie('id_user'),
            image: image,
            circuit: circuit,
        };

        try {
            const response = await axios.post('{{ url("")."/api/race" }}', formData);
            alert('Race created successfully!');
            window.location.href = '{{ route("sellerpage") }}'; // Redirect back to the seller page
        } catch (error) {
            console.error('Error creating race:', error);
            alert('Failed to create race. Please try again.');
        }
    });
</script>