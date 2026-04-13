<?php
$page_title = 'Rooms';
require_once 'includes/config.php';
include 'includes/header.php';
?>
<section class="container my-5 pt-5">
    <div class="section-header text-center mb-5">
        <h2>Our Rooms & Rates</h2>
        <p>Comfortable accommodations for every budget</p>
    </div>
    <div class="row">
        <?php
        $rooms = [
            ['name' => 'Standard Room', 'price' => 1200, 'desc' => 'Comfortable room with fan, private bathroom, and beach view.', 'img' => 'https://images.pexels.com/photos/271618/pexels-photo-271618.jpeg'],
            ['name' => 'Family Suite', 'price' => 2200, 'desc' => 'Two bedrooms, air conditioning, kitchenette, sea view.', 'img' => 'https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg'],
            ['name' => 'Dormitory Bed', 'price' => 500, 'desc' => 'Shared bunk bed, ideal for backpackers. Fan and common bath.', 'img' => 'https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg']
        ];
        foreach($rooms as $room):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card room-card h-100 border-0">
                <img src="<?php echo $room['img']; ?>" class="card-img-top" alt="<?php echo $room['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $room['name']; ?></h5>
                    <p class="card-text"><?php echo $room['desc']; ?></p>
                    <p class="price-badge">₱<?php echo number_format($room['price']); ?>/night</p>
                    <a href="booking.php" class="btn btn-warning mt-2 w-100">Book Now</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>