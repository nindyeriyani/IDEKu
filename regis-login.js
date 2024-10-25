// Ambil elemen form dan link navigasi
const form = document.querySelector('.form');
const loginLink = document.getElementById('login-link');
const registerLink = document.getElementById('register-link');

// Tambahkan event listener untuk link navigasi
loginLink.addEventListener('click', () => {
  form.classList.add('hide'); // Tambahkan kelas hide untuk menyembunyikan form saat berpindah ke halaman login
});

registerLink.addEventListener('click', () => {
  form.classList.add('hide'); // Tambahkan kelas hide untuk menyembunyikan form saat berpindah ke halaman register
});
