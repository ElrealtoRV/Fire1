<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFEMM Support System</title>
    <link rel="website icon" type="png" href="asset('assets/img/fireICon.png') ">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Open Sans', sans-serif;
    line-height: 1.6;
    color: #333;
}

header {
    background: linear-gradient(to right, #3498db, #2e37a4);
    padding: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo img {
    height: 40px;
}

.login-btn {
    background-color: #fff;
    color: #2e37a4;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.login-btn:hover {
    background-color: #e6e6e6;
}

.hero {
    background-color: #f5f5f5;
    padding: 5rem 3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-content {
    max-width: 600px;
}

.hero-content h1 {
    font-size: 3rem;
    color: #2e37a4;
    text-transform: uppercase;
}

.hero-content p {
    font-size: 1.5rem;
    line-height: 1.8;
    color: #555;
}

.hero-image img {
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
}
.features {
    display: flex;
    justify-content: space-around;
    padding: 4rem 2rem;
    background-color: #fff;
}

.feature {
    text-align: center;
    max-width: 300px;
}

.feature i {
    font-size: 3rem;
    color: #3498db;
    margin-bottom: 1rem;
}

.feature h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem;
}

@media (max-width: 768px) {
    .hero {
        flex-direction: column;
        text-align: center;
    }

    .hero-content {
        margin-bottom: 2rem;
    }

    .features {
        flex-direction: column;
        align-items: center;
    }

    .feature {
        margin-bottom: 2rem;
    }
 .hero-image {
        width: 500px;
        height: 500px;
        overflow: hidden;
    }

    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
<body>
    <header>
        <nav>
            <div class="logo">
            <img src="{{ asset('assets/img/norsu.png') }}" alt="Norsu Logo">
            </div>
	@if (Route::has('login'))
            <div class="login">
	@auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
	@else
		    <a href="{{ route('login') }}" class="login-btn">Login</a>
	@endauth
            </div>
	@endif
        </nav>
    </header>

    <main>
        <section class="hero">
        
            <div class="hero-content">

                <h1>NORSU Fire Extinguisher Mapping and Monitoring System</h1>
                <p>Enhancing fire safety on all NORSU campuses through digital tools and data-driven decision making.</p>
            </div>
            <div class="hero-image">
            <a class="btn"><img src="{{ asset('assets/img/fireman1.0.png') }}" alt="Fire man"></a>
            </div>
        </section>

        <section class="features">
            <div class="feature">
                <i class="fa-solid fa-map-location-dot"></i>
                <h3>Fire Extinguisher Mapping</h3>
                <p>Creates a digital map of all NORSU buildings, pinpointing the exact locations of fire extinguishers.</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-gauge-high"></i>
                <h3>Status Monitoring</h3>
                <p>Tracks the operational status of fire extinguishers, indicating whether an extinguisher is full, partially used, or empty.</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <h3>Maintenance History</h3>
                <p>Records maintenance activities performed on each extinguisher, ensuring proper upkeep and compliance.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Negros Oriental State University. All rights reserved.</p>
    </footer>
</body>
</html>