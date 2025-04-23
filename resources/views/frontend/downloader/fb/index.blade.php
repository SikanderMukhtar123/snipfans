@extends('frontend.layout')

@section('content')
<div class="container">
    <h2 class="fw-bold text-center toolHeading">Facebook Video Downloader</h2>
    <div class="card border-0 rounded mt-3">
        <div class="card-body text-white toolcard">
            <div class="input-group">
                <input type="text" name="videoUrl" id="url" class="form-control p-2" placeholder="Please Enter the Facebook video URL" required>
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
                    <video src="" id="videoPlayer" class="rounded" controls></video>
                    <div class="mt-3">
                        <button  class="btn btn-success text-white d-none withoutWaterMark" id="downloadWithoutWatermark" download>Download</button>
                        <button class="btn btn-success text-white d-none WaterMark" id="downloadWithWatermark" download>Download HD</button>
                        <button class="btn btn-success text-white d-none Hd" id="downloadHD" download>Download HD</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="error-message"></div>
<div id="loading"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#url').on('input', function () {
            let videoUrl = $(this).val().trim();

            if (videoUrl.length === 0) {
                alert('Please enter a valid URL.');
                return;
            }

            $('.btn-success').addClass('d-none');
            $('#videoPlayer').attr('src', '').addClass('d-none');
            $('.withoutWaterMark, .WaterMark, .Hd').addClass('d-none');
            $('#error-message').remove();
            $('#loading').remove();

            $('#videoPlayer').after(`
                <p id="loading">Fetching Video .... 
                    <div class="spinner-border text-primary loading" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </p>
            `);

            $.ajax({
                url: '{{ route('fb.video') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    videoUrl: videoUrl
                },
                success: function (data) {
                    $('#loading').remove();

                    if (data.error || (!data.sd_video_url && !data.hd_video_url)) {
                        $('#videoPlayer').after(`
                            <p id="error-message" class="text-danger">Invalid URL or video not found. Please check the link.</p>
                        `);
                        return;
                    }

                    if (data.sd_video_url) {
                        $('#videoPlayer').attr('src', data.sd_video_url).removeClass('d-none');
                        $('.withoutWaterMark').removeClass('d-none').attr('href', data.sd_video_url);
                        $('#downloadWithoutWatermark').attr('href', data.sd_video_url).attr('download', 'facebook-video-sd.mp4');
                    }

                    if (data.hd_video_url) {
                        $('.WaterMark').removeClass('d-none').attr('href', data.hd_video_url);
                        $('#downloadWithWatermark').attr('href', data.hd_video_url).attr('download', 'facebook-video-hd.mp4');
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

        // Directly download video on click of download button
        $(document).on('click', '.btn-success', function (e) {
            e.preventDefault();
            var downloadUrl = $(this).attr('href');
            if (downloadUrl) {
                // Trigger the download on the same page
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = a.href.split('/').pop();  // Use the filename from the URL
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);  // Remove the element after clicking
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{ route('fb.views') }}',
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
