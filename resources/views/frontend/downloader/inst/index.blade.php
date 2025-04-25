@extends('frontend.layout')

@section('content')



<style>
    .download-box {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    /* Container for each download item */
    .download-items {
        margin-bottom: 20px;
    }

    /* Thumbnail styling */
    .download-items__thumb {
        position: relative;
        display: inline-block;
    }

    .download-items__thumb img {
        width: 100%;
        height: 400px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    /* Format icon overlay */
    .format-icon {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
    }

    /* Download button styling */
    .download-items__btn a {
        display: block;
        text-align: center;
        padding: 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    /* Button specific styles */
    .dl-thumb {
        margin-top: 10px;
    }

    .download-items__btn{
        width: 20%;
        margin-left: 40%;
    }

    .abutton.is-success {
        background-color: #5cb85c;
        color: white;
    }

    .abutton.is-success.is-fullwidth {
        width: 100%;
    }

    .btn-premium.mt-3 {
        margin-top: 10px;
    }

    .abutton.is-success.is-fullwidth.btn-premium.mt-3 {
        /* background-color: #0275d8; */
        background-color: #198754;
        color: white;
    }

    .abutton i {
        margin-right: 5px;
    }

    .back-home {
        display: none;
    }
</style>
<div class="container">
    <h2 class="fw-bold text-center toolHeading">Instagram Video Downloader</h2>

    <div class="card border-0 rounded mt-3">
        <div class="card-body text-white toolcard">
            <div class="input-group">
                <input type="text" name="url" id="url" class="form-control p-2"
                    placeholder="Enter Instagram Reel URL (e.g., https://www.instagram.com/reel/xyz123)" required>
                <button class="btn text-dark bg-light fw-bold" id="Clear">Clear</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3 mb-5 border-2 rounded VideoPlayerCard">
                <div class="card-body bg-white text-center">
                    <div id="ImgThmB"></div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-success text-white d-none withoutWaterMark"
                            id="downloadWithoutWatermark" download>Without Watermark</a>

                        <a href="#" class="btn btn-success text-white d-none WaterMark" id="downloadWithWatermark"
                            download>With Watermark</a>

                        <a href="#" class="btn btn-success text-white d-none Hd" id="downloadHD" download>Download
                            HD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#url').on('input', function () {
            let videoUrl = $(this).val().trim();

            if (!videoUrl) return;

            // Show loading state if necessary (you can add a loading spinner if desired)

            // Remove previous error messages
            $('#error-message').remove();

            $.ajax({
                url: '{{ route('inst.req') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    url: videoUrl
                },
                success: function (data) {
                    var html = $(data.data); 
                    $('#ImgThmB').html(html);
                    
                },
                error: function () {
                    $('#error-message').remove();
                    // $('#videoPlayer').after(`
                    //     <p id="error-message" class="text-danger mt-2">
                    //         Something went wrong. Please try again.
                    //     </p>
                    // `);
                }
            });
        });
    });
</script>


@endsection