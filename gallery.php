<?php
$page_title = 'Gallery';
require_once 'includes/config.php';
include 'includes/header.php';
?>
<section class="container my-5 pt-5">
    <div class="section-header text-center mb-5">
        <h2>Photo Gallery</h2>
        <p>Take a glimpse of Padua Bundal and Abagatanen Beach</p>
    </div>
    <div class="row g-3">
        <?php
        $gallery = [
            'https://images.pexels.com/photos/1134176/pexels-photo-1134176.jpeg',
            'https://images.pexels.com/photos/338504/pexels-photo-338504.jpeg',
            'https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg',
            'https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg',
            'https://images.pexels.com/photos/8357209/pexels-photo-8357209.jpeg',
            'https://images.pexels.com/photos/2387873/pexels-photo-2387873.jpeg'
        ];
        foreach($gallery as $img):
        ?>
        <div class="col-md-4">
            <div class="gallery-item">
                <img src="<?php echo $img; ?>" class="img-fluid w-100" alt="Gallery">
                <div class="gallery-overlay">
                    <p class="mb-0">Padua Bundal Experience</p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>