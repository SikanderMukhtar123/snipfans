@extends('frontend.layout')

@section('content')

<style>
    .download-box {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .download-items {
        margin-bottom: 20px;
    }

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

    .format-icon {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
    }

    .download-items__btn a {
        display: block;
        text-align: center;
        padding: 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .dl-thumb {
        margin-top: 10px;
    }

    .download-items__btn {
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
        background-color: #198754;
        color: white;
    }

    .abutton i {
        margin-right: 5px;
    }

    .back-home {
        display: none;
    }

    @media screen and (max-width: 375px) {
        .download-items__btn {
            width: 100%;
            margin-left: 0;
        }

        .download-items__thumb img {
            height: auto;
        }
    }


    @media screen and (min-width: 375px) and (max-width: 475px) {
        .download-items__btn {
            width: 100%;
            margin-left: 0%;
        }
    }

    @media screen and (min-width: 475px) and (max-width: 768px) {
        .download-items__btn {
            width: 35%;
            margin-left: 33%;
        }


    }
</style>

<div class="container">
    <h2 class="fw-bold text-center toolHeading">Instagram Video Downloader</h2>
    <div class="card border-0 rounded mt-3">
        <div class="card-body text-white toolcard">
            <div class="input-group">
                <input type="text" name="url" id="url" class="form-control p-2"
                    placeholder="Please Enter the Instagram video URL" required>
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
                    <div id="ImgThmB">
                        <video src="" id="videoPlayerDemo" style="width: 60%; height : 400px;" class="rounded"
                            controls></video>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-success text-white d-none withoutWaterMark"
                            id="downloadWithoutWatermark" download>Without Watermark</a>

                        <a href="#" class="btn btn-success text-white d-none WaterMark" id="downloadWithWatermark"
                            download>With Watermark</a>

                        <a href="#" class="btn btn-success text-white d-none Hd" id="downloadHD" download>Download
                            HD</a>
                    </div>

                    <!-- Error message -->
                    <div id="error-message" class="text-danger mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#url').on('input', function () {
            let videoUrl = $(this).val().trim();

            if (videoUrl.length === 0) return;

            // Reset UI
            $('#videoPlayer').attr('src', '').addClass('d-none');
            $('#error-message').text('');
            $('#loading').remove();
            $('#videoPlayerDemo').remove();

            // Show loading spinner
            $('#ImgThmB').html(`
                <p id="loading">Fetching Video...
                    <div class="spinner-border text-primary loading" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </p>
            `);

            $.ajax({
                url: '{{ route('inst.req') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    url: videoUrl
                },
                success: function (data) {
                    $('#loading').remove();
                    $('#videoPlayerDemo').addClass('d-none');


                    var html = $(data.data); 
                    $('#ImgThmB').html(html);
                   
                },
                error: function () {
                    $('#loading').remove();
                    $('#videoPlayerDemo').remove();
                    $('#error-message').text("Something went wrong. Please try again.");
                }
            });
        });

        $('#Clear').click(function () {
            $('#url').val('');
            $('#videoPlayerDemo').removeClass('d-none');
            $('#ImgThmB').html('');
            $('#error-message').text('');
            $('#loading').remove();
        });
    });
</script>


<script>
    $(document).ready(function () {
            $.ajax({
                url: '{{ route('in.views') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    view: 1,
                },
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
</script>

@endsection