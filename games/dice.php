<?php
/**
 * GameSense Fantasy - Dice Game
 * Predict the sum of two dice: Under 7, Exactly 7, or Over 7
 */

require_once '../config/config.php';

$page_title = "Dice Game";
$page_description = "Predict the sum of two dice and win big!";
$page_css = "game.css";
$page_js = "dice.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🎲 Dice Game 🎲</h2>
            
            <div class="game-content">
                <!-- Two Dice Display -->
                <div class="dice-container">
                    <div class="dice" id="dice1">
                        <div class="dice-face">?</div>
                    </div>
                    <div class="dice-plus">+</div>
                    <div class="dice" id="dice2">
                        <div class="dice-face">?</div>
                    </div>
                    <div class="dice-equals">=</div>
                    <div class="dice-total" id="diceTotal">?</div>
                </div>
                
                <!-- Prediction Buttons -->
                <div class="prediction-section mt-lg">
                    <h3 class="text-gold mb-md">Make Your Prediction</h3>
                    <div class="prediction-buttons">
                        <button class="btn btn-secondary prediction-btn" data-prediction="under">
                            <span class="prediction-label">UNDER 7</span>
                            <span class="prediction-payout">2x Payout</span>
                        </button>
                        <button class="btn btn-secondary prediction-btn" data-prediction="exactly">
                            <span class="prediction-label">EXACTLY 7</span>
                            <span class="prediction-payout">5x Payout</span>
                        </button>
                        <button class="btn btn-secondary prediction-btn" data-prediction="over">
                            <span class="prediction-label">OVER 7</span>
                            <span class="prediction-payout">2x Payout</span>
                        </button>
                    </div>
                </div>
                
                <!-- How to Play -->
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🎯 Predict if the sum of two dice will be Under 7, Exactly 7, or Over 7</li>
                        <li>💰 Place your bet amount</li>
                        <li>🎲 Click "Roll Dice" to see the result</li>
                        <li>✨ Under 7 or Over 7: Win 2x your bet</li>
                        <li>🎉 Exactly 7: Win 5x your bet!</li>
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
                    <input type="number" id="betAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
                <div class="quick-bet-buttons mt-md">
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="10">10</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="50">50</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="100">100</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="250">250</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="500">500</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="max">MAX</button>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Credits</label>
                <div class="balance-display" id="credits">1000</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Potential Win</label>
                <div class="potential-win-display" id="potentialWin">0</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Statistics</label>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Total Rolls:</span>
                        <span class="stat-value" id="totalRolls">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Wins:</span>
                        <span class="stat-value" id="totalWins">0</span>
                    </div>
                </div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="rollButton">🎲 ROLL DICE 🎲</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Exactly 7 is harder to hit but pays 5x! Under and Over pay 2x.</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

.dice-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-lg);
    margin: var(--spacing-2xl) 0;
    flex-wrap: wrap;
}

.dice {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: var(--radius-lg);
    border: 3px solid var(--accent-gold);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: diceFloat 2s ease-in-out infinite;
}

.dice-face {
    font-size: 48px;
    font-weight: bold;
    color: #000;
}

.dice-plus, .dice-equals {
    font-size: 36px;
    font-weight: bold;
    color: var(--accent-gold);
}

.dice-total {
    font-size: 48px;
    font-weight: bold;
    color: var(--accent-gold);
    min-width: 80px;
    text-align: center;
}

@keyframes diceFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.prediction-section {
    padding: var(--spacing-lg);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-light);
}

.prediction-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--spacing-md);
}

.prediction-btn {
    display: flex;
    flex-direction: column;
    padding: var(--spacing-lg);
    transition: all 0.3s ease;
}

.prediction-btn.active {
    background: var(--accent-gold);
    color: #000;
    transform: scale(1.05);
}

.prediction-label {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    margin-bottom: var(--spacing-sm);
}

.prediction-payout {
    font-size: var(--font-size-sm);
    opacity: 0.8;
}

.quick-bet-buttons {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: var(--spacing-sm);
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-md);
}

.stat-item {
    display: flex;
    flex-direction: column;
    padding: var(--spacing-sm);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
}

.stat-label {
    font-size: var(--font-size-sm);
    opacity: 0.7;
}

.stat-value {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    color: var(--accent-gold);
}

.potential-win-display {
    font-size: var(--font-size-xl);
    font-weight: var(--font-weight-bold);
    padding: var(--spacing-md);
    background: rgba(255, 215, 0, 0.1);
    border-radius: var(--radius-md);
    text-align: center;
    color: var(--accent-gold);
}

@media (max-width: 768px) {
    .dice-container {
        gap: var(--spacing-md);
    }
    
    .dice {
        width: 80px;
        height: 80px;
    }
    
    .dice-face {
        font-size: 36px;
    }
    
    .prediction-buttons {
        grid-template-columns: 1fr;
    }
    
    .quick-bet-buttons {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>

<?php include '../includes/footer.php'; ?>
