<?php
/**
 * Header Include File
 * Displayed on all pages
 */

// Ensure config is loaded
if (!defined('SITE_NAME')) {
    require_once dirname(dirname(__FILE__)) . '/config/config.php';
}

// Get current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($page_description) ? htmlspecialchars($page_description) : 'GameSense Fantasy - Free Social Gaming Platform'; ?>">
    <meta name="keywords" content="gaming, entertainment, social casino, free games, virtual coins">
    <meta name="author" content="<?php echo COMPANY_NAME; ?>">
    <meta name="theme-color" content="#0a0e27">
    
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo ASSETS_URL; ?>/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/style.css">
    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/<?php echo htmlspecialchars($page_css); ?>">
    <?php endif; ?>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Google Ads Compliance -->
    <meta name="google-site-verification" content="">
</head>
<body>
    <!-- Header Navigation -->
    <header>
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <span class="logo-icon">🎮</span>
                <span><?php echo SITE_NAME; ?></span>
            </div>
            
            <!-- Navigation Menu -->
            <nav>
                <ul>
                    <li><a href="/" class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="/pages/games.php" class="<?php echo $current_page === 'games' ? 'active' : ''; ?>">Games</a></li>
                    <li><a href="/pages/about.php" class="<?php echo $current_page === 'about' ? 'active' : ''; ?>">About</a></li>
                    <li><a href="/pages/contact.php" class="<?php echo $current_page === 'contact' ? 'active' : ''; ?>">Contact</a></li>
                    <li><a href="/pages/faq.php" class="<?php echo $current_page === 'faq' ? 'active' : ''; ?>">FAQ</a></li>
                </ul>
            </nav>
            
            <!-- Coin Balance Display -->
            <div class="coin-balance">
                <span class="coin-icon">💰</span>
                <span id="coinBalance"><?php echo formatCoins($_SESSION['user_coins']); ?></span>
            </div>
        </div>
    </header>
    
    <!-- Main Content Area -->
    <main>
