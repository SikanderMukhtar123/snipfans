<style>
  .footer {
    /* background: #2c3e50; */
    background: #013425;
    color: white;
    padding: 40px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .container {
    width: 90%;
    max-width: 1200px;
  }

  .footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    text-align: center;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }

  .footer-section h4 {
    font-size: 18px;
    margin-bottom: 15px;
    color: #f39c12;
  }

  .footer-links p {
    margin: 5px 0;
  }

  .footer-links a {
    text-decoration: none;
    color: white;
    font-size: 14px;
    transition: color 0.3s ease;
  }

  .footer-links a:hover {
    color: #f39c12;
  }

  .upperfooter {
    margin: 20px 0;
    display: flex;
    gap: 15px;
  }

  .upperfooter a {
    color: #f39c12;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
  }

  .upperfooter a:hover {
    color: white;
  }

  .lowerfooter {
    margin-top: 10px;
    text-align: center;
    font-size: 14px;
  }

  .lowerfooter a {
    color: #f39c12;
    text-decoration: none;
    font-weight: bold;
  }

  @media (max-width: 768px) {
    .footer-container {
      grid-template-columns: 1fr;
      text-align: left;
    }
  }
</style>

<footer class="footer">
  <div class="container">
    <div class="footer-container">
      <div class="footer-section">
        <div class="footer-links">
          <h4>Video Downloading Tools</h4>
          @foreach ($toolsData as $list)
        <p><a href="{{ url($list->slug) }}">{{ $list->tool_name }}</a></p>
         @endforeach
          <!-- <p><a href="#">Image Resizer</a></p>
          <p><a href="#">Image Encoder</a></p> -->
        </div>
      </div>
      <!-- <div class="footer-section">
        <div class="footer-links">
          <h4>CSS Tools</h4>
          <p><a href="#">Box Shadow</a></p>
          <p><a href="#">Box Border</a></p>
          <p><a href="#">Box Border Radius</a></p>
        </div>
      </div> -->
      <!-- <div class="footer-section">
        <div class="footer-links">
          <h4>Templates</h4>
          <p><a href="#">Bootstrap 5</a></p>
          <p><a href="#">Bootstrap 4</a></p>
          <p><a href="#">Login and Signup</a></p>
        </div>
      </div> -->
      <!-- <div class="footer-section">
        <div class="footer-links">
          <h4>SEO Tools</h4>
          <p><a href="#">XML Sitemap Generator</a></p>
          <p><a href="#">Robots.txt Generator</a></p>
          <p><a href="#">Broken Links Finder</a></p>
        </div>
      </div> -->
      <!-- <div class="footer-section">
        <div class="footer-links">
          <h4>UI Elements</h4>
          <p><a href="#">CSS Buttons</a></p>
          <p><a href="#">CSS Loaders</a></p>
        </div>
      </div> -->
    </div>
  </div>

  <div class="upperfooter">
    <a href="{{ url('/')  }}">Home</a>
    <!-- <a href="#">SiteMap</a> -->
  </div>

  <div class="lowerfooter">
    <small>Copyright © 2025 <a href="#"><strong>Snip Fans</strong></a>. All rights reserved.</small>
  </div>
</footer>



<script>
  $('#Clear').on('click', function () {
    $('#url').val('');
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>