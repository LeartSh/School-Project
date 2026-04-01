const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    
    if(navLinks.classList.contains('active')) {
        navLinks.style.display = 'flex';
        navLinks.style.flexDirection = 'column';
        navLinks.style.position = 'absolute';
        navLinks.style.top = '70px';
        navLinks.style.left = '0';
        navLinks.style.width = '100%';
        navLinks.style.background = '#1f1f1f';
        navLinks.style.padding = '1rem';
    } else {
        navLinks.style.display = 'none';
    }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const role = localStorage.getItem('userRole');
    const adminLink = document.querySelector('.admin-link');
    const loginBtn = document.querySelector('.login-btn'); // Nëse ke një buton Log In

    if (role === 'admin') {
        adminLink.style.display = 'block'; // Shfaq Admin Panel
    } else {
        adminLink.style.display = 'none'; // Fshih Admin Panel për përdoruesit e thjeshtë
    }
});

function logout() {
    localStorage.removeItem('userRole');
    window.location.href = 'index.html';
}

document.addEventListener('DOMContentLoaded', () => {
    const role = localStorage.getItem('userRole'); // 'admin' ose 'user'
    const name = localStorage.getItem('userName');
    const authSection = document.getElementById('auth-section');

    if (role) {
        // Nëse përdoruesi është i loguar
        const badgeColor = (role === 'admin') ? '#ff4757' : '#2ed573';
        const badgeText = (role === 'admin') ? 'ADMIN' : 'KLIENT';

        authSection.innerHTML = `
            <div class="user-status">
                <span class="user-name">Përshëndetje, <strong>${name}</strong></span>
                <span class="role-badge" style="background: ${badgeColor}">${badgeText}</span>
                <button onclick="logout()" class="btn-logout">Dil</button>
            </div>
        `;
        
        // Nëse është Admin, shfaq butonin e Dashboard-it nëse ekziston
        const adminLink = document.querySelector('.admin-link');
        if (adminLink) {
            adminLink.style.display = (role === 'admin') ? 'block' : 'none';
        }
    }
});

function logout() {
    localStorage.clear(); // Fshin të gjitha të dhënat (role, name)
    window.location.href = 'index.html';
}