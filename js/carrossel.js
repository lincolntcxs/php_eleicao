// Carrossel automático - Versão Corrigida
document.addEventListener('DOMContentLoaded', function() {
    const carrosselContainer = document.querySelector('.carrossel-container');
    
    if (!carrosselContainer) return;

    const items = carrosselContainer.querySelectorAll('.carrossel-item');
    const indicators = carrosselContainer.querySelectorAll('.carrossel-indicator');
    const prevBtn = carrosselContainer.querySelector('.carrossel-prev');
    const nextBtn = carrosselContainer.querySelector('.carrossel-next');
    
    let currentIndex = 0;
    let interval = null;

    function goTo(index) {
        // Remove active de todos
        items.forEach(item => item.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Adiciona active no atual
        currentIndex = index;
        items[currentIndex].classList.add('active');
        indicators[currentIndex].classList.add('active');
    }

    function next() {
        const nextIndex = (currentIndex + 1) % items.length;
        goTo(nextIndex);
    }

    function prev() {
        const prevIndex = (currentIndex - 1 + items.length) % items.length;
        goTo(prevIndex);
    }

    function startAutoRotate() {
        interval = setInterval(next, 4000); // 4 segundos
    }

    function stopAutoRotate() {
        if (interval) {
            clearInterval(interval);
            interval = null;
        }
    }

    // Event listeners - SEM preventDefault()
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Só para o evento de clique, não preventDefault
            prev();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Só para o evento de clique, não preventDefault
            next();
        });
    }
    
    // Indicadores
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function(e) {
            e.stopPropagation(); // Só para o evento de clique
            goTo(index);
        });
    });

    // Auto-rotate
    startAutoRotate();
    
    // Pausar no hover
    carrosselContainer.addEventListener('mouseenter', stopAutoRotate);
    carrosselContainer.addEventListener('mouseleave', startAutoRotate);

    // Mostrar primeiro slide
    goTo(0);
});