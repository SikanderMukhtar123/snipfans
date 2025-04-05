@extends('frontend.layout')

@section('content')
<div class="container">
    <h2 class="fw-bold text-center toolHeading">YouTube Video Downloader</h2>
    <div class="card border-0 rounded mt-3">
        <div class="card-body text-white toolcard">
            <div class="input-group">
                <input type="text" name="video_url" id="url" class="form-control p-2" placeholder="Please Enter the YouTube Video URL" required>
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
                    <!-- Video Title and Details -->
                    <h3 id="videoTitle" class="fw-bold"></h3>
                    <p id="videoChannelName" class="text-muted"></p>
                    <p id="videoLikes" class="text-muted"></p>
                    <p id="videoComments" class="text-muted"></p>

                    <!-- Video Player -->
                    <video src="" id="videoPlayer" class="rounded" controls></video>

                    <!-- Download Links -->
                    <div class="mt-3">
                        <a href="" class="btn btn-success text-white d-none withoutWaterMark" id="downloadWithoutWatermark" download>Download (Best Quality)</a>
                        <a href="" class="btn btn-success text-white d-none Hd" id="downloadHD" download>Download HD</a>
                        <a href="" class="btn btn-success text-white d-none Audio" id="downloadAudio" download>Download Audio</a>
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

            if (videoUrl.length === 0) {
                alert('Please enter a valid YouTube URL.');
                return;
            }

            // Reset UI
            $('.btn-success').addClass('d-none');
            $('#videoPlayer').attr('src', '').addClass('d-none');
            $('#videoTitle, #videoChannelName, #videoLikes, #videoComments').text('');
            $('.withoutWaterMark, .Hd, .Audio').addClass('d-none');
            $('#error-message').remove();
            $('#loading').remove();

            // Show loading indicator
            $('#videoPlayer').after(`
                <p id="loading">Fetching Video... 
                    <div class="spinner-border text-primary loading" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </p>
            `);

            $.ajax({
                url: '{{ route('youtube.req') }}',  // Ensure this points to your Laravel controller for YouTube
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    url: videoUrl
                },
                success: function (data) {
                    $('#loading').remove();

                    if (data.error || (!data.no_watermark && !data.hd)) {
                        $('#videoPlayer').after(`
                            <p id="error-message" class="text-danger">Invalid URL or video not found. Please check the link.</p>
                        `);
                        return;
                    }

                    // Video title and details
                    $('#videoTitle').text(data.title);
                    $('#videoChannelName').text('Channel: ' + data.channel_name);
                    $('#videoLikes').text('Likes: ' + data.likes);
                    $('#videoComments').text('Comments: ' + data.comments);

                    // Video player (without watermark)
                    if (data.no_watermark) {
                        $('#videoPlayer').attr('src', data.no_watermark).removeClass('d-none');
                        $('.withoutWaterMark').removeClass('d-none').attr('href', data.no_watermark);
                        $('#downloadWithoutWatermark').attr('href', data.no_watermark).attr('download', 'youtube-video.mp4');
                    }

                    // HD video download
                    if (data.hd) {
                        $('.Hd').removeClass('d-none').attr('href', data.hd);
                        $('#downloadHD').attr('href', data.hd).attr('download', 'youtube-video-hd.mp4');
                    }

                    // Audio download
                    if (data.audio) {
                        $('.Audio').removeClass('d-none').attr('href', data.audio);
                        $('#downloadAudio').attr('href', data.audio).attr('download', 'youtube-audio.mp3');
                    }
                },
                error: function (xhr, status, error) {
                    $('#loading').remove();
                    console.error('Error:', xhr.responseText);
                    $('#videoPlayer').after(`
                        <p id="error-message" class="text-danger">Something went wrong. Please try again.</p>
                    `);
                },
                complete: function () {
                    $('.loading').addClass('d-none');
                    $('#loading').remove();
                }
            });
        });

        // Clear the input field
        $('#Clear').on('click', function () {
            $('#url').val('');
            $('.btn-success').addClass('d-none');
            $('#videoPlayer').attr('src', '').addClass('d-none');
            $('#videoTitle, #videoChannelName, #videoLikes, #videoComments').text('');
        });
    });
</script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{ route('youtube.views') }}',  // Ensure the route points to your view tracking controller
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                view: 1
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
