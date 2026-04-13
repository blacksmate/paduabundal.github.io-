// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }
});

// Back to Top Button
const backBtn = document.createElement('button');
backBtn.id = 'backToTop';
backBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
document.body.appendChild(backBtn);

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backBtn.style.display = 'flex';
    } else {
        backBtn.style.display = 'none';
    }
});
backBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// Gallery Lightbox
document.querySelectorAll('.gallery-item img').forEach(img => {
    img.addEventListener('click', function() {
        const modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0,0,0,0.9)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.style.zIndex = '9999';
        modal.style.cursor = 'pointer';
        const largeImg = document.createElement('img');
        largeImg.src = this.src;
        largeImg.style.maxWidth = '90%';
        largeImg.style.maxHeight = '90%';
        largeImg.style.borderRadius = '10px';
        modal.appendChild(largeImg);
        modal.addEventListener('click', () => modal.remove());
        document.body.appendChild(modal);
    });
});

// Newsletter AJAX (if present)
const newsletterForm = document.getElementById('newsletterForm');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = newsletterForm.querySelector('input').value;
        if (!email) {
            showToast('Please enter an email address.', 'warning');
            return;
        }
        // Simulate AJAX – replace with actual fetch if backend exists
        showToast(`Thanks for subscribing! Updates will be sent to ${email}`, 'success');
        newsletterForm.reset();
    });
}