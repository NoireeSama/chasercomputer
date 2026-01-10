document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    console.log('CSRF Token:', csrfToken);
    
    let selectedStatusValue = '1';
    
    // Set current status color on load
    const statusOptions = document.querySelectorAll('#statusDropdown .dropdown-menu li');
    const statusBtn = document.querySelector('#statusBtn');
    
    if (statusBtn) {
        statusOptions.forEach(option => {
            const statusText = statusBtn.querySelector('.selected-text').textContent.trim();
            if (option.textContent.trim() === statusText && option.hasAttribute('data-color')) {
                const color = option.getAttribute('data-color');
                statusBtn.style.background = color;
                statusBtn.style.borderColor = color;
                statusBtn.style.color = 'white';
                selectedStatusValue = option.dataset.value;
            }
        });
    }
    
    // Dropdown functionality
    const dropdowns = document.querySelectorAll('.custom-dropdown');
    dropdowns.forEach(dropdown => {
        const btn = dropdown.querySelector('.dropdown-btn');
        const menu = dropdown.querySelector('.dropdown-menu');
        const selectedText = dropdown.querySelector('.selected-text');
        const options = dropdown.querySelectorAll('.dropdown-menu li');
        
        if (btn) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.classList.remove('show');
                });
                menu.classList.toggle('show');
            });
        }
        
        options.forEach(option => {
            option.addEventListener('click', () => {
                selectedText.innerText = option.innerText;
                menu.classList.remove('show');
                
                // Store status value
                if (dropdown.id === 'statusDropdown') {
                    selectedStatusValue = option.dataset.value;
                    console.log('Selected status value:', selectedStatusValue);
                }
                
                if (option.hasAttribute('data-color')) {
                    const color = option.getAttribute('data-color');
                    btn.style.background = color;
                    btn.style.borderColor = color;
                    btn.style.color = 'white';
                }
            });
        });
    });
    
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
    });
    
    const btnSimpan = document.getElementById('btnSimpan');
    const btnHapus = document.getElementById('btnHapus');
    
    // Handle Save Status
    if (btnSimpan) {
        btnSimpan.addEventListener('click', async () => {
            console.log('Tombol Simpan diklik');
            const pesananIdElement = document.getElementById('pesananId');
            const pesananId = pesananIdElement ? pesananIdElement.textContent.trim() : null;
            
            console.log('Pesanan ID:', pesananId);
            console.log('Selected Status Value:', selectedStatusValue);
            
            if (!pesananId) {
                alert('Pesanan ID tidak ditemukan');
                return;
            }
            
            try {
                const payload = { status_id: parseInt(selectedStatusValue) };
                console.log('Sending payload:', payload);
                
                const response = await fetch(`/api/pesanan/${pesananId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(payload)
                });
                
                console.log('Response status:', response.status);
                
                const contentType = response.headers.get('content-type');
                let data = null;
                
                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                    console.log('Response data:', data);
                } else {
                    const text = await response.text();
                    console.error('Unexpected response:', text.substring(0, 200));
                    alert('Terjadi kesalahan server (response bukan JSON)');
                    return;
                }
                
                if (response.ok) {
                    alert('Status pesanan berhasil diperbarui!');
                    window.location.href = '/admin/dashboard';
                } else {
                    alert('Error: ' + (data.message || 'Gagal memperbarui status'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        });
    } else {
        console.error('btnSimpan tidak ditemukan');
    }
    
    // Handle Delete
    if (btnHapus) {
        btnHapus.addEventListener('click', async () => {
            if (!confirm('Yakin mau menghapus pesanan ini?')) return;
            
            const pesananIdElement = document.getElementById('pesananId');
            const pesananId = pesananIdElement ? pesananIdElement.textContent.trim() : null;
            
            if (!pesananId) {
                alert('Pesanan ID tidak ditemukan');
                return;
            }
            
            try {
                const response = await fetch(`/api/pesanan/${pesananId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                
                const contentType = response.headers.get('content-type');
                let data = null;
                
                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    const text = await response.text();
                    console.error('Unexpected response:', text.substring(0, 200));
                    alert('Terjadi kesalahan server');
                    return;
                }
                
                if (response.ok) {
                    alert('Pesanan berhasil dihapus!');
                    window.location.href = '/admin/dashboard';
                } else {
                    alert('Error: ' + (data.message || 'Gagal menghapus pesanan'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        });
    } else {
        console.error('btnHapus tidak ditemukan');
    }
});
