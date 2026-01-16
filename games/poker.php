<?php
/**
 * GameSense Fantasy - Poker Game
 * Video poker game
 */

require_once '../config/config.php';

$page_title = "Poker Game";
$page_description = "Play video poker and try to make the best hand.";
$page_css = "game.css";
$page_js = "poker.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🃏 Poker Game</h2>
            
            <div class="game-content">
                <canvas id="pokerCanvas" width="600" height="350"></canvas>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Current Hand:</span>
                        <span id="pokerHand" class="text-gold">-</span>
                    </div>
                    <div class="info-row">
                        <span>Games Played:</span>
                        <span id="gamesPlayed" class="text-gold">0</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🃏 Click "Deal" to get 5 cards</li>
                        <li>🔄 Select cards to hold (click to toggle)</li>
                        <li>🎯 Click "Draw" to replace cards</li>
                        <li>💰 Win based on your final hand</li>
                        <li>🏆 Royal Flush = 250x bet!</li>
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
                    <input type="number" id="pokerBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="pokerBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Last Win</label>
                <div class="winnings-display text-success" id="pokerWinningsDisplay">0 Coins</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="pokerDealBtn" onclick="dealPoker()">Deal</button>
                <button class="btn btn-success btn-block hidden" id="pokerDrawBtn" onclick="drawPoker()">Draw</button>
                <button class="btn btn-secondary btn-block" id="pokerResetBtn" onclick="resetPoker()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Click cards to hold them. Higher hands pay more!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#pokerCanvas {
    border: 2px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(255, 215, 0, 0.05));
    display: block;
    margin: 0 auto;
    cursor: pointer;
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

.game-instructions ul {
    list-style-position: inside;
}

.game-instructions li {
    margin-bottom: 10px;
}
</style>

<?php include '../includes/footer.php'; ?>
