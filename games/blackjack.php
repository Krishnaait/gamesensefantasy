<?php
/**
 * GameSense Fantasy - Blackjack Game
 * Beat the dealer with 21
 */

require_once '../config/config.php';

$page_title = "Blackjack Game";
$page_description = "Try to beat the dealer and get 21 in this classic card game.";
$page_css = "game.css";
$page_js = "blackjack.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🎴 Blackjack Game</h2>
            
            <div class="game-content">
                <canvas id="blackjackCanvas" width="600" height="400"></canvas>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Your Hand:</span>
                        <span id="playerHand" class="text-gold">-</span>
                    </div>
                    <div class="info-row">
                        <span>Dealer Hand:</span>
                        <span id="dealerHand" class="text-gold">-</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🎴 Click "Deal" to start</li>
                        <li>👆 Click "Hit" to get another card</li>
                        <li>✋ Click "Stand" to stop</li>
                        <li>🎯 Get 21 or beat the dealer</li>
                        <li>💥 Going over 21 = Bust (you lose)</li>
                        <li>🏆 Blackjack (21 on first 2 cards) = 1.5x bet</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Control Panel -->
        <div class="control-panel">
            <h2 class="control-title">Game Controls</h2>
            
            <div class="control-section mb-xl">
                <label class="label-text">Bet Amount</label>
                <div class="input-group">
                    <input type="number" id="blackjackBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="blackjackBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Result</label>
                <div class="result-display" id="blackjackResultDisplay">-</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="blackjackDealBtn" onclick="dealBlackjack()">Deal</button>
                <button class="btn btn-secondary btn-block hidden" id="blackjackHitBtn" onclick="hitBlackjack()">Hit</button>
                <button class="btn btn-success btn-block hidden" id="blackjackStandBtn" onclick="standBlackjack()">Stand</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Dealer hits on 16 and stands on 17+</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#blackjackCanvas {
    border: 2px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(255, 215, 0, 0.05));
    display: block;
    margin: 0 auto;
    max-width: 100%;
    height: auto;
}

.game-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-md);
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
}

.result-display {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
    text-align: center;
    color: var(--accent-gold);
}

.game-instructions ul {
    list-style-position: inside;
}

.game-instructions li {
    margin-bottom: 10px;
}
</style>

<?php include '../includes/footer.php'; ?>
