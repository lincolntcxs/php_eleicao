// Carrossel automático
class Carrossel {
    constructor(container) {
        this.container = container;
        this.items = container.querySelectorAll('.carrossel-item');
        this.indicators = container.querySelectorAll('.carrossel-indicator');
        this.prevBtn = container.querySelector('.carrossel-prev');
        this.nextBtn = container.querySelector('.carrossel-next');
        this.currentIndex = 0;
        this.interval = null;
        
        this.init();
    }
    
    init() {
        // Event listeners
        this.prevBtn.addEventListener('click', () => this.prev());
        this.nextBtn.addEventListener('click', () => this.next());
        
        // Indicadores
        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => this.goTo(index));
        });
        
        // Auto-rotate
        this.startAutoRotate();
        
        // Pausar no hover
        this.container.addEventListener('mouseenter', () => this.stopAutoRotate());
        this.container.addEventListener('mouseleave', () => this.startAutoRotate());
    }
    
    goTo(index) {
        this.items[this.currentIndex].classList.remove('active');
        this.indicators[this.currentIndex].classList.remove('active');
        
        this.currentIndex = index;
        
        this.items[this.currentIndex].classList.add('active');
        this.indicators[this.currentIndex].classList.add('active');
    }
    
    next() {
        const nextIndex = (this.currentIndex + 1) % this.items.length;
        this.goTo(nextIndex);
    }
    
    prev() {
        const prevIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
        this.goTo(prevIndex);
    }
    
    startAutoRotate() {
        this.interval = setInterval(() => this.next(), 5000); // Muda a cada 5 segundos
    }
    
    stopAutoRotate() {
        if (this.interval) {
            clearInterval(this.interval);
            this.interval = null;
        }
    }
}

// Inicializar carrossel quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    const carrosselContainer = document.querySelector('.carrossel-container');
    if (carrosselContainer) {
        new Carrossel(carrosselContainer);
    }
});