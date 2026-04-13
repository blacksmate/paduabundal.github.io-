<?php
$page_title = 'Home';
require_once 'includes/config.php';
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container hero-content">
        <h1>Padua Bundal Transient House</h1>
        <p class="lead">Your home away from home by the beach in Agno, Pangasinan</p>
        <a href="booking.php" class="btn btn-warning btn-lg floating-btn">Book Your Stay <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<!-- Features -->
<section class="container my-5 py-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <i class="fas fa-umbrella-beach fa-4x" style="color: var(--primary);"></i>
            <h4 class="mt-3">Beachfront Location</h4>
            <p>Steps away from Abagatanen Beach – enjoy the sun, sand, and sea.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-home fa-4x" style="color: var(--primary);"></i>
            <h4 class="mt-3">Home Comforts</h4>
            <p>Clean, cozy rooms with essential amenities for a relaxing stay.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-utensils fa-4x" style="color: var(--primary);"></i>
            <h4 class="mt-3">Local Cuisine</h4>
            <p>Authentic Pangasinan dishes available upon request.</p>
        </div>
    </div>
</section>

<!-- Special Offer -->
<div class="container mb-5">
    <div class="p-4 rounded-4 text-center text-white" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
        <h3>Weekend Special!</h3>
        <p class="mb-2">Stay 2 nights, get 1 free + complimentary breakfast</p>
        <a href="booking.php" class="btn btn-light">Book Now</a>
    </div>
</div>

<!-- Testimonials -->
<section class="bg-light py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Guest Experiences</h2>
            <p>What our visitors say about their stay</p>
        </div>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="testimonial-card mx-auto" style="max-width: 600px;">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="testimonial-avatar" alt="Avatar">
                        <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p>"Very affordable and clean! The owners are super friendly. Will definitely come back."</p>
                        <h5>- Maria Santos</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial-card mx-auto" style="max-width: 600px;">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="testimonial-avatar" alt="Avatar">
                        <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                        <p>"Great location, right in front of the beach. Perfect for budget travelers."</p>
                        <h5>- John Dela Cruz</h5>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>