document.addEventListener('DOMContentLoaded', () => {

    // --- DROPDOWN LOGIC ---
    const dropdowns = document.querySelectorAll('.custom-dropdown');

    dropdowns.forEach(dropdown => {
        const btn = dropdown.querySelector('.dropdown-btn');
        const menu = dropdown.querySelector('.dropdown-menu');
        const selectedText = dropdown.querySelector('.selected-text');
        const options = dropdown.querySelectorAll('.dropdown-menu li');

        // Toggle Menu
        btn.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah event bubbling
            // Tutup dropdown lain dulu
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.classList.remove('show');
            });
            menu.classList.toggle('show');
        });

        // Pilih Opsi
        options.forEach(option => {
            option.addEventListener('click', () => {
                selectedText.innerText = option.innerText;
                menu.classList.remove('show');

                // Khusus Logic Warna Status
                if (option.hasAttribute('data-color')) {
                    const color = option.getAttribute('data-color');
                    btn.style.background = color;
                    btn.style.borderColor = color;
                    // Biar teks tetep kebaca di background cerah/gelap, kita set putih aja aman
                    btn.style.color = 'white';
                }
            });
        });
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
    });


    // --- ADD ITEM LOGIC (+) ---
    const addItemBtn = document.getElementById('addItemBtn');
    const itemList = document.getElementById('itemList');

    addItemBtn.addEventListener('click', () => {
        // Kita hitung jumlah baris sekarang buat nentuin Nomor Urut
        const currentCount = itemList.children.length + 1;

        // Item statis kedua sesuai request
        const newItemName = "Xiaomi G24i Monitor";

        const newRow = document.createElement('div');
        newRow.classList.add('table-row');
        newRow.innerHTML = `
            <div class="col-no">${currentCount}</div>
            <div class="col-item">${newItemName}</div>
            <button class="delete-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#FF2424"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"/></svg>
            </button>
        `;

        itemList.appendChild(newRow);
    });


    // --- DELETE ITEM LOGIC (Event Delegation) ---
    itemList.addEventListener('click', (e) => {
        // Cek apakah yang diklik adalah tombol delete (atau icon di dalamnya)
        if (e.target.closest('.delete-btn')) {
            const row = e.target.closest('.table-row');
            row.remove();
            updateNumbers(); // Update nomor urut setelah hapus
        }
    });

    function updateNumbers() {
        const rows = itemList.querySelectorAll('.table-row');
        rows.forEach((row, index) => {
            row.querySelector('.col-no').innerText = index + 1;
        });
    }

    // --- NAVIGATION LOGIC ---
    const btnSimpan = document.getElementById('btnSimpan');
    const btnHapus = document.getElementById('btnHapus');

    // Karena kamu UI/UX designer dan ini simulasi, kita redirect aja ke dashboard
    const goToDashboard = () => window.location.href = '/dashboard';

    btnSimpan.addEventListener('click', () => {
        // Bisa tambah animasi loading kalau mau
        goToDashboard();
    });

    btnHapus.addEventListener('click', () => {
        if(confirm('Yakin mau menghapus pesanan ini?')) {
            goToDashboard();
        }
    });
});
