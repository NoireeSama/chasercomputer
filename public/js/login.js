document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.querySelector('.login-btn');

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const originalText = loginBtn.innerText;
        loginBtn.innerText = 'Memuat...';
        loginBtn.style.opacity = '0.7';
        console.log(`Mencoba login dengan: ${username}`);

        setTimeout(() => {
            alert('Halo! Ini cuma demo tampilan ya, logika backend-nya ada di Laravel kamu nanti. Semangat UAS-nya!');
            loginBtn.innerText = originalText;
            loginBtn.style.opacity = '1';
        }, 1000);
    });
});
