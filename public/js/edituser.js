document.addEventListener('DOMContentLoaded', () => {

    // --- DROPDOWN LOGIC ---
    const dropdown = document.getElementById('roleDropdown');
    const btn = dropdown.querySelector('.dropdown-btn');
    const menu = dropdown.querySelector('.dropdown-menu');
    const selectedText = dropdown.querySelector('.selected-text');
    const options = dropdown.querySelectorAll('li');
    const roleInput = document.getElementById('roleInput');

    // Toggle Menu Pas Klik Tombol
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('show');
    });

    // Pas Pilih Opsi (Admin/Customer)
    options.forEach(opt => {
        opt.addEventListener('click', () => {
            const value = opt.getAttribute('data-value');

            // Ubah teks di tombol
            selectedText.innerText = value;

            // Simpan value ke input hidden (buat backend nanti)
            roleInput.value = value;

            // Tutup menu
            menu.classList.remove('show');
        });
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', () => {
        menu.classList.remove('show');
    });

    // --- BUTTON ACTIONS ---
    document.getElementById('btnSimpan').addEventListener('click', () => {
        // Efek loading simpel
        const btn = document.getElementById('btnSimpan');
        const originalText = btn.innerText;
        btn.innerText = 'Menyimpan...';

        setTimeout(() => {
            alert('Data User berhasil diperbarui!');
            btn.innerText = originalText;
            window.location.href = '/dashboard'; // Redirect contoh
        }, 1000);
    });

    document.getElementById('btnHapus').addEventListener('click', () => {
        if(confirm('Yakin ingin menghapus user ini?')) {
            alert('User dihapus.');
            window.location.href = '/dashboard';
        }
    });
});
