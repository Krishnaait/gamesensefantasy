<?php
/**
 * GameSense Fantasy - Games Hub
 * All available games
 */

require_once '../config/config.php';

$page_title = "Games Hub";
$page_description = "Play all our exciting social casino games.";

include '../includes/header.php';
?>

<div class="games-hub-container">
    <div class="hub-header">
        <h1 class="hub-title">🎮 Choose Your Game</h1>
        <p class="hub-subtitle">Play free social casino games with virtual coins</p>
    </div>
    
    <div class="games-grid">
        <!-- Chicken Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #FFD700, #FFA500);">
                <span class="game-emoji">🐔</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Chicken Game</h3>
                <p class="game-card-description">Pick eggs and avoid bones to multiply your coins</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 11x</span>
                    <span class="stat">RTP: 95%</span>
                </div>
                <a href="/games/chicken.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Dice Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #7c3aed, #a78bfa);">
                <span class="game-emoji">🎲</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Dice Game</h3>
                <p class="game-card-description">Predict dice outcomes and win 2x your bet</p>
                <div class="game-card-stats">
                    <span class="stat">Odds: 50/50</span>
                    <span class="stat">Payout: 2x</span>
                </div>
                <a href="/games/dice.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Mines Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <span class="game-emoji">💣</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Mines Game</h3>
                <p class="game-card-description">Click safe tiles and avoid mines for big wins</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 10x</span>
                    <span class="stat">Skill: High</span>
                </div>
                <a href="/games/mines.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Plinko Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #10b981, #059669);">
                <span class="game-emoji">🎯</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Plinko Game</h3>
                <p class="game-card-description">Drop balls through pegs and win coins</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 5x</span>
                    <span class="stat">RTP: 96%</span>
                </div>
                <a href="/games/plinko.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- 11X Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <span class="game-emoji">⚡</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">11X Game</h3>
                <p class="game-card-description">High-risk, high-reward crash game</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 11x</span>
                    <span class="stat">Risk: Extreme</span>
                </div>
                <a href="/games/11x.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- 247LASER Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
                <span class="game-emoji">🔫</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">247LASER Game</h3>
                <p class="game-card-description">Shoot targets for fast-paced action</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 8x</span>
                    <span class="stat">Speed: Fast</span>
                </div>
                <a href="/games/247laser.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Fair Play Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa);">
                <span class="game-emoji">⚖️</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Fair Play Game</h3>
                <p class="game-card-description">Transparent 50/50 odds demonstration</p>
                <div class="game-card-stats">
                    <span class="stat">Odds: 50/50</span>
                    <span class="stat">Certified: ✓</span>
                </div>
                <a href="/games/fairplay.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Slots Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #ec4899, #db2777);">
                <span class="game-emoji">🎰</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Slots Game</h3>
                <p class="game-card-description">Classic slot machine with big payouts</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 10x</span>
                    <span class="stat">RTP: 94%</span>
                </div>
                <a href="/games/slots.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Poker Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #14b8a6, #0d9488);">
                <span class="game-emoji">🃏</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Poker Game</h3>
                <p class="game-card-description">Video poker with hand rankings</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 250x</span>
                    <span class="stat">Skill: Medium</span>
                </div>
                <a href="/games/poker.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
        
        <!-- Blackjack Game -->
        <div class="game-card">
            <div class="game-card-image" style="background: linear-gradient(135deg, #6366f1, #4f46e5);">
                <span class="game-emoji">🎴</span>
            </div>
            <div class="game-card-content">
                <h3 class="game-card-title">Blackjack Game</h3>
                <p class="game-card-description">Beat the dealer and get 21</p>
                <div class="game-card-stats">
                    <span class="stat">Max: 2x</span>
                    <span class="stat">RTP: 99%</span>
                </div>
                <a href="/games/blackjack.php" class="btn btn-primary btn-block mt-md">Play Now</a>
            </div>
        </div>
    </div>
</div>

<style>
.games-hub-container {
    padding: var(--spacing-3xl) var(--spacing-lg);
    max-width: 1400px;
    margin: 0 auto;
}

.hub-header {
    text-align: center;
    margin-bottom: var(--spacing-3xl);
}

.hub-title {
    font-size: var(--font-size-4xl);
    font-weight: var(--font-weight-bold);
    color: var(--accent-gold);
    margin-bottom: var(--spacing-md);
}

.hub-subtitle {
    font-size: var(--font-size-lg);
    color: var(--text-secondary);
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: var(--spacing-2xl);
}

.game-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: all var(--transition-normal);
}

.game-card:hover {
    transform: translateY(-5px);
    border-color: var(--accent-gold);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.1);
}

.game-card-image {
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 80px;
}

.game-emoji {
    display: block;
}

.game-card-content {
    padding: var(--spacing-lg);
}

.game-card-title {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    color: var(--accent-gold);
    margin-bottom: var(--spacing-sm);
}

.game-card-description {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    margin-bottom: var(--spacing-md);
    line-height: 1.5;
}

.game-card-stats {
    display: flex;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-md);
}

.stat {
    font-size: var(--font-size-xs);
    background: rgba(255, 215, 0, 0.1);
    color: var(--accent-gold);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--radius-sm);
}

@media (max-width: 768px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: var(--spacing-lg);
    }
    
    .hub-title {
        font-size: var(--font-size-2xl);
    }
}
</style>

<?php include '../includes/footer.php'; ?>
