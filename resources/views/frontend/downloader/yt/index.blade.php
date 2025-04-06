@extends('frontend.layout')

@section('content')
<div class="container">
    <h2 class="fw-bold text-center toolHeading">YouTube Video Downloader</h2>

    <div class="card border-0 rounded mt-3">
        <div class="card-body text-white toolcard">
            <div class="input-group">
                <input type="text" name="url" id="url" class="form-control p-2"
                    placeholder="Enter YouTube video URL like: https://www.youtube.com/watch?v=abc123" required>
                <button class="btn text-dark bg-light fw-bold" id="Clear">Clear</button>
            </div>
            <div id="error-message" class="text-danger mt-2"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3 mb-5 border-2 rounded VideoPlayerCard">
                <div class="card-body bg-white text-center">
                    <!-- Thumbnail -->
                    <!-- Video Title -->
                    <h5 id="videoTitle" class="fw-bold text-dark d-none"></h5>
                    <!-- Video Player -->
                    <video src="" id="videoPlayer" class="rounded d-none mt-2" controls></video>
                    <div class="text-center">
                        <img id="videoThumbnail" class="rounded d-none mb-2" width="150">
                    </div>
                    <div id="loading" class="mt-3 d-none">
                        <p>Fetching Video...
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        </p>
                    </div>

                    <div class="mt-3">
                        <a href="" class="btn btn-success text-white d-none" id="downloadWithoutWatermark"
                            download>Without Watermark</a>
                        <a href="" class="btn btn-success text-white d-none" id="downloadWithWatermark" download>With
                            Watermark</a>
                        <a href="" class="btn btn-success text-white d-none" id="downloadHD" download>Download HD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSRF token for Ajax --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#Clear').on('click', function () {
            $('#url').val('');
            $('#videoPlayer').attr('src', '').addClass('d-none');
            $('.btn-success').addClass('d-none');
            $('#error-message').text('');
            $('#videoThumbnail').addClass('d-none');
            $('#videoTitle').addClass('d-none');
        });

        $('#url').on('input', function () {
            let videoUrl = $(this).val().trim();

            $('#error-message').text('');
            $('#videoPlayer').addClass('d-none').attr('src', '');
            $('.btn-success').addClass('d-none');
            $('#loading').addClass('d-none');
            $('#videoThumbnail').addClass('d-none');
            $('#videoTitle').addClass('d-none');

            $('#loading').removeClass('d-none');

            $.ajax({
                url: '{{ route("youtube.req") }}',  // Make sure the route is correct
                type: 'POST',
                data: {
                    _token: csrfToken,
                    url: videoUrl
                },
                success: function (data) {
                    $('#loading').addClass('d-none');

                    if (data.error || (!data.no_watermark && !data.watermark && !data.hd)) {
                        $('#error-message').text('Invalid URL or video not found. Please check the link.');
                        return;
                    }

                    if (data.title) {
                        $('#videoTitle').removeClass('d-none').text(data.title);
                    }

                    if (data.thumbnail) {
                        $('#videoThumbnail').removeClass('d-none').attr('src', data.thumbnail);
                    }

                    if (data.no_watermark) {
                        $('#videoPlayer').removeClass('d-none').attr('src', data.no_watermark);
                        $('#downloadWithoutWatermark').removeClass('d-none').attr('href', data.no_watermark);
                    }

                    if (data.watermark) {
                        $('#downloadWithWatermark').removeClass('d-none').attr('href', data.watermark);
                    }

                    if (data.hd) {
                        $('#downloadHD').removeClass('d-none').attr('href', data.hd);
                    }
                },
                error: function (xhr) {
                    $('#loading').addClass('d-none');
                    $('#error-message').text('Something went wrong. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection 