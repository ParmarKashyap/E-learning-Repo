  <?php
  $current_page = basename($_SERVER['PHP_SELF']);
  ?>

  <?php
  $current_page = basename($_SERVER['PHP_SELF']);
  date_default_timezone_set("Asia/Kolkata");
?>

<style>
    .top-bar {
    background-color: #f8f9fa; /* Light gray background */
    border-bottom: 1px solid #eee;
    font-size: 0.85rem;
    padding: 5px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #666;
}
.top-bar i {
    color: #06BBCC; /* Your primary brand color */
    margin-right: 5px;
}

</style>

<div class="top-bar d-none d-lg-flex">
    <div>
        <span><i class="fa fa-calendar-alt"></i> <?php echo date("d M Y"); ?></span>
        <span class="ms-3"><i class="fa fa-clock"></i> <span id="liveClock"><?php echo date("h:i:s A"); ?></span></span>
    </div>
    <div>
        <span>Welcome to eLEARNING Platform</span>
    </div>
</div>


<script>
    function updateTime() {
        const now = new Date();
        document.getElementById('liveClock').innerText = now.toLocaleTimeString('en-US', { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit', 
            hour12: true 
        });
    }
    setInterval(updateTime, 1000);
</script>



  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
      <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
          <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
      </a>
      <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto p-4 p-lg-0">
              <a href="./index.php" class="nav-item nav-link <?php if($current_page == './index.php') echo 'active'; ?>">Home</a>
              <a href="/elearning/pages/about.php" class="nav-item nav-link <?php if($current_page == './pages/about.php') echo 'active'; ?>">About</a>
              <a href="/elearning/pages/courses.php" class="nav-item nav-link <?php if($current_page == './pages/courses.php') echo 'active'; ?>">Courses</a>
              
              <div class="nav-item dropdown">
                  <a href="" class="nav-item nav-link dropdown-toggle <?php if($current_page == './pages/team.php' || $current_page == './pages/testimonial.php') echo 'active'; ?>" data-bs-toggle="dropdown">Details</a>
                  <div class="dropdown-menu fade-down m-0">
                      <a href="/elearning/pages/teachers.php" class="dropdown-item">Our Teachers</a>
                      <a href="/elearning/pages/testimonial.php" class="dropdown-item">Testimonials</a>
                  </div>
              </div>

              <a href="/elearning/pages/contact.php" class="nav-item nav-link <?php if($current_page == 'contact.php') echo 'active'; ?>">Contact</a>
          </div>

          <!-- Public page: Separate Login and Register buttons -->
          <div class="d-flex ms-3">
      <a href="./auth/login.php" class="btn btn-outline-primary px-4" 
        style="border-radius: 12px; font-weight: 500; height: 50px; line-height: 36px; justify-content: center;">
        Login
      </a>
      <a href="./auth/register.php" class="btn btn-primary px-3 ms-3" 
        style="border-radius: 12px; font-weight: 500; height: 50px; line-height: 36px; justify-content: center;">
        Register
      </a>
  </div>
      </div>
  </nav>
  <!-- Navbar End -->