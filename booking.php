<?php
$page_title = 'Book Your Stay';
require_once 'includes/config.php';
include 'includes/header.php';
?>
<style>
.booking-step { display: none; }
.booking-step.active { display: block; animation: fadeIn 0.5s ease; }
.step-indicator { display: flex; justify-content: space-between; margin-bottom: 2rem; position: relative; }
.step-indicator::before { content: ''; position: absolute; top: 20px; left: 0; width: 100%; height: 2px; background: #dee2e6; z-index: 0; }
.step { background: white; border: 2px solid #dee2e6; border-radius: 50px; padding: 0.5rem 1.5rem; font-weight: 600; color: #6c757d; position: relative; z-index: 1; background-color: #f8f9fa; transition: all 0.3s; }
.step.active { background: #f39c12; border-color: #f39c12; color: white; }
.step.completed { background: #28a745; border-color: #28a745; color: white; }
.room-option { border: 2px solid #e9ecef; border-radius: 15px; padding: 1rem; margin-bottom: 1rem; cursor: pointer; transition: all 0.2s; }
.room-option:hover, .room-option.selected { border-color: #f39c12; background: #fff5e6; }
.price-estimate { background: #f8f9fa; border-radius: 15px; padding: 1rem; margin-top: 1.5rem; text-align: center; }
.price-tag { font-size: 2rem; font-weight: bold; color: #f39c12; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="container my-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                    <h2 class="mb-0"><i class="fas fa-calendar-check"></i> Reserve Your Stay</h2>
                    <p class="mb-0">Fill in your details – we'll confirm availability</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="step-indicator">
                        <div class="step active" data-step="1">1. Personal Info</div>
                        <div class="step" data-step="2">2. Room & Dates</div>
                        <div class="step" data-step="3">3. Confirm</div>
                    </div>
                    <form id="bookingForm" action="send_booking.php" method="POST">
                        <!-- Step 1 -->
                        <div class="booking-step active" id="step1">
                            <h4 class="mb-3"><i class="fas fa-user-circle"></i> Your Details</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Full Name *</label><input type="text" name="name" class="form-control" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Email Address *</label><input type="email" name="email" class="form-control" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Phone Number *</label><input type="tel" name="phone" class="form-control" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Number of Guests *</label><input type="number" name="guests" class="form-control" min="1" max="10" value="2" required></div>
                            </div>
                            <div class="d-flex justify-content-end mt-3"><button type="button" class="btn btn-warning next-step">Continue <i class="fas fa-arrow-right"></i></button></div>
                        </div>
                        <!-- Step 2 -->
                        <div class="booking-step" id="step2">
                            <h4 class="mb-3"><i class="fas fa-bed"></i> Choose Your Room</h4>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3"><label class="form-label">Check-in Date *</label><input type="date" name="checkin" id="checkin" class="form-control" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Check-out Date *</label><input type="date" name="checkout" id="checkout" class="form-control" required></div>
                            </div>
                            <div id="roomOptions">
                                <?php $rooms = [['type'=>'Standard Room','price'=>1200],['type'=>'Family Suite','price'=>2200],['type'=>'Dormitory Bed','price'=>500]]; ?>
                                <?php foreach($rooms as $room): ?>
                                <div class="room-option" data-price="<?php echo $room['price']; ?>" data-room="<?php echo $room['type']; ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div><h5 class="mb-1"><?php echo $room['type']; ?></h5></div>
                                        <div class="text-end"><span class="fw-bold text-warning">₱<?php echo number_format($room['price']); ?></span><span class="text-muted">/night</span></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" name="room" id="selectedRoom" required>
                            <div class="price-estimate" id="priceEstimate" style="display:none;">
                                <i class="fas fa-calculator"></i> Estimated Total: <span class="price-tag" id="totalPrice">₱0</span>
                            </div>
                            <div class="mb-3 mt-3"><label class="form-label">Special Requests</label><textarea name="requests" class="form-control" rows="2" placeholder="Any special requests?"></textarea></div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="button" class="btn btn-warning next-step">Review Booking <i class="fas fa-check"></i></button>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div class="booking-step" id="step3">
                            <h4 class="mb-3"><i class="fas fa-clipboard-list"></i> Confirm Your Booking</h4>
                            <div class="booking-summary bg-light p-3 rounded" id="bookingSummary"></div>
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a>.</label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Edit</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Confirm & Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Terms & Conditions</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><p>Booking requests are subject to availability. A confirmation will be sent within 24 hours. Cancellation: Free up to 7 days before check-in.</p></div><div class="modal-footer"><button type="button" class="btn btn-warning" data-bs-dismiss="modal">I Understand</button></div></div></div>
</div>

<script>
let selectedRoom = null, roomPrice = 0, roomType = '';
const checkin = document.getElementById('checkin'), checkout = document.getElementById('checkout');
const today = new Date().toISOString().split('T')[0];
checkin.min = today; checkout.min = today;
document.querySelectorAll('.room-option').forEach(opt => {
    opt.addEventListener('click', function() {
        document.querySelectorAll('.room-option').forEach(o => o.classList.remove('selected'));
        this.classList.add('selected');
        selectedRoom = this;
        roomPrice = parseInt(this.dataset.price);
        roomType = this.dataset.room;
        document.getElementById('selectedRoom').value = roomType;
        calculateTotal();
    });
});
function calculateTotal() {
    if(checkin.value && checkout.value && roomPrice) {
        const nights = (new Date(checkout.value) - new Date(checkin.value)) / (1000*60*60*24);
        if(nights > 0) {
            document.getElementById('totalPrice').innerText = '₱' + (nights * roomPrice);
            document.getElementById('priceEstimate').style.display = 'block';
        }
    }
}
checkin.addEventListener('change', calculateTotal);
checkout.addEventListener('change', calculateTotal);
let currentStep = 1;
const steps = document.querySelectorAll('.booking-step');
const stepIndicators = document.querySelectorAll('.step');
function updateStep(step) {
    steps.forEach((s,i) => s.classList.toggle('active', i+1 === step));
    stepIndicators.forEach((ind,i) => {
        ind.classList.toggle('active', i+1 === step);
        ind.classList.toggle('completed', i+1 < step);
    });
    currentStep = step;
}
document.querySelectorAll('.next-step').forEach(btn => btn.addEventListener('click', () => {
    if(currentStep === 1) updateStep(2);
    else if(currentStep === 2) {
        if(!checkin.value || !checkout.value) { alert('Please select dates.'); return; }
        if(!selectedRoom) { alert('Please select a room.'); return; }
        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const phone = document.querySelector('input[name="phone"]').value;
        const guests = document.querySelector('input[name="guests"]').value;
        const requests = document.querySelector('textarea[name="requests"]').value || 'None';
        const nights = (new Date(checkout.value) - new Date(checkin.value)) / (1000*60*60*24);
        const total = nights * roomPrice;
        document.getElementById('bookingSummary').innerHTML = `<div class="row mb-2"><div class="col-6 fw-bold">Name:</div><div class="col-6">${escapeHtml(name)}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Email:</div><div class="col-6">${escapeHtml(email)}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Phone:</div><div class="col-6">${escapeHtml(phone)}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Guests:</div><div class="col-6">${guests}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Room:</div><div class="col-6">${roomType}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Check-in:</div><div class="col-6">${checkin.value}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Check-out:</div><div class="col-6">${checkout.value}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Nights:</div><div class="col-6">${nights}</div></div>
        <div class="row mb-2"><div class="col-6 fw-bold">Total:</div><div class="col-6 text-warning fw-bold">₱${total}</div></div>
        <div class="row"><div class="col-6 fw-bold">Requests:</div><div class="col-6">${escapeHtml(requests)}</div></div>`;
        updateStep(3);
    }
}));
document.querySelectorAll('.prev-step').forEach(btn => btn.addEventListener('click', () => { if(currentStep > 1) updateStep(currentStep-1); }));
function escapeHtml(str) { return str.replace(/[&<>]/g, function(m){ if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m;}); }
document.getElementById('bookingForm').addEventListener('submit', function(e) { if(!document.getElementById('termsCheck').checked) { e.preventDefault(); alert('Please accept terms.'); } });
</script>
<?php include 'includes/footer.php'; ?>