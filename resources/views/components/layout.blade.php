<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1Tickets</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>    
        function getCookie(name) {
            const nameEquals = name + '=';
            const cookieArray = document.cookie.split(';');

            for (cookie of cookieArray) {
                while (cookie.charAt(0) == ' ') {
                cookie = cookie.slice(1, cookie.length);
                }

                if (cookie.indexOf(nameEquals) == 0)
                return decodeURIComponent(
                    cookie.slice(nameEquals.length, cookie.length),
                );
            }

            return null;
        }
        function setCookie(name, value, days = 7) {
            let expires = '';

            if (days) {
                const date = new Date();

                date.setDate(date.getDate() + days);

                expires = '; expires=' + date.toUTCString();
            }

            document.cookie =
                name +
                '=' +
                (encodeURIComponent(value) || '') +
                expires +
                '; path=/';
            }
    </script>
</head>
<body>
    <header class="header">
        <h1><a id="home" href="{{ url('/') }}">F1 Tickets</a></h1>
        <div class="menu-icon" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <!-- Pop-up Menu -->
    <nav class="menu hidden" id="menu">
        <ul>
            <li><a href="#about">About</a></li>
            <li><a id="login" href="{{ url('/login') }}">Login</a></li>
        </ul>
    </nav>
    <script>
        window.addEventListener('DOMContentLoaded', async function() {
            if(getCookie('XSRF-TOKEN')) {
                const id_user = getCookie('id_user');
                const url = document.getElementById('home').href;
                axios.get(url+'api/user/'+id_user)
                .then(data => {
                    const user = data.data.data;
                    
                    document.getElementById('login').innerText = user.name;

                    const perm = getCookie('perm');

                    if(perm == "111")
                        document.getElementById('login').href = '{{ url("sellerpage") }}';
                    else
                        document.getElementById('login').href = '{{ url("userpage") }}';
                });
            }
        });
    </script>
    {{ $slot }}
    <script>
        // JavaScript for menu pop-up animation
        const menuIcon = document.getElementById('menu-icon');
        const menu = document.getElementById('menu');

        menuIcon.addEventListener('click', () => {
            console.log('Menu icon clicked'); // Debugging statement
            console.log('Menu class before toggle:', menu.classList);
            menu.classList.toggle('hidden');
            console.log('Menu class after toggle:', menu.classList);
        });

        
    </script>
</body>
</html>
