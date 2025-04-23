<style>
    .navbar {
        padding: 12px 0px;
        box-shadow: 0 0 10px 0 rgb(0 0 0 / 20%);
    }

    .active {
        color: #00b12b !important;
        font-weight: 900;
    }


    /* responsive css start */

    .navbar-brand img {
        width: 40%;
        height: auto;
    }

    .ToolCard img {
        max-width: 40%;
        height: 55px;
    }


    .category_name {
        /* font-size: 25px; */
        font-weight: 900;
    }

    .toolHeading {
        margin: 45px 0px;
    }


    @media (max-width:375px) {

        .navbar-toggler {
            font-size: 12px
        }

        .navbar-brand img {
            width: 140px;
            height: auto;
        }

        .ToolCard img {
            width: 25%;
            height: auto;
        }

        .ToolCard h5 {
            font-size: 14px;
        }

        .category_name {
            font-size: 20px;
            font-weight: 900;
        }

        .toolHeading {
            font-size: 20px;

            margin: 35px 0px;

        }

        .withoutWaterMark {
            margin: 5px 0px;
        }

        .WaterMark {
            width: 160px;
        }
    }

    @media (min-width:375px) and (max-width: 425px) {

        .navbar-toggler {
            font-size: 15px
        }

        .navbar-brand img {
            width: 160px;
            height: auto;
        }

        .ToolCard img {
            width: 35%;
            height: auto;
        }

        .ToolCard h5 {
            font-size: 18px;
        }

        .category_name {
            font-size: 25px;
            font-weight: 900;
        }

        .toolHeading {
            font-size: 20px;
            margin: 35px 0px;
        }

        .withoutWaterMark {
            margin: 5px 0px;
        }

        .WaterMark {
            width: 160px;
        }
    }



    @media (min-width:425px) and (max-width: 768px) {

        .navbar-toggler {
            font-size: 18px
        }

        .navbar-brand img {
            width: 200px;
            height: auto;
        }


        .ToolCard img {
            width: 35%;
            height: auto;
        }

        .ToolCard h5 {
            font-size: 18px;
        }

        .category_name {
            font-size: 25px;
            font-weight: 900;
        }
    }
</style>
<nav class="navbar navbar-expand-lg bg-white justify-content-end">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('logo2.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>