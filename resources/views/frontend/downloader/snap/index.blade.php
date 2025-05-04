@extends('frontend.layout')

@section('content')

<style>
    #downloadWithoutWatermark {
        width: 30%;
    }

    #thmbId {
        width: 30%;
    }


    @media screen and (max-width: 375px) {

        #thmbId {
            width: 70%;
        }

        #downloadWithoutWatermark {
            width: 75%;
        }
    }


    @media screen and (min-width: 375px) and (max-width: 475px) {



        #thmbId {
            width: 60%;
        }


        #downloadWithoutWatermark {
            width: 56%;
        }
    }

    @media screen and (min-width: 475px) and (max-width: 768px) {


        #thmbId {
            width: 30%;
        }


        #downloadWithoutWatermark {
            width: 30%;
        }


    }
</style>

<div class="container">
    <h2 class="fw-bold text-center toolHeading">SnapChat Video Downloader</h2>
    <div class="card border-0 rounded mt-3">
        <div class="card-body text-white toolcard">
            <div class="input-group">
                <input type="text" name="url" id="url" class="form-control p-2"
                    placeholder="Please Enter the SnapChat video URL" required>
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
                url: '{{ route('snap.req') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    url: videoUrl
                },
                success: function (data) {
                    console.log(data);
                    $('#loading').remove();
                    $('#videoPlayerDemo').addClass('d-none');

                    var url = data.data.medias[0].url;  

                    $('#ImgThmB').html( 
                        '<img id="thmbId" src="' + data.data.thumbnail + '" class="rounded"/>' +
                        '<div class="mt-3">' +
                            '<button class="btn btn-success text-white withoutWaterMark" id="downloadWithoutWatermark">Download Video</button>' +
                        '</div>'
                    );

                    // When the button is clicked, trigger the download
                    $('#downloadWithoutWatermark').click(function () {
                        var $btn = $(this);
                        
                        // Store original text and show loading state
                        var originalText = $btn.html();
                        $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Downloading...')
                            .prop('disabled', true);

                        fetch(url)
                            .then(response => response.blob())
                            .then(blob => {
                                var blobURL = URL.createObjectURL(blob);

                                var a = document.createElement('a');
                                a.href = blobURL;
                                a.download = 'snapchat-video.mp4';  // Clean file name
                                document.body.appendChild(a);
                                a.click();
                                document.body.removeChild(a);
                                URL.revokeObjectURL(blobURL);
                            })
                            .catch(error => {
                                console.error("Error fetching video:", error);
                                alert("Failed to download video. Please try again.");
                            })
                            .finally(() => {
                                // Reset button after download attempt
                                $btn.html(originalText).prop('disabled', false);
                            });
                    });

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