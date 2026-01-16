<?php
/**
 * GameSense Fantasy - Configuration File
 * Professional Social Gaming Platform
 */

// ============================================
// SITE CONFIGURATION
// ============================================

define('SITE_NAME', 'GameSense Fantasy');
define('SITE_URL', 'https://gamesensefantasy.com');
define('SITE_DOMAIN', 'gamesensefantasy.com');

// ============================================
// COMPANY INFORMATION
// ============================================

define('COMPANY_NAME', 'SHAMSHABAD-MD INDIA PRIVATE LIMITED');
define('BRAND_NAME', 'SHAMSHABAD');
define('COMPANY_CIN', 'U80301UP2020PTC129281');
define('COMPANY_GST', '09ABDCS7462D1Z7');
define('COMPANY_PAN', 'ABDCS7462D');
define('COMPANY_ADDRESS', 'C/O SHAMSHABAD CONVENT SCHL, 1ST FLOOR, SITARAM COMPLEX NAYA BANSH ROAD, SHAMSHABAD, Agra, Uttar Pradesh 283125');
define('COMPANY_EMAIL', 'support@gamesensefantasy.com');

// ============================================
// GAME SETTINGS
// ============================================

// Starting virtual coins for new players
define('STARTING_COINS', 1000);

// Daily bonus coins
define('DAILY_BONUS', 100);

// Maximum bet amount
define('MAX_BET', 500);

// Minimum bet amount
define('MIN_BET', 1);

// ============================================
// GAME LIST
// ============================================

$GAMES = array(
    'chicken' => array(
        'name' => 'Chicken Game',
        'icon' => '🐔',
        'description' => 'Pick eggs and avoid bones',
        'file' => 'games/chicken.php'
    ),
    'dice' => array(
        'name' => 'Dice Game',
        'icon' => '🎲',
        'description' => 'Predict dice outcomes',
        'file' => 'games/dice.php'
    ),
    'mines' => array(
        'name' => 'Mines Game',
        'icon' => '💣',
        'description' => 'Click safe tiles and avoid mines',
        'file' => 'games/mines.php'
    ),
    'plinko' => array(
        'name' => 'Plinko Game',
        'icon' => '🎯',
        'description' => 'Drop ball through pegs',
        'file' => 'games/plinko.php'
    ),
    '11x' => array(
        'name' => '11X Game',
        'icon' => '⚡',
        'description' => 'Multiply your coins by 11x',
        'file' => 'games/11x.php'
    ),
    '247laser' => array(
        'name' => '247LASER Game',
        'icon' => '🔫',
        'description' => '24/7 laser-themed game',
        'file' => 'games/247laser.php'
    ),
    'fairplay' => array(
        'name' => 'Fair Play Game',
        'icon' => '⚖️',
        'description' => 'Transparent game mechanics',
        'file' => 'games/fairplay.php'
    ),
    'slots' => array(
        'name' => 'Slots Game',
        'icon' => '🎰',
        'description' => 'Classic slot machine',
        'file' => 'games/slots.php'
    ),
    'poker' => array(
        'name' => 'Poker Game',
        'icon' => '🃏',
        'description' => 'Card game strategy',
        'file' => 'games/poker.php'
    ),
    'blackjack' => array(
        'name' => 'Blackjack Game',
        'icon' => '🎴',
        'description' => 'Beat the dealer',
        'file' => 'games/blackjack.php'
    )
);

// ============================================
// ENVIRONMENT SETTINGS
// ============================================

// Environment: 'development' or 'production'
$environment = getenv('ENVIRONMENT') ?: 'development';
define('ENVIRONMENT', $environment);

// Debug mode
define('DEBUG_MODE', ENVIRONMENT === 'development');

// ============================================
// SECURITY SETTINGS
// ============================================

// Session timeout (in seconds)
define('SESSION_TIMEOUT', 3600);

// CSRF token name
define('CSRF_TOKEN_NAME', '_csrf_token');

// ============================================
// PATHS
// ============================================

define('ROOT_PATH', dirname(dirname(__FILE__)));
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('GAMES_PATH', ROOT_PATH . '/games');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PAGES_PATH', ROOT_PATH . '/pages');

// ============================================
// URLS
// ============================================

define('ASSETS_URL', '/assets');
define('GAMES_URL', '/games');

// ============================================
// ERROR HANDLING
// ============================================

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}

// ============================================
// HELPER FUNCTIONS
// ============================================

/**
 * Get the current year for copyright
 */
function getCurrentYear() {
    return date('Y');
}

/**
 * Get the last updated date
 */
function getLastUpdated() {
    return date('F j, Y');
}

/**
 * Sanitize input
 */
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

/**
 * Get game by ID
 */
function getGame($gameId) {
    global $GAMES;
    return isset($GAMES[$gameId]) ? $GAMES[$gameId] : null;
}

/**
 * Get all games
 */
function getAllGames() {
    global $GAMES;
    return $GAMES;
}

/**
 * Format currency
 */
function formatCoins($amount) {
    return number_format($amount, 0) . ' Coins';
}

/**
 * Get random multiplier
 */
function getRandomMultiplier($min = 1.0, $max = 10.0) {
    return round(mt_rand($min * 100, $max * 100) / 100, 2);
}

/**
 * Generate random game result
 */
function generateGameResult() {
    return mt_rand(0, 100);
}

// ============================================
// SESSION INITIALIZATION
// ============================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize user coins if not set
if (!isset($_SESSION['user_coins'])) {
    $_SESSION['user_coins'] = STARTING_COINS;
}

// ============================================
// TIMEZONE
// ============================================

date_default_timezone_set('Asia/Kolkata');

?>
