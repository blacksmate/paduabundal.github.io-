    </main>
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-home"></i> Padua Bundal</h5>
                    <p>Your home away from home by the beach in Agno, Pangasinan.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-3 fs-4"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3 fs-4"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3 fs-4"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="rooms.php" class="text-white-50 text-decoration-none">Rooms</a></li>
                        <li><a href="gallery.php" class="text-white-50 text-decoration-none">Gallery</a></li>
                        <li><a href="contact.php" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> <?php echo LOCATION; ?></p>
                    <p><i class="fas fa-phone me-2"></i> <?php echo PHONE_1; ?> / <?php echo PHONE_2; ?></p>
                    <p><i class="fas fa-envelope me-2"></i> <?php echo SITE_EMAIL; ?></p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Padua Bundal Transient House. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div id="toastContainer" style="position: fixed; top: 90px; right: 20px; z-index: 9999;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Toast function
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toastId = 'toast-' + Date.now();
            const icon = {
                success: '<i class="fas fa-check-circle"></i>',
                error: '<i class="fas fa-exclamation-circle"></i>',
                warning: '<i class="fas fa-exclamation-triangle"></i>',
                info: '<i class="fas fa-info-circle"></i>'
            }[type] || '<i class="fas fa-bell"></i>';
            
            const bgColor = {
                success: 'linear-gradient(135deg, #f39c12, #e67e22)',
                error: 'linear-gradient(135deg, #e74c3c, #c0392b)',
                warning: 'linear-gradient(135deg, #f1c40f, #f39c12)',
                info: 'linear-gradient(135deg, #3498db, #2980b9)'
            }[type] || 'linear-gradient(135deg, #f39c12, #e67e22)';
            
            const toastHtml = `
                <div id="${toastId}" class="toast-notification" style="background: ${bgColor}; color: white; padding: 1rem 1.5rem; border-radius: 16px; margin-bottom: 1rem; backdrop-filter: blur(8px); box-shadow: 0 15px 35px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 12px; min-width: 280px; max-width: 400px; transform: translateX(400px); transition: transform 0.3s ease; border-left: 5px solid rgba(255,255,255,0.5);">
                    <div style="font-size: 1.8rem;">${icon}</div>
                    <div style="flex: 1; font-weight: 500;">${message}</div>
                    <button onclick="this.closest('.toast-notification').remove()" style="background: none; border: none; color: white; font-size: 1.2rem; cursor: pointer;">&times;</button>
                    <div style="position: absolute; bottom: 0; left: 0; height: 3px; background: rgba(255,255,255,0.8); width: 100%; animation: toastProgress 4s linear forwards;"></div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', toastHtml);
            const toastEl = document.getElementById(toastId);
            setTimeout(() => toastEl.style.transform = 'translateX(0)', 10);
            setTimeout(() => {
                if (toastEl) toastEl.style.transform = 'translateX(400px)';
                setTimeout(() => toastEl?.remove(), 300);
            }, 4000);
        }

        // Check URL for toast parameters
        const urlParams = new URLSearchParams(window.location.search);
        const toastMsg = urlParams.get('toast_msg');
        const toastType = urlParams.get('toast_type');
        if (toastMsg) {
            showToast(decodeURIComponent(toastMsg), toastType || 'success');
            const newUrl = window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    </script>
    <style>
        @keyframes toastProgress {
            0% { width: 100%; }
            100% { width: 0%; }
        }
        .toast-notification {
            position: relative;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            animation: toastSlideIn 0.3s ease;
        }
        @keyframes toastSlideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</body>
</html>