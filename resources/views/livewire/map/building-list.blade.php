


<style>
    .card {
        display: inline-block;
        cursor: pointer;
        width: 400px;
        aspect-ratio: 1/0.7;
        border-radius: 8px;
        position: relative;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .card .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s ease-in-out;
    }

    .card::after {
        content: "";
        position: absolute;
        inset: 0;
        border: 2px solid white;
        border-radius: inherit;
        opacity: 0;
        transition: 0.4s ease-in-out;
    }

    .card:hover img {
        filter: grayscale(1) brightness(0.4);
    }

    .card:hover::after {
        opacity: 1;
        inset: 20px;
    }

    .card .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 80%;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card:hover .content {
        opacity: 1;
    }

    .content h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: white;
    }

    .content p {
        font-size: 16px;
        color: #ddd;
    }
    /* Modal styles */


    /* Responsive styles */
    @media (max-width: 480px) {
        .card {
            width: 100%;
            aspect-ratio: 1/0.6;
        }
    }
</style>

<div class="content">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Map</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
    <a href="{{ asset('/cas-floor') }}" class="card">
      <div class="image-box">
        <img src="{{ asset('assets/img/Cas.png') }}">
      </div>
      <div class="content">
        <h2>College of Art and Science</h2>
        <p>Description</p>
      </div>
    </a>
        <div class="card">
            <div class="image-box">
                <img src="{{ asset('assets/img/CBA.png') }}">
            </div>
            <div class="content">
                <h2>COMING SOON</h2>
                <!-- <h2>College of Business and Accounting</h2> -->
                <!-- <p>Description</p> -->
            </div>
        </div>
        <div class="card">
            <div class="image-box">
                <img src="{{ asset('assets/img/New Admin.png') }}">
            </div>
            <div class="content">
                <h2>COMING SOON</h2>
                <!-- <h2>Admin Building</h2> -->
                <!-- <p>Description</p> -->
            </div>
        </div>
    </div>
</div>
