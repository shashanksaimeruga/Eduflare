<!-- @format -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Video Player with Playlist</title>
    <!-- Bootstrap 5 CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      / Custom Styles /
      body {
        background-color: #2a2a2a;
        color: white;
      }

      .video-section {
        margin-top: 30px;
      }

      .video-player {
        width: 100%;
        height: auto;
      }

      .video-list {
        background-color: #333;
        padding: 10px;
        border-radius: 5px;
      }

      .video-list h5 {
        margin-bottom: 15px;
      }

      .video-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #444;
      }

      .video-item:last-child {
        border-bottom: none;
      }

      .video-thumbnail {
        width: 120px;
        height: 80px;
        background-color: #ccc;
        margin-right: 15px;
      }

      .video-title {
        flex-grow: 1;
      }

      .video-duration {
        color: #aaa;
      }

      .video-item.active {
        background-color: #444;
      }

      .video-item.active .video-title {
        color: #a746e9;
      }
    </style>
  </head>

  <body>
    <div class="container video-section">
      <div class="row">
        <!-- Video Player Section -->
        <div class="col-md-8">
          <div class="video-player">
            <video width="100%" height="480" controls>
              <source src="path-to-your-video.mp4" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
          </div>
        </div>

        <!-- Video Playlist Section -->
        <div class="col-md-4">
          <div class="video-list">
            <h5>Free Sample Videos:</h5>
            <!-- Video Item 1 (Active) -->
            <div class="video-item active">
              <div class="video-thumbnail">
                <img src="thumbnail1.jpg" alt="Video 1" class="img-fluid" />
              </div>
              <div class="video-title">
                iOS & Swift - The Complete iOS App Development Bootcamp
              </div>
              <div class="video-duration">04:02</div>
            </div>

            <!-- Video Item 2 -->
            <div class="video-item">
              <div class="video-thumbnail">
                <img src="thumbnail2.jpg" alt="Video 2" class="img-fluid" />
              </div>
              <div class="video-title">
                Intro to the Course. What's coming up?
              </div>
              <div class="video-duration">04:02</div>
            </div>

            <!-- Video Item 3 -->
            <div class="video-item">
              <div class="video-thumbnail">
                <img src="thumbnail3.jpg" alt="Video 3" class="img-fluid" />
              </div>
              <div class="video-title">How does an App Work?</div>
              <div class="video-duration">07:47</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>