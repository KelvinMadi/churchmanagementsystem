<?php
require_once 'includes/db.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;

// Get recent content for homepage
$recent_sermons = $conn->query("SELECT * FROM sermons ORDER BY date DESC LIMIT 3");
$recent_events = $conn->query("SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 3");
$recent_announcements = $conn->query("SELECT * FROM announcements WHERE is_public = 1 ORDER BY created_at DESC LIMIT 3");

$page_title = "Home";
$base_path = "";
include 'includes/header.php';
?>

<!-- Hero Section with Background Slideshow -->
<header class="hero-section position-relative text-white d-flex align-items-center tw:bg-gradient-to-b tw:from-black/20 tw:to-black/60">
    <!-- Background Slideshow -->
    <div class="hero-slideshow position-absolute w-100 h-100">
        <div class="hero-slide active" style="background-image: url('images/image1.jpg');"></div>
        <div class="hero-slide" style="background-image: url('images/image2.jpg');"></div>
        <div class="hero-slide" style="background-image: url('images/image3.jpg');"></div>
        <div class="hero-slide" style="background-image: url('images/image4.jpg');"></div>
        <div class="slideshow-overlay"></div>
    </div>
    
    <style>
        .hero-slideshow {
            position: relative;
            overflow: hidden;
        }
        
        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            z-index: 1;
        }
        
        .hero-slide.active {
            opacity: 1;
            z-index: 2;
        }
        
        .slideshow-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.5) 100%);
            z-index: 3;
        }
        
        .hero-slide {
            filter: brightness(1.1);
        }
    </style>
    
    <div class="container position-relative z-index-2">
        <div class="row min-vh-100 align-items-center">
            <div class="col-12 mx-auto text-center animate-fade-in px-3">
                <h1 class="display-4 fw-bold mb-4 tw:tracking-tight animate-slide-up">
    <span class="d-block text-warning mb-2" style="font-size: 1.2rem; letter-spacing: 2px;">WELCOME TO</span>
    <span class="d-block mb-3 position-relative">
        <span class="text-white position-relative z-2 tw:bg-gradient-to-r tw:from-yellow-400 tw:to-yellow-600 tw:bg-clip-text tw:text-transparent">
            Apostles <span class="tw:whitespace-nowrap">Revelation Society</span>
        </span>
        <span class="position-absolute bottom-0 start-0 w-100 h-1 bg-warning" style="opacity: 0.3; transform: translateY(10px);"></span>
    </span>
    <span class="d-block text-white-50 mt-3" style="font-size: 1.2rem; font-weight: 300; letter-spacing: 1px;">
        <span class="px-2 py-1 rounded" style="background: rgba(255,255,255,0.1);">
            <i class="fas fa-cross me-1"></i> A Beacon of Hope Since 1939
        </span>
    </span>
</h1>
                <p class="lead fs-4 mb-5 tw:text-white/90 animate-slide-up delay-100">A vibrant community of faith, hope, and love in Christ</p>
                <div class="d-flex flex-wrap justify-content-center gap-3 animate-scale-in delay-200">
                    <a href="#" class="btn btn-primary btn-lg px-3 px-sm-4 py-3 fw-bold text-uppercase tw:shadow-lg tw:hover:tw:-translate-y-0.5 tw:transition">
                        <i class="fas fa-church me-2"></i>Join Us Sunday
                    </a>
                    <a href="#live" class="btn btn-outline-light btn-lg px-3 px-sm-4 py-3 fw-bold text-uppercase tw:ring-1 tw:ring-white/40 tw:hover:tw:bg-white/10 tw:transition">
                        <i class="fas fa-video me-2"></i>Watch Live
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay position-absolute w-100 h-100 bg-dark opacity-50"></div>
</header>

<!-- Quick Links -->
<section class="py-5 bg-light tw:bg-gradient-to-b tw:from-white tw:to-gray-50">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 transition-all tw:hover:tw:-translate-y-1 tw:hover:tw:shadow-xl tw:transition">
                    <div class="card-body text-center p-4 tw:pt-5 tw:pb-6">
                        <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Upcoming Events</h3>
                        <p class="text-muted mb-4">Join us for worship, Bible studies, and community events throughout the week.</p>
                        <a href="events/list.php" class="btn btn-outline-primary text-uppercase fw-bold btn-sm tw:hover:tw:-translate-y-0.5 tw:transition">View Calendar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 transition-all tw:hover:tw:-translate-y-1 tw:hover:tw:shadow-xl tw:transition">
                    <div class="card-body text-center p-4 tw:pt-5 tw:pb-6">
                        <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-bible fa-2x"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Sermons & Teachings</h3>
                        <p class="text-muted mb-4">Watch or listen to our latest messages and grow in your faith journey.</p>
                        <a href="sermons/list.php" class="btn btn-outline-primary text-uppercase fw-bold btn-sm tw:hover:tw:-translate-y-0.5 tw:transition">Watch Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 transition-all tw:hover:tw:-translate-y-1 tw:hover:tw:shadow-xl tw:transition">
                    <div class="card-body text-center p-4 tw:pt-5 tw:pb-6">
                        <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-hands-helping fa-2x"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Get Involved</h3>
                        <p class="text-muted mb-4">Discover ways to serve and connect with our church community.</p>
                        <a href="ministry/" class="btn btn-outline-primary text-uppercase fw-bold btn-sm tw:hover:tw:-translate-y-0.5 tw:transition">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="py-5 bg-white tw:relative tw:overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 animate-scale-in">
                    <img src="images/founder.jpg" alt="Our Church" class="img-fluid rounded shadow tw:rounded-2xl tw:shadow-xl tw:hover:tw:-translate-y-1 tw:transition">
            </div>
            <div class="col-lg-6 ps-lg-5 animate-slide-up">
                <span class="text-primary fw-bold text-uppercase small tw:tracking-wider">Welcome to ARS</span>
                <h2 class="fw-bold mb-4 tw:text-4xl tw:leading-tight">Experience God's Love & Grace</h2>
                <p class="lead">At Apostles Revelation Society, we are committed to making disciples who love God, love people, and serve the world.</p>
                <p>Our doors are open to everyone seeking to know more about Jesus Christ and grow in their faith journey. Join us as we worship, learn, and serve together.</p>
                <div class="mt-4">
                    <a href="about.php" class="btn btn-primary text-uppercase fw-bold px-4 tw:shadow tw:hover:tw:-translate-y-0.5 tw:transition">Our Story</a>
                    <a href="#service-times" class="btn btn-outline-secondary text-uppercase fw-bold px-4 ms-2 tw:hover:tw:-translate-y-0.5 tw:transition">Service Times</a>
                </div>
            </div>
        </div>
    </div>
</section>
        
        <div class="row g-4">
            <!-- Bible Study -->
            <div class="col-lg-6">
                <div class="feature-card h-100">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="card-icon-large mb-3">
                                    <i class="fas fa-bible fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-0">Bible Study</h4>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-4">Join our weekly Bible study groups to explore God's Word together and apply biblical principles to your daily life. We offer various study groups for different age groups and life stages.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="sermons/list.php?type=bible-study" class="btn btn-outline-primary">
                                        <i class="fas fa-book-open me-2"></i>Study Resources
                                    </a>
                                    <a href="events/list.php?category=bible-study" class="btn btn-primary">
                                        <i class="fas fa-calendar-alt me-2"></i>Upcoming Studies
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Prayer Guide -->
            <div class="col-lg-6">
                <div class="feature-card h-100">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="card-icon-large mb-3">
                                    <i class="fas fa-praying-hands fa-4x text-primary"></i>
                                </div>
                                <h4 class="mb-0">Prayer Guide</h4>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-4">Access our prayer resources and submit your prayer requests. Join us for our weekly prayer meetings or use our prayer guides for personal devotion and intercession.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="prayer/submit.php" class="btn btn-outline-primary">
                                        <i class="fas fa-pray me-2"></i>Submit Request
                                    </a>
                                    <a href="prayer/guide.php" class="btn btn-primary">
                                        <i class="fas fa-bookmark me-2"></i>Prayer Guide
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Join Us For Fellowship Section -->
<section class="py-5 bg-light" id="service-times">
    <div class="container">
        <div class="section-title">
            <h2>Join Us For Fellowship</h2>
            <div class="divider"></div>
            <p class="lead">We'd love for you to join us for worship and fellowship</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="schedule-card bg-white p-4 p-lg-5 rounded-3 shadow-sm tw:ring-1 tw:ring-slate-200 tw:shadow-md">
                    <div class="row g-4">
                        <!-- Sunday Service -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
                            <div class="service-time-card text-center p-4 h-100 position-relative overflow-hidden tw:group hover:tw:shadow-2xl tw:transition-all tw:duration-500 tw:rounded-2xl tw:bg-gradient-to-br tw:from-white tw:to-gray-50 tw:hover:tw:from-white tw:hover:tw:to-primary/5">
                                <!-- Animated Background Elements -->
                                <div class="position-absolute top-0 end-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 20% 30%, rgba(230, 126, 34, 0.08) 0%, transparent 50%) no-repeat;"></div>
                                <div class="position-absolute bottom-0 start-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 80% 70%, rgba(52, 152, 219, 0.05) 0%, transparent 50%) no-repeat;"></div>
                                
                                <div class="position-relative z-2">
                                    <div class="service-icon mb-4 relative">
                                        <div class="absolute inset-0 bg-primary/10 rounded-full -z-10 tw:animate-pulse tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                        <i class="fas fa-church fa-3x text-primary tw:transition-transform tw:duration-500 group-hover:tw:scale-110"></i>
                                    </div>
                                    
                                    <h3 class="h4 mb-4 relative inline-block">
                                        <span class="relative z-10">Sunday Worship</span>
                                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary/20 -z-0 tw:scale-x-0 group-hover:tw:scale-x-100 tw:origin-left tw:transition-transform tw:duration-500"></span>
                                    </h3>
                                    
                                    <div class="service-details relative z-2">
                                        <div class="space-y-2 mb-4">
                                            <p class="flex items-center justify-center text-gray-700 group-hover:tw:text-gray-800 tw:transition-colors">
                                                <i class="far fa-clock me-2 text-primary tw-text-lg"></i>
                                                <span class="font-medium">11:00 AM - 1:00 PM</span>
                                            </p>
                                            <p class="flex items-center justify-center text-gray-600 group-hover:tw:text-gray-700 tw:transition-colors">
                                                <i class="fas fa-map-marker-alt me-2 text-primary tw-text-lg"></i>
                                                <span>Main Sanctuary</span>
                                            </p>
                                        </div>
                                        
                                        <p class="text-muted mb-4 group-hover:tw:text-gray-700 tw:transition-colors">
                                            Join us for our main worship service with inspiring music and biblical teaching.
                                        </p>
                                        
                                        <a href="#" class="btn btn-outline-primary mt-2 group relative overflow-hidden px-4 py-2 tw:rounded-full tw:border-2 tw:border-primary/20 tw:bg-white/80 tw:backdrop-blur-sm hover:tw:bg-primary hover:tw:text-white hover:tw:border-primary tw:transition-all tw:duration-300" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#serviceDetailsModal" 
                                           data-service="sunday">
                                            <span class="relative z-10 flex items-center justify-center">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <span>Service Details</span>
                                            </span>
                                            <span class="absolute inset-0 bg-primary/5 group-hover:tw:bg-primary/10 tw:transition-colors tw:duration-300"></span>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Floating Elements -->
                                <div class="absolute -top-4 -right-4 w-8 h-8 rounded-full bg-primary/10 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                <div class="absolute -bottom-2 -left-2 w-4 h-4 rounded-full bg-primary/20 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500 tw:delay-100"></div>
                            </div>
                        </div>
                        
                        <!-- Wednesday Bible Study -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                            <div class="service-time-card text-center p-4 h-100 position-relative overflow-hidden tw:group hover:tw:shadow-2xl tw:transition-all tw:duration-500 tw:rounded-2xl tw:bg-gradient-to-br tw:from-white tw:to-gray-50 tw:hover:tw:from-white tw:hover:tw:to-primary/5">
                                <!-- Animated Background Elements -->
                                <div class="position-absolute top-0 end-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 20% 30%, rgba(52, 152, 219, 0.08) 0%, transparent 50%) no-repeat;"></div>
                                <div class="position-absolute bottom-0 start-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 80% 70%, rgba(231, 76, 60, 0.05) 0%, transparent 50%) no-repeat;"></div>
                                
                                <div class="position-relative z-2">
                                    <div class="service-icon mb-4 relative">
                                        <div class="absolute inset-0 bg-primary/10 rounded-full -z-10 tw:animate-pulse tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                        <i class="fas fa-praying-hands fa-3x text-primary tw:transition-transform tw:duration-500 group-hover:tw:scale-110"></i>
                                    </div>
                                    
                                    <h3 class="h4 mb-4 relative inline-block">
                                        <span class="relative z-10">Wednesday Bible Study</span>
                                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary/20 -z-0 tw:scale-x-0 group-hover:tw:scale-x-100 tw:origin-left tw:transition-transform tw:duration-500"></span>
                                    </h3>
                                    
                                    <div class="service-details relative z-2">
                                        <div class="space-y-2 mb-4">
                                            <p class="flex items-center justify-center text-gray-700 group-hover:tw:text-gray-800 tw:transition-colors">
                                                <i class="far fa-clock me-2 text-primary tw-text-lg"></i>
                                                <span class="font-medium">7:00 PM - 8:30 PM</span>
                                            </p>
                                            <p class="flex items-center justify-center text-gray-600 group-hover:tw:text-gray-700 tw:transition-colors">
                                                <i class="fas fa-map-marker-alt me-2 text-primary tw-text-lg"></i>
                                                <span>Fellowship Hall</span>
                                            </p>
                                        </div>
                                        
                                        <p class="text-muted mb-4 group-hover:tw:text-gray-700 tw:transition-colors">
                                            Midweek Bible study and prayer meeting for spiritual growth and fellowship.
                                        </p>
                                        
                                        <a href="#" class="btn btn-outline-primary mt-2 group relative overflow-hidden px-4 py-2 tw:rounded-full tw:border-2 tw:border-primary/20 tw:bg-white/80 tw:backdrop-blur-sm hover:tw:bg-primary hover:tw:text-white hover:tw:border-primary tw:transition-all tw:duration-300" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#serviceDetailsModal" 
                                           data-service="wednesday">
                                            <span class="relative z-10 flex items-center justify-center">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <span>Study Details</span>
                                            </span>
                                            <span class="absolute inset-0 bg-primary/5 group-hover:tw:bg-primary/10 tw:transition-colors tw:duration-300"></span>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Floating Elements -->
                                <div class="absolute -top-4 -right-4 w-8 h-8 rounded-full bg-primary/10 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                <div class="absolute -bottom-2 -left-2 w-4 h-4 rounded-full bg-primary/20 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500 tw:delay-100"></div>
                            </div>
                        </div>
                        
                        <!-- Friday Prayer -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                            <div class="service-time-card text-center p-4 h-100 position-relative overflow-hidden tw:group hover:tw:shadow-2xl tw:transition-all tw:duration-500 tw:rounded-2xl tw:bg-gradient-to-br tw:from-white tw:to-gray-50 tw:hover:tw:from-white tw:hover:tw:to-primary/5">
                                <!-- Animated Background Elements -->
                                <div class="position-absolute top-0 end-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 20% 30%, rgba(231, 76, 60, 0.08) 0%, transparent 50%) no-repeat;"></div>
                                <div class="position-absolute bottom-0 start-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 80% 70%, rgba(155, 89, 182, 0.05) 0%, transparent 50%) no-repeat;"></div>
                                
                                <div class="position-relative z-2">
                                    <div class="service-icon mb-4 relative">
                                        <div class="absolute inset-0 bg-primary/10 rounded-full -z-10 tw:animate-pulse tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                        <i class="fas fa-hands-praying fa-3x text-primary tw:transition-transform tw:duration-500 group-hover:tw:scale-110"></i>
                                    </div>
                                    
                                    <h3 class="h4 mb-4 relative inline-block">
                                        <span class="relative z-10">Friday Prayer</span>
                                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary/20 -z-0 tw:scale-x-0 group-hover:tw:scale-x-100 tw:origin-left tw:transition-transform tw:duration-500"></span>
                                    </h3>
                                    
                                    <div class="service-details relative z-2">
                                        <div class="space-y-2 mb-4">
                                            <p class="flex items-center justify-center text-gray-700 group-hover:tw:text-gray-800 tw:transition-colors">
                                                <i class="far fa-clock me-2 text-primary tw-text-lg"></i>
                                                <span class="font-medium">7:00 PM - 8:30 PM</span>
                                            </p>
                                            <p class="flex items-center justify-center text-gray-600 group-hover:tw:text-gray-700 tw:transition-colors">
                                                <i class="fas fa-map-marker-alt me-2 text-primary tw-text-lg"></i>
                                                <span>Prayer Room</span>
                                            </p>
                                        </div>
                                        
                                        <p class="text-muted mb-4 group-hover:tw:text-gray-700 tw:transition-colors">
                                            Corporate prayer meeting to seek God's presence and intercede for needs.
                                        </p>
                                        
                                        <a href="#" class="btn btn-outline-primary mt-2 group relative overflow-hidden px-4 py-2 tw:rounded-full tw:border-2 tw:border-primary/20 tw:bg-white/80 tw:backdrop-blur-sm hover:tw:bg-primary hover:tw:text-white hover:tw:border-primary tw:transition-all tw:duration-300" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#serviceDetailsModal" 
                                           data-service="friday">
                                            <span class="relative z-10 flex items-center justify-center">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <span>Prayer Details</span>
                                            </span>
                                            <span class="absolute inset-0 bg-primary/5 group-hover:tw:bg-primary/10 tw:transition-colors tw:duration-300"></span>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Floating Elements -->
                                <div class="absolute -top-4 -right-4 w-8 h-8 rounded-full bg-primary/10 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                <div class="absolute -bottom-2 -left-2 w-4 h-4 rounded-full bg-primary/20 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500 tw:delay-100"></div>
                            </div>
                        </div>
                        
                        <!-- Sunday School -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                            <div class="service-time-card text-center p-4 h-100 position-relative overflow-hidden tw:group hover:tw:shadow-2xl tw:transition-all tw:duration-500 tw:rounded-2xl tw:bg-gradient-to-br tw:from-white tw:to-gray-50 tw:hover:tw:from-white tw:hover:tw:to-primary/5">
                                <!-- Animated Background Elements -->
                                <div class="position-absolute top-0 end-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 20% 30%, rgba(46, 204, 113, 0.08) 0%, transparent 50%) no-repeat;"></div>
                                <div class="position-absolute bottom-0 start-0 w-100 h-100 service-card-bg" style="background: radial-gradient(circle at 80% 70%, rgba(52, 152, 219, 0.05) 0%, transparent 50%) no-repeat;"></div>
                                
                                <div class="position-relative z-2">
                                    <div class="service-icon mb-4 relative">
                                        <div class="absolute inset-0 bg-primary/10 rounded-full -z-10 tw:animate-pulse tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                        <i class="fas fa-bible fa-3x text-primary tw:transition-transform tw:duration-500 group-hover:tw:scale-110"></i>
                                    </div>
                                    
                                    <h3 class="h4 mb-4 relative inline-block">
                                        <span class="relative z-10">Sunday School</span>
                                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary/20 -z-0 tw:scale-x-0 group-hover:tw:scale-x-100 tw:origin-left tw:transition-transform tw:duration-500"></span>
                                    </h3>
                                    
                                    <div class="service-details relative z-2">
                                        <div class="space-y-2 mb-4">
                                            <p class="flex items-center justify-center text-gray-700 group-hover:tw:text-gray-800 tw:transition-colors">
                                                <i class="far fa-clock me-2 text-primary tw-text-lg"></i>
                                                <span class="font-medium">9:45 AM - 10:45 AM</span>
                                            </p>
                                            <p class="flex items-center justify-center text-gray-600 group-hover:tw:text-gray-700 tw:transition-colors">
                                                <i class="fas fa-map-marker-alt me-2 text-primary tw-text-lg"></i>
                                                <span>Education Wing</span>
                                            </p>
                                        </div>
                                        
                                        <p class="text-muted mb-4 group-hover:tw:text-gray-700 tw:transition-colors">
                                            Bible classes for all ages before the main service. Something for everyone!
                                        </p>
                                        
                                        <a href="#" class="btn btn-outline-primary mt-2 group relative overflow-hidden px-4 py-2 tw:rounded-full tw:border-2 tw:border-primary/20 tw:bg-white/80 tw:backdrop-blur-sm hover:tw:bg-primary hover:tw:text-white hover:tw:border-primary tw:transition-all tw:duration-300" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#serviceDetailsModal" 
                                           data-service="sunday-school">
                                            <span class="relative z-10 flex items-center justify-center">
                                                <i class="fas fa-info-circle me-2"></i>
                                                <span>Class Details</span>
                                            </span>
                                            <span class="absolute inset-0 bg-primary/5 group-hover:tw:bg-primary/10 tw:transition-colors tw:duration-300"></span>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Floating Elements -->
                                <div class="absolute -top-4 -right-4 w-8 h-8 rounded-full bg-primary/10 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500"></div>
                                <div class="absolute -bottom-2 -left-2 w-4 h-4 rounded-full bg-primary/20 tw:opacity-0 group-hover:tw:opacity-100 tw:transition-opacity tw:duration-500 tw:delay-100"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <p class="mb-4">Can't join us in person? Watch our services live online!</p>
                        <a href="#" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-video me-2"></i>Watch Live
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Details Modal -->
<div class="modal fade" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceDetailsModalLabel">Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="serviceDetailsContent">
                <!-- Content will be loaded here via JavaScript -->
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="serviceDirectionsBtn" class="btn btn-primary">
                    <i class="fas fa-directions me-2"></i>Get Directions
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Recent Content</h2>
        
        <!-- Recent Sermons -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="mb-4"><i class="fas fa-book-open me-2"></i>Latest Sermons</h3>
            </div>
            <?php if ($recent_sermons && $recent_sermons->num_rows > 0): ?>
                <?php while($sermon = $recent_sermons->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($sermon['title']); ?></h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($sermon['date'])); ?>
                            </p>
                            <p class="card-text">
                                <?php echo htmlspecialchars(substr($sermon['content'], 0, 100)) . '...'; ?>
                            </p>
                            <a href="sermons/view.php?id=<?php echo $sermon['id']; ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Read More
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-muted text-center">No sermons available yet.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recent Events -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="mb-4"><i class="fas fa-calendar me-2"></i>Upcoming Events</h3>
            </div>
            <?php if ($recent_events && $recent_events->num_rows > 0): ?>
                <?php while($event = $recent_events->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($event['name']); ?></h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($event['date'])); ?>
                                <br><i class="fas fa-clock me-1"></i><?php echo date('g:i A', strtotime($event['time'])); ?>
                            </p>
                            <?php if ($event['location']): ?>
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i><?php echo htmlspecialchars($event['location']); ?>
                            </p>
                            <?php endif; ?>
                            <p class="card-text">
                                <?php echo htmlspecialchars(substr($event['description'], 0, 100)) . '...'; ?>
                            </p>
                            <a href="events/view.php?id=<?php echo $event['id']; ?>" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-eye me-1"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-muted text-center">No upcoming events scheduled.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recent Announcements -->
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4"><i class="fas fa-bullhorn me-2"></i>Latest Announcements</h3>
            </div>
            <?php if ($recent_announcements && $recent_announcements->num_rows > 0): ?>
                <?php while($announcement = $recent_announcements->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title"><?php echo htmlspecialchars($announcement['title']); ?></h5>
                                <?php if ($announcement['priority'] !== 'normal'): ?>
                                <span class="badge bg-<?php echo $announcement['priority'] === 'urgent' ? 'danger' : 'warning'; ?>">
                                    <?php echo ucfirst($announcement['priority']); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            <p class="text-muted mb-2">
                                <i class="fas fa-calendar me-1"></i><?php echo date('M j, Y', strtotime($announcement['created_at'])); ?>
                            </p>
                            <p class="card-text">
                                <?php echo htmlspecialchars(substr($announcement['content'], 0, 100)) . '...'; ?>
                            </p>
                            <a href="announcements/view.php?id=<?php echo $announcement['id']; ?>" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-eye me-1"></i>Read More
                            </a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-muted text-center">No announcements available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- About ARS Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold">Apostles Revelation Society</h2>
            <p class="lead">A Global Christian Denomination Rooted in African Heritage</p>
            <div class="divider bg-success mx-auto" style="width: 80px; height: 4px;"></div>
        </div>
        
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-4">Our History</h3>
                <p class="mb-4">The Apostles Revelation Society (ARS) was founded in 1939 by the visionary leader Charles Kwablavi Nutornti Wovenu in Tadzewu, Ghana. What began as a small prayer group has grown into a global Christian denomination that harmoniously blends African cultural expressions with biblical Christianity.</p>
                
                <div class="card bg-light border-0 mb-4">
                    <div class="card-body">
                        <h4 class="h5 fw-bold">Our Vision</h4>
                        <p class="mb-0">To be a beacon of hope and transformation, nurturing spiritual growth while preserving and celebrating our rich African Christian heritage.</p>
                    </div>
                </div>
                
                <h4 class="h5 fw-bold mt-4">Core Values</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Faith in Christ</h6>
                                <p class="small text-muted mb-0">Centered on the teachings of Jesus Christ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Cultural Identity</h6>
                                <p class="small text-muted mb-0">Celebrating African heritage in worship</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Community</h6>
                                <p class="small text-muted mb-0">Building strong, supportive relationships</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Service</h6>
                                <p class="small text-muted mb-0">Serving God by serving others</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4
                
                <div class="mt-4 d-flex gap-2">
                    <a href="gallery.php" class="btn btn-success">
                        <i class="fas fa-images me-2"></i>Our Gallery
                    </a>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="fas fa-book me-2"></i>Our Beliefs
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <img src="images/logo.webp" alt="ARS Logo" class="img-fluid">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-3">Our Global Presence</h4>
                        <p class="text-center text-muted mb-4">From its humble beginnings in Ghana, ARS has grown to establish a global presence across multiple continents, uniting believers in worship and service.</p>
                        
                        <h5 class="h6 fw-bold mb-3">International Branches:</h5>
                        <div class="row g-2">
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>Ghana</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>Canada</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>USA</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>UK</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>Germany</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center p-2 border rounded">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>France</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <h5 class="h6 fw-bold">Weekly Services</h5>
                            <div class="d-flex justify-content-center gap-3">
                                <div>
                                    <div class="fw-bold">Sundays</div>
                                    <div class="text-muted small">8:00 AM - 12:00 PM</div>
                                </div>
                                <div>
                                    <div class="fw-bold">Wednesdays</div>
                                    <div class="text-muted small">5:00 PM - 7:00 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Content Sections -->
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-lg bg-light-success text-success rounded-circle mb-3 mx-auto">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4>Community Service</h4>
                        <p class="text-muted">We are committed to serving our communities through various outreach programs, education initiatives, and social services.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-lg bg-light-primary text-primary rounded-circle mb-3 mx-auto">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Bible Study</h4>
                        <p class="text-muted">Join our weekly Bible study sessions to deepen your understanding of God's word and strengthen your faith journey.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-lg bg-light-warning text-warning rounded-circle mb-3 mx-auto">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Fellowship</h4>
                        <p class="text-muted">Experience the warmth of Christian fellowship through our various groups and activities for all ages and interests.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Apostles Revelation Society (ARS)?</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <i class="fas fa-pray fa-3x text-primary mb-3"></i>
                    <h5>Spiritual Growth</h5>
                    <p class="text-muted">Nurture your faith through meaningful worship and teaching.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <i class="fas fa-hands-helping fa-3x text-success mb-3"></i>
                    <h5>Community</h5>
                    <p class="text-muted">Connect with fellow believers in a warm, welcoming environment.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                    <h5>Love & Care</h5>
                    <p class="text-muted">Experience God's love through our caring church family.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <i class="fas fa-lightbulb fa-3x text-warning mb-3"></i>
                    <h5>Guidance</h5>
                    <p class="text-muted">Find direction and purpose through biblical teaching.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php include 'includes/footer.php'; ?>