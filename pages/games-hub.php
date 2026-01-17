<?php
require_once '../config/config.php';
$page_title = "All Games";
include '../includes/header.php';
?>

<div class="container">
    <h1 class="page-title">🎮 All Games 🎮</h1>
    
    <div class="games-grid">
        <div class="game-card">
            <img src="../assets/images/game_dice.jpg" alt="Dice">
            <h3>🎲 Dice</h3>
            <p>Predict dice outcomes</p>
            <a href="../games/dice.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <img src="../assets/images/game_chicken.jpg" alt="Chicken">
            <h3>🐔 Chicken</h3>
            <p>Pick eggs, avoid bones</p>
            <a href="../games/chicken.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <img src="../assets/images/game_mines.jpg" alt="Mines">
            <h3>💣 Mines</h3>
            <p>Click safe tiles</p>
            <a href="../games/mines.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <img src="../assets/images/game_plinko.jpg" alt="Plinko">
            <h3>🎯 Plinko</h3>
            <p>Drop ball through pegs</p>
            <a href="../games/plinko.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <img src="../assets/images/game_slots.png" alt="Slots">
            <h3>🎰 Slots</h3>
            <p>Spin to win big</p>
            <a href="../games/slots.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <h3>⚡ 11X</h3>
            <p>Crash multiplier game</p>
            <a href="../games/11x.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <h3>🔫 247LASER</h3>
            <p>Shoot targets</p>
            <a href="../games/247laser.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <img src="../assets/images/game_poker.png" alt="Poker">
            <h3>🃏 Poker</h3>
            <p>Video poker</p>
            <a href="../games/poker.php" class="btn btn-primary">Play Now</a>
        </div>
        
        <div class="game-card">
            <img src="../assets/images/game_blackjack.png" alt="Blackjack">
            <h3>🎴 Blackjack</h3>
            <p>Beat the dealer</p>
            <a href="../games/blackjack.php" class="btn btn-primary">Play Now</a>
        </div>
    </div>
</div>

<style>
.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    margin: 40px 0;
}

.game-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    border: 2px solid var(--accent-gold);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s;
}

.game-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(255,215,0,0.3);
}

.game-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

.game-card h3 {
    color: var(--accent-gold);
    margin: 15px 0 10px;
}

.game-card p {
    color: rgba(255,255,255,0.7);
    margin-bottom: 20px;
}
</style>

<?php include '../includes/footer.php'; ?>
