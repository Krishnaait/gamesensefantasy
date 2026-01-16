<?php
/**
 * GameSense Fantasy - Slots Game
 * Classic slot machine game
 */

require_once '../config/config.php';

$page_title = "Slots Game";
$page_description = "Spin the reels and try to match symbols for big wins.";
$page_css = "game.css";
$page_js = "slots.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🎰 Slots Game</h2>
            
            <div class="game-content">
                <canvas id="slotsCanvas" width="600" height="300"></canvas>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Last Win:</span>
                        <span id="lastSlotWin" class="text-gold">0 Coins</span>
                    </div>
                    <div class="info-row">
                        <span>Total Spins:</span>
                        <span id="totalSpins" class="text-gold">0</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🎰 Place your bet and click "Spin"</li>
                        <li>🍒 Match 3 symbols to win</li>
                        <li>💰 Different symbols have different payouts</li>
                        <li>🏆 Three 7s = Jackpot!</li>
                        <li>⏱️ Watch the reels spin</li>
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
                    <input type="number" id="slotsBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="slotsBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Last Result</label>
                <div class="result-display" id="slotsResultDisplay">-</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="slotsSpinBtn" onclick="spinSlots()">Spin</button>
                <button class="btn btn-secondary btn-block" id="slotsResetBtn" onclick="resetSlots()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Payouts:</strong> 🍒=2x | 🍋=3x | 🍊=4x | 🍉=5x | 7️⃣=10x</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#slotsCanvas {
    border: 3px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.3), rgba(255, 215, 0, 0.1));
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
