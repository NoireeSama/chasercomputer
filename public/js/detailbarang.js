document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.getElementById('jenisDropdown');
    const btn = dropdown.querySelector('.dropdown-btn');
    const menu = dropdown.querySelector('.dropdown-menu');
    const selectedText = dropdown.querySelector('.selected-text');
    const options = dropdown.querySelectorAll('li');
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('show');
    });
    options.forEach(opt => {
        opt.addEventListener('click', () => {
            selectedText.innerText = opt.innerText;
            menu.classList.remove('show');
        });
    });
    document.addEventListener('click', () => {
        menu.classList.remove('show');
    });
    const stockVal = document.getElementById('stockValue');
    const btnPlus = document.getElementById('btnPlus');
    const btnMinus = document.getElementById('btnMinus');
    let count = parseInt(stockVal.innerText);
    btnPlus.addEventListener('click', () => {
        count++;
        stockVal.innerText = count;
    });
    btnMinus.addEventListener('click', () => {
        if (count > 0) {
            count--;
            stockVal.innerText = count;
        }
    });
    const setupImageUpload = (id) => {
        const fileInput = document.getElementById(`file${id}`);
        const preview = document.getElementById(`preview${id}`);
        const placeholder = fileInput.parentElement.querySelector('.placeholder-text');
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    };
    setupImageUpload(1);
    setupImageUpload(2);
    setupImageUpload(3);
    setupImageUpload(4);
    document.getElementById('btnSimpan').addEventListener('click', () => {
        const btn = document.getElementById('btnSimpan');
        btn.innerText = 'Menyimpan...';
        setTimeout(() => {
            window.location.href = '/persediaan'; 
        }, 800);
    });
    document.getElementById('btnHapus').addEventListener('click', () => {
        if(confirm('Yakin ingin menghapus barang ini?')) {
            window.location.href = '/persediaan';
        }
    });
});
