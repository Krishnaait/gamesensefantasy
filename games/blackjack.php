<?php
require_once '../config/config.php';
$page_title = "Blackjack Game";
$page_js = "blackjack.js";
include '../includes/header.php';
?>
<div class="game-container"><div class="game-wrapper">
<div class="game-area"><h2 class="game-title">🎴 BLACKJACK 🎴</h2>
<div style="text-align:center">
<div><h3 style="color:gold">Dealer: <span id="dealerScore">0</span></h3>
<div id="dealerHand" style="display:flex;gap:10px;justify-content:center;margin:20px 0"></div></div>
<div><h3 style="color:gold">You: <span id="playerScore">0</span></h3>
<div id="playerHand" style="display:flex;gap:10px;justify-content:center;margin:20px 0"></div></div>
<h3 id="gameResult" style="color:gold"></h3>
</div></div>
<div class="control-panel"><h2>Controls</h2>
<div class="control-section mb-xl"><label>Bet Amount</label>
<input type="number" id="betAmount" value="10" min="1">
<div class="quick-bet-buttons mt-md">
<button class="btn btn-sm quick-bet" data-amount="10">10</button>
<button class="btn btn-sm quick-bet" data-amount="50">50</button>
<button class="btn btn-sm quick-bet" data-amount="100">100</button>
<button class="btn btn-sm quick-bet" data-amount="max">MAX</button>
</div></div>
<div class="control-section mb-xl"><label>Credits</label><div id="credits">1000</div></div>
<div class="control-section mb-xl"><label>Last Win</label><div id="lastWin">0</div></div>
<button class="btn btn-primary btn-block" id="dealButton">🎴 DEAL 🎴</button>
<button class="btn btn-success btn-block" id="hitButton" style="display:none">👊 HIT 👊</button>
<button class="btn btn-warning btn-block" id="standButton" style="display:none">✋ STAND ✋</button>
</div></div></div>
<?php include '../includes/footer.php'; ?>
