<?php
/**
 * GameSense Fantasy - Games Listing Page
 */

require_once '../config/config.php';

$page_title = "All Games";
$page_description = "Explore our collection of free-to-play social casino games. From Slots to Poker, we have it all.";

include '../includes/header.php';
?>

<section class="games-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Our Games Collection</h1>
        <p class="text-lg">Choose from our wide variety of social casino games and start playing instantly.</p>
    </div>
</section>

<section class="games-grid">
    <div class="container">
        <div class="footer-content">
            <?php foreach ($GAMES as $id => $game): ?>
            <div class="card game-card animate-on-scroll" onclick="location.href='/games/<?php echo $id; ?>.php'">
                <div class="game-card-icon"><?php echo $game['icon']; ?></div>
                <h3 class="game-card-title"><?php echo $game['name']; ?></h3>
                <p class="game-card-description mb-md"><?php echo $game['description']; ?></p>
                <div class="game-card-footer">
                    <a href="/games/<?php echo $id; ?>.php" class="btn btn-primary">Play Now</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="how-to-play-info mt-2xl p-xl card">
    <div class="container">
        <h2 class="text-center mb-xl">How to Play</h2>
        <div class="footer-content">
            <div class="info-step">
                <h3 class="text-gold">1. Choose a Game</h3>
                <p>Browse our collection and pick any game that interests you. All games are unlocked and free to play.</p>
            </div>
            <div class="info-step">
                <h3 class="text-gold">2. Get Free Coins</h3>
                <p>You start with 1,000 virtual coins. You can also get daily bonus coins just by visiting the site.</p>
            </div>
            <div class="info-step">
                <h3 class="text-gold">3. Start Playing</h3>
                <p>Place your virtual bets and enjoy the game. Remember, these are virtual coins with no real-world value.</p>
            </div>
        </div>
    </div>
</section>

<style>
.games-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
}

.game-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.game-card-footer {
    margin-top: auto;
}

.info-step {
    padding: 20px;
    border-left: 2px solid var(--accent-gold);
}
</style>

<?php include '../includes/footer.php'; ?>
