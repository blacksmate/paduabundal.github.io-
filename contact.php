<?php
$page_title = 'Contact Us';
require_once 'includes/config.php';
include 'includes/header.php';
?>
<section class="container my-5 pt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="contact-form">
                <h3>Send us a Message</h3>
                <?php if(isset($_GET['toast_msg'])): ?>
                    <!-- Toast will handle this -->
                <?php endif; ?>
                <form action="send_contact.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="mb-3">
                        <textarea name="message" rows="5" class="form-control" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Send Message</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Get in Touch</h3>
            <p><i class="fas fa-map-marker-alt"></i> <?php echo LOCATION; ?></p>
            <p><i class="fas fa-phone"></i> <?php echo PHONE_1; ?> / <?php echo PHONE_2; ?></p>
            <p><i class="fas fa-envelope"></i> <?php echo SITE_EMAIL; ?></p>
            <div class="mt-4">
                <iframe src="https://maps.google.com/maps?q=Agno+Pangasinan+Philippines&t=&z=14&ie=UTF8&iwloc=&output=embed" width="100%" height="300" style="border:0; border-radius: 20px;" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>