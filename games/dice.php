<?php
/**
 * GameSense Fantasy - Dice Game
 * Predict dice outcomes and win coins
 */

require_once '../config/config.php';

$page_title = "Dice Game";
$page_description = "Predict the dice outcome and win big in this exciting game of chance.";
$page_css = "game.css";
$page_js = "dice.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🎲 Dice Game</h2>
            
            <div class="game-content">
                <div class="dice-display">
                    <canvas id="diceCanvas" width="200" height="200"></canvas>
                </div>
                
                <div class="prediction-section mt-lg">
                    <h3 class="text-gold mb-md">Predict the Outcome</h3>
                    <div class="prediction-buttons">
                        <button class="btn btn-secondary" onclick="selectPrediction('high')">HIGH (4-6)</button>
                        <button class="btn btn-secondary" onclick="selectPrediction('low')">LOW (1-3)</button>
                        <button class="btn btn-secondary" onclick="selectPrediction('even')">EVEN (2,4,6)</button>
                        <button class="btn btn-secondary" onclick="selectPrediction('odd')">ODD (1,3,5)</button>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🎲 Select your prediction (High/Low/Even/Odd)</li>
                        <li>💰 Place your bet</li>
                        <li>🎯 Click "Roll Dice" to see the result</li>
                        <li>✓ If correct, you win 2x your bet</li>
                        <li>✗ If wrong, you lose your bet</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Control Panel -->
        <div class="control-panel">
            <h2 class="control-title">Game Controls</h2>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Selection</label>
                <div class="selection-display" id="selectionDisplay">None</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Bet Amount</label>
                <div class="input-group">
                    <input type="number" id="betAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="balanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Last Result</label>
                <div class="result-display" id="resultDisplay">-</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="rollBtn" onclick="rollDice()">Roll Dice</button>
                <button class="btn btn-secondary btn-block" id="resetBtn" onclick="resetGame()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Each prediction has a 50% chance of winning. Manage your bets wisely!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

.dice-display {
    display: flex;
    justify-content: center;
    margin: var(--spacing-2xl) 0;
}

#diceCanvas {
    border: 3px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.3), rgba(255, 215, 0, 0.1));
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
}

.prediction-section {
    padding: var(--spacing-lg);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-light);
}

.prediction-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: var(--spacing-md);
}

.selection-display,
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

@media (max-width: 768px) {
    .prediction-buttons {
        grid-template-columns: 1fr 1fr;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
