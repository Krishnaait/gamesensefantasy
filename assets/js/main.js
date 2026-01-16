/**
 * GameSense Fantasy - Main JavaScript File
 * Global functionality for the platform
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('GameSense Fantasy Initialized');
    
    // Initialize coin balance from localStorage if available
    initCoinBalance();
    
    // Initialize navigation highlighting
    initNavigation();
    
    // Initialize animations
    initAnimations();
});

/**
 * Initialize coin balance
 */
function initCoinBalance() {
    const coinDisplay = document.getElementById('coinBalance');
    if (!coinDisplay) return;
    
    // Check if we have coins in localStorage
    let coins = localStorage.getItem('user_coins');
    
    if (coins === null) {
        // If not in localStorage, use the value from PHP session (passed via data attribute or global variable)
        // For now, we'll just use the value already in the display
        coins = coinDisplay.innerText.replace(/[^0-9]/g, '');
        localStorage.setItem('user_coins', coins);
    } else {
        // Update display with localStorage value
        updateCoinDisplay(coins);
    }
}

/**
 * Update coin display across the site
 */
function updateCoinDisplay(amount) {
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(amount) + ' Coins';
    }
    localStorage.setItem('user_coins', amount);
    
    // Also update via AJAX to PHP session if needed
    // updateSessionCoins(amount);
}

/**
 * Add coins to balance
 */
function addCoins(amount) {
    let currentCoins = parseInt(localStorage.getItem('user_coins')) || 0;
    currentCoins += amount;
    updateCoinDisplay(currentCoins);
}

/**
 * Deduct coins from balance
 */
function deductCoins(amount) {
    let currentCoins = parseInt(localStorage.getItem('user_coins')) || 0;
    if (currentCoins >= amount) {
        currentCoins -= amount;
        updateCoinDisplay(currentCoins);
        return true;
    }
    return false;
}

/**
 * Get current coin balance
 */
function getCoins() {
    return parseInt(localStorage.getItem('user_coins')) || 0;
}

/**
 * Initialize navigation
 */
function initNavigation() {
    // Mobile menu toggle logic can go here
}

/**
 * Initialize animations
 */
function initAnimations() {
    const observerOptions = {
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Show toast notification
 */
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerText = message;
    
    document.body.appendChild(toast);
    
    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

/**
 * Format number with commas
 */
function formatNumber(num) {
    return new Intl.NumberFormat().format(num);
}
