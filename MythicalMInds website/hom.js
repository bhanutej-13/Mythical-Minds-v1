document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const searchInput = document.getElementById('search');
    const videoCards = document.querySelectorAll('.video-card');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

   
    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();
        videoCards.forEach(function(card) {
            const title = card.querySelector('h3').innerText.toLowerCase();
            const uploader = card.querySelector('p').innerText.toLowerCase();
            if (title.includes(searchTerm) || uploader.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
