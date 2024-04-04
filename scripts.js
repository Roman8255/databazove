const gridItems = document.querySelectorAll('.grid-item');
const overlay = document.getElementById('overlay');
const expandedImg = document.getElementById('expandedImg');
const closeBtn = document.getElementById('close');

gridItems.forEach(item => {
    item.addEventListener('click', () => {
        expandedImg.src = item.querySelector('img').src;
        overlay.style.display = 'flex';
    });
});

closeBtn.addEventListener('click', () => {
    overlay.style.display = 'none';
});
