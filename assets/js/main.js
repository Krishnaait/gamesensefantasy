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
        // Default starting balance
        coins = 1000;
        localStorage.setItem('user_coins', coins);
    }
    
    // Update display with localStorage value
    updateCoinDisplay(coins);
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
}

/**
 * Get current coin balance
 */
function getCredits() {
    return parseInt(localStorage.getItem('user_coins')) || 1000;
}

/**
 * Set coin balance
 */
function setCredits(amount) {
    amount = Math.max(0, parseInt(amount)); // Ensure non-negative
    localStorage.setItem('user_coins', amount);
    updateCoinDisplay(amount);
}

/**
 * Add coins to balance
 */
function addCoins(amount) {
    let currentCoins = getCredits();
    currentCoins += amount;
    setCredits(currentCoins);
}

/**
 * Deduct coins from balance
 */
function deductCoins(amount) {
    let currentCoins = getCredits();
    if (currentCoins >= amount) {
        currentCoins -= amount;
        setCredits(currentCoins);
        return true;
    }
    return false;
}

/**
 * Get current coin balance (alias)
 */
function getCoins() {
    return getCredits();
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
