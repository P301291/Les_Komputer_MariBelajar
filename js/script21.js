// Contoh sederhana untuk gamifikasi poin
let points = 0;
function addPoints(amount) {
    points += amount;
    document.getElementById('points').innerText = points;
}

// Untuk quiz sederhana (extend dengan library)
function checkQuiz() {
    // Logika quiz di sini
    alert('Quiz selesai! Sertifikat akan di-generate.');
}