<?php
/**
 * GameSense Fantasy - Homepage
 */

require_once 'config/config.php';

$page_title = "Home";
$page_description = "Welcome to GameSense Fantasy - India's premier free-to-play social gaming platform. Enjoy casino-style games with zero financial risk.";

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero text-center animate-fadeIn">
    <div class="container">
        <h1 class="mb-md">Experience the Thrill of Social Gaming</h1>
        <p class="mb-lg text-lg">Play your favorite casino-style games for free. No real money, no risk, just pure entertainment.</p>
        <div class="hero-btns">
            <a href="/pages/games.php" class="btn btn-primary btn-lg">Play Now</a>
            <a href="/pages/about.php" class="btn btn-secondary btn-lg">Learn More</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features mt-2xl">
    <div class="container">
        <h2 class="text-center mb-xl">Why Choose GameSense Fantasy?</h2>
        <div class="footer-content">
            <div class="card text-center">
                <div class="game-card-icon">🆓</div>
                <h3 class="game-card-title">100% Free to Play</h3>
                <p class="game-card-description">Enjoy all our games without spending a single rupee. We use virtual coins only.</p>
            </div>
            <div class="card text-center">
                <div class="game-card-icon">🛡️</div>
                <h3 class="game-card-title">Zero Financial Risk</h3>
                <p class="game-card-description">No deposits, no withdrawals, no real money gambling. Purely for entertainment.</p>
            </div>
            <div class="card text-center">
                <div class="game-card-icon">👤</div>
                <h3 class="game-card-title">No Registration</h3>
                <p class="game-card-description">Start playing instantly. No login or registration required to enjoy our games.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Games Section -->
<section class="featured-games mt-2xl">
    <div class="container">
        <div class="flex justify-between align-center mb-xl">
            <h2>Featured Games</h2>
            <a href="/pages/games.php" class="text-gold">View All Games &rarr;</a>
        </div>
        
        <div class="footer-content">
            <?php 
            $featured_games = array_slice($GAMES, 0, 3);
            foreach ($featured_games as $id => $game): 
            ?>
            <div class="card game-card" onclick="location.href='/games/<?php echo $id; ?>.php'">
                <div class="game-card-icon"><?php echo $game['icon']; ?></div>
                <h3 class="game-card-title"><?php echo $game['name']; ?></h3>
                <p class="game-card-description"><?php echo $game['description']; ?></p>
                <a href="/games/<?php echo $id; ?>.php" class="btn btn-primary mt-md">Play Now</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Trust & Safety Section -->
<section class="trust-safety mt-2xl p-xl card">
    <div class="container text-center">
        <h2 class="mb-md">Safe & Responsible Gaming</h2>
        <p class="mb-lg">GameSense Fantasy is committed to providing a safe and responsible gaming environment for all our users.</p>
        <div class="flex-center gap-md flex-wrap">
            <div class="alert alert-info">Must be 18+ to play</div>
            <div class="alert alert-success">Fair Play Guaranteed</div>
            <div class="alert alert-warning">Virtual Coins Only</div>
        </div>
    </div>
</section>

<style>
.hero {
    padding: 100px 0;
    background: radial-gradient(circle at center, rgba(124, 58, 237, 0.1) 0%, transparent 70%);
}

.hero h1 {
    font-size: 4rem;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.5rem;
    max-width: 800px;
    margin: 0 auto 40px;
}

.hero-btns {
    display: flex;
    justify-content: center;
    gap: 20px;
}

@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.5rem;
    }
    .hero p {
        font-size: 1.1rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
