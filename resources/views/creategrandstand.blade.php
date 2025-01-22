<x-layout>

    <main class="form-container">
        <h2>Create Grandstand</h2>
        <form id="createGrandstandForm">
            <div class="form-group">
                <label for="race">Race</label>
                <select type="text" id="race" name="race" required></select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="seats">Number of Seats</label>
                <input type="number" id="seats" name="seats" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" required>
            </div>
            <button type="submit" class="btn-primary">Add Grandstand</button>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const response = await axios.get("{{ url('') }}/api/user/"+getCookie('id_user')+"/races");
            const races = response.data.data;
            let options = document.getElementById('race');
            races.forEach(function(race) {
                const raceOption = document.createElement('option');
                raceOption.value = race.id_race;
                raceOption.innerHTML = race.race_name;
                options.appendChild(raceOption);
            });
        });
        document.getElementById('createGrandstandForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('name').value,
                id_race: document.getElementById('race').value,
            };

            try {
                const response = await axios.post("{{ url('') }}/api/grandstand/", formData);
                const grandstand = response.data.data;
                nseats = document.getElementById('seats').value;
                
                for(i=0; i<nseats; i++){
                    const seatData = {
                        id_grandstand: grandstand.id,
                        n_seat_grandstand: i+1,
                        price: document.getElementById('price').value,
                    };
                    
                    try {
                        const response = await axios.post("{{ url('') }}/api/seat/", seatData);
                    } catch (error) {
                        console.error('Error creating seat:', error);
                    }
                }
                alert('Grandstand created successfully!');
                window.location.href = '/sellerpage'; // Redirecionar de volta para o dashboard
            } catch (error) {
                console.error('Error creating grandstand:', error);
                alert('Failed to create grandstand. Please try again.');
            }
        });
    </script>
</x-layout>