<x-layout>
    <main class="main">
        
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch user data
            axios.get('/api/user/'+getCookie('id_user'))
                .then(function(response) {
                    const user = response.data.data;
                })
                .catch(function(error) {
                    console.error('Error fetching user:', error);
                });
        });
    </script>
    
</x-layout>