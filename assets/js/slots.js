document.addEventListener('DOMContentLoaded', function() {
    const symbols = ['🍒','🍋','🍊','🍇','💎','⭐','7️⃣'];
    const payouts = {'🍒':5,'🍋':10,'🍊':15,'🍇':20,'💎':50,'⭐':100,'7️⃣':500};
    const spinBtn = document.getElementById('spinButton');
    const reels = [document.getElementById('reel1'),document.getElementById('reel2'),document.getElementById('reel3')];
    
    spinBtn.addEventListener('click', function() {
        const bet = parseInt(document.getElementById('betAmount').value) || 10;
        const credits = getCredits();
        if (bet < 1 || bet > credits) { alert('Invalid bet!'); return; }
        setCredits(credits - bet);
        
        reels.forEach(r => r.classList.add('spinning'));
        const results = [];
        
        setTimeout(() => {
            reels.forEach((reel, i) => {
                const symbol = symbols[Math.floor(Math.random() * symbols.length)];
                results.push(symbol);
                reel.querySelector('.symbol').textContent = symbol;
                reel.classList.remove('spinning');
            });
            
            if (results[0] === results[1] && results[1] === results[2]) {
                const multiplier = payouts[results[0]];
                const win = bet * multiplier;
                setCredits(getCredits() + win);
                document.getElementById('lastWin').textContent = win;
                alert('WIN! ' + multiplier + 'x = ' + win + ' credits!');
            } else {
                document.getElementById('lastWin').textContent = 0;
            }
            updateUI();
        }, 2000);
    });
    
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('betAmount').value = this.dataset.amount === 'max' ? getCredits() : this.dataset.amount;
        });
    });
    
    function getCredits() { return parseInt(localStorage.getItem('credits') || '1000'); }
    function setCredits(amount) { localStorage.setItem('credits', amount); updateUI(); }
    function updateUI() { document.getElementById('credits').textContent = getCredits(); }
    updateUI();
});
