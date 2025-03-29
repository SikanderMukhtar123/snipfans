@extends('frontend.layout')
@section('content')
    <div class="container">
        <h2 class="mt-3 mb-2 text-center">TikTok Video Downloader</h2>
        <div class="card border-0 rounded mt-3">
            <div class="card-body text-white toolcard">
                <div class="input-group">
                    <input type="text" name="url" id="url" class="form-control p-2"
                        placeholder="Please Enter the url like this : https://www.tiktok.com/@username/video/123" required>
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
                            <a href="" class="btn btn-success text-white d-none withoutWaterMark"
                                id="downloadWithoutWatermark" download>Without Watermark</a>
                            <a href="" class="btn btn-success text-white d-none WaterMark" id="downloadWithWatermark"
                                download>With Watermark</a>
                            <a href="" class="btn btn-success text-white d-none Hd" id="downloadHD" download>Download HD</a>
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
                    url: '{{ route('tiktok.req') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        url: videoUrl
                    },
                    success: function (data) {
                        $('#loading').remove();

                        if (data.error || (!data.no_watermark && !data.watermark && !data.hd)) {
                            $('#videoPlayer').after(`
                                                                                                                            <p id="error-message" class="text-danger">Invalid URL or video not found. Please check the link.</p>
                                                                                                                        `);
                            return;
                        }

                        if (data.no_watermark) {
                            $('#videoPlayer').attr('src', data.no_watermark).removeClass('d-none');
                            $('.withoutWaterMark').removeClass('d-none').attr('href', data.no_watermark);
                            $('#downloadWithoutWatermark').attr('href', data.no_watermark).attr('download', 'tiktok-video.mp4');
                        }

                        if (data.watermark) {
                            $('.WaterMark').removeClass('d-none').attr('href', data.watermark);
                            $('#downloadWithWatermark').attr('href', data.watermark).attr('download', 'tiktok-video-watermarked.mp4');
                        }

                        if (data.hd) {
                            $('.Hd').removeClass('d-none').attr('href', data.hd);
                            $('#downloadHD').attr('href', data.hd).attr('download', 'tiktok-video-hd.mp4');
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
        });
    </script>


    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{ route('tiktok.views') }}',
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