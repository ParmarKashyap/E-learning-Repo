<?php
// Include your navigation bar
include('./includes/nav.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning | Master New Skills</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/elearning/css/style.css">
    <style>
        /* Custom UI Tweaks to match your Teal/Cyan theme */
        .text-teal { color: #00bcd4 !important; }
        .bg-teal { background-color: #00bcd4 !important; }
        .btn-teal { background-color: #00bcd4; color: white; border: none; }
        .btn-teal:hover { background-color: #0097a7; color: white; }
        .hero-bg { background-color: #f4fbfb; }

        /* Footer Custom Styles */
.footer-link {
    color: #aeb1b8;
    text-decoration: none;
    transition: color 0.3s ease;
}
.footer-link:hover {
    color: #00bcd4; /* Matches your Teal theme */
}
.social-icon {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #00bcd4;
    color: #00bcd4;
    border-radius: 50%;
    transition: all 0.3s ease;
}
.social-icon:hover {
    background-color: #00bcd4;
    color: #fff;
}

    </style>
</head>
<body>

    <section class="hero-bg text-center py-5 shadow-sm">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3">Welcome to Online Learning Platform</h1>
            <p class="lead text-muted mb-4">Learn Anytime, Anywhere. Elevate your programming and development skills.</p>
            
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="https://www.google.com/search" method="GET" target="_blank" class="input-group input-group-lg shadow-sm">
                      <input type="hidden" name="as_q" value="course tutorial"> 
                      <input type="text" name="q" class="form-control" placeholder="What do you want to learn today? (e.g., PHP, MySQL)" required>
                      <button class="btn btn-teal px-4" type="submit"><i class="bi bi-search"></i> Search</button>
                    </form>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="auth/register.php" class="btn btn-teal btn-lg me-2">Get Started</a>
                <a href="courses.php" class="btn btn-outline-secondary btn-lg">Browse Courses</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-md-4">
                    <i class="bi bi-laptop display-4 text-teal mb-3"></i>
                    <h4 class="fw-bold">Learn Online</h4>
                    <p class="text-muted">Access our materials from anywhere in the world on any device.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-person-video3 display-4 text-teal mb-3"></i>
                    <h4 class="fw-bold">Expert Instructors</h4>
                    <p class="text-muted">Learn from industry professionals with real-world experience.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-award display-4 text-teal mb-3"></i>
                    <h4 class="fw-bold">Earn Certificates</h4>
                    <p class="text-muted">Get certified upon completion to boost your resume.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Top Categories</h2>
            <div class="row g-4 text-center">
                <div class="col-md-3 col-6">
                    <div class="card p-4 border-0 shadow-sm category-card">
                        <i class="bi bi-code-slash fs-1 text-teal"></i>
                        <h6 class="mt-3 fw-bold">Web Development</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card p-4 border-0 shadow-sm category-card">
                        <i class="bi bi-database fs-1 text-teal"></i>
                        <h6 class="mt-3 fw-bold">Data Science</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card p-4 border-0 shadow-sm category-card">
                        <i class="bi bi-brush fs-1 text-teal"></i>
                        <h6 class="mt-3 fw-bold">UI/UX Design</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card p-4 border-0 shadow-sm category-card">
                        <i class="bi bi-phone fs-1 text-teal"></i>
                        <h6 class="mt-3 fw-bold">Mobile Apps</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Popular Courses</h2>
                <a href="./pages/courses.php" class="text-teal text-decoration-none fw-bold">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            
            <div class="row g-4">
                <?php
                // Simulated array representing database fetch
                // In the future, this will be: SELECT * FROM courses LIMIT 3;
                $courses = [
                    ['title' => 'Advanced PHP Backend Development', 'instructor' => 'John Doe', 'price' => 'Free', 'icon' => 'filetype-php'],
                    ['title' => 'Complete MySQL Bootcamp', 'instructor' => 'Jane Smith', 'price' => '₹499', 'icon' => 'database-check'],
                    ['title' => 'Bootstrap 5 Responsive Design', 'instructor' => 'Mike Johnson', 'price' => '₹299', 'icon' => 'bootstrap']
                ];

                foreach($courses as $course) {
                ?>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm course-card">
                            <div class="bg-light text-center py-5 rounded-top">
                                <i class="bi bi-<?php echo $course['icon']; ?> display-1 text-secondary"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $course['title']; ?></h5>
                                <p class="card-text text-muted small">By <?php echo $course['instructor']; ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="fw-bold fs-5 text-teal"><?php echo $course['price']; ?></span>
                                    <a href="course_details.php" class="btn btn-sm btn-outline-dark">Enroll Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="bg-teal text-white py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-3 col-6 mb-3">
                    <h2 class="fw-bold display-5">15+</h2>
                    <p class="mb-0">Expert Tutors</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <h2 class="fw-bold display-5">1k+</h2>
                    <p class="mb-0">Active Students</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <h2 class="fw-bold display-5">50+</h2>
                    <p class="mb-0">Online Courses</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <h2 class="fw-bold display-5">100%</h2>
                    <p class="mb-0">Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-5 pb-4 mt-auto" style="background-color: #1a1e23; color: #aeb1b8;">
        <div class="container text-md-start">
            <div class="row text-center text-md-start">
                
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 mb-4">
                    <h4 class="text-uppercase fw-bold mb-4" style="color: #00bcd4;">
                        eLEARNING
                    </h4>
                    <p class="small">
                        Empowering students to achieve their coding and development goals through accessible, high-quality online education. Start your learning journey today.
                    </p>
                    <div class="mt-4">
                        <a href="#" class="social-icon me-2 text-decoration-none"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon me-2 text-decoration-none"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon me-2 text-decoration-none"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon me-2 text-decoration-none"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4 text-white">Categories</h5>
                    <p class="mb-2"><a href="#" class="footer-link">Web Development</a></p>
                    <p class="mb-2"><a href="#" class="footer-link">PHP & MySQL</a></p>
                    <p class="mb-2"><a href="#" class="footer-link">UI/UX Design</a></p>
                    <p class="mb-2"><a href="#" class="footer-link">Data Science</a></p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4 text-white">Useful Links</h5>
                    <p class="mb-2"><a href="dashboard.php" class="footer-link">Student Account</a></p>
                    <p class="mb-2"><a href="instructor_reg.php" class="footer-link">Become an Instructor</a></p>
                    <p class="mb-2"><a href="faq.php" class="footer-link">Help & FAQ</a></p>
                    <p class="mb-2"><a href="about.php" class="footer-link">About Us</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4 text-white">Contact</h5>
                    <p class="small mb-2"><i class="bi bi-geo-alt-fill me-2" style="color: #00bcd4;"></i>404, TechVision Complex, 150 Feet Ring Road, Rajkot, Gujarat 360005, India</p>
                    <p class="small mb-2"><i class="bi bi-envelope-fill me-2" style="color: #00bcd4;"></i> support@elearning.com</p>
                    <p class="small mb-2"><i class="bi bi-telephone-fill me-2" style="color: #00bcd4;"></i> +91 98765 43210</p>
                </div>
                
            </div>
            
            <hr class="mb-4 mt-2" style="border-color: rgba(255,255,255,0.1);">
            
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="small mb-0">
                        Copyright &copy; <?php echo date('Y'); ?> All rights reserved by: 
                        <a href="index.php" style="text-decoration: none; color: #00bcd4; font-weight: 600;">eLEARNING</a>
                    </p>
                </div>
                <div class="col-md-5 col-lg-4 mt-3 mt-md-0">
                    <div class="text-center text-md-end small">
                        <a href="privacy.php" class="footer-link me-3">Privacy Policy</a>
                        <a href="terms.php" class="footer-link">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/elearning/js/main.js"></script>
</body>
</html>