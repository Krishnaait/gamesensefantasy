# How to Build a Social Gaming Website: The Complete Guide

This document provides a comprehensive, step-by-step guide for building a social gaming website like GameSense Fantasy. It covers project structure, core concepts, code patterns, troubleshooting, and best practices learned during this project.

## 1. Project Overview

This guide will help you create a **free-to-play social gaming platform** using **HTML, CSS, and PHP** with vanilla JavaScript. The platform is designed to be lightweight, fast, easy to maintain, and compliant with Google Ads policies.

**Key Features:**
- **Technology Stack:** HTML, CSS, PHP, Vanilla JavaScript
- **No Database:** Uses `localStorage` for the coin system.
- **No Login/Registration:** Users can play anonymously.
- **Google Ads Compliant:** Avoids real money terminology and deceptive practices.
- **Modular Game Structure:** Easy to add new games.

## 2. Project Structure

A clean and organized project structure is crucial. Here is the recommended layout:

```
/your-project-name/
├── .gitignore
├── .htaccess
├── Procfile
├── README.md
├── assets/
│   ├── css/         # Global stylesheets
│   │   └── style.css
│   ├── images/      # All image assets
│   └── js/          # JavaScript files
│       ├── main.js    # Global functions (coin system)
│       └── [game_name].js # Game-specific logic
├── config/
│   └── config.php   # Site-wide configuration
├── games/
│   └── [game_name].php # Game HTML structure
├── includes/
│   ├── footer.php   # Site footer
│   └── header.php   # Site header
├── index.php        # Homepage
└── pages/           # Static pages (About, Contact, etc.)
    └── about.php
```

## 3. Core Concepts & Architecture

### 3.1. Centralized Configuration (`config/config.php`)

All important settings are stored in one place. This makes it easy to update company details or add new games without editing multiple files.

**Example `config.php`:**
```php
<?php
// Site Details
define("SITE_NAME", "Your Brand Name");
define("COMPANY_EMAIL", "support@yourdomain.com");

// Legal Details
define("LEGAL_NAME", "Your Company Inc.");

// Games Configuration
$GAMES = [
    [
        "id" => "dice",
        "name" => "Dice Game",
        "url" => "/games/dice.php",
        "icon" => "/assets/images/game_dice.png"
    ],
    // ... add other games here
];
?>
```

### 3.2. Global Coin System (`assets/js/main.js`)

This is the **most critical part** of the architecture. All games **must** use these global functions to manage the coin balance. This ensures the balance is consistent across the entire site.

**Key Functions in `main.js`:**
- `getCredits()`: Returns the current coin balance from `localStorage`.
- `setCredits(amount)`: Sets the coin balance in `localStorage` and updates the display.
- `addCoins(amount)`: Adds coins to the balance.
- `deductCoins(amount)`: Deducts coins from the balance.

**CRITICAL:** Game-specific JavaScript files **should not** have their own `getCredits` or `setCredits` functions. They must call the global ones.

**Example Usage in a Game File:**
```javascript
// Player places a bet
const betAmount = 100;
if (deductCoins(betAmount)) {
    // Bet successful, start the game
} else {
    showToast("Not enough coins!");
}

// Player wins
const winnings = 200;
addCoins(winnings);
showToast(`You won ${winnings} coins!`);
```

### 3.3. Page Templating (`includes/`)

- `header.php`: Contains the logo, navigation menu, and the coin balance display element (`<span id="coinBalance"></span>`). It also includes the global `style.css`.
- `footer.php`: Contains the footer links, copyright info, and includes all JavaScript files (`main.js` first, then game-specific JS).

Every page (`index.php`, `about.php`, etc.) should start with `<?php include_once __DIR__ . 

## 4. Step-by-Step Guide to Building a New Site

1.  **Create Project Structure:** Create the directory layout as shown in section 2.
2.  **Configure `config.php`:** Fill in your site name, company details, and define your games in the `$GAMES` array.
3.  **Build `header.php` and `footer.php`:** Create the main layout and navigation.
4.  **Create `index.php`:** Build your homepage, using PHP to loop through the `$GAMES` array to display featured games.
5.  **Build Static Pages:** Create `about.php`, `contact.php`, and all legal pages.
6.  **Build the Games:** For each game:
    *   Create `games/[game_name].php` with the HTML canvas and controls.
    *   Create `assets/js/[game_name].js` with the game logic.
    *   Ensure the game logic uses the global `addCoins()` and `deductCoins()` functions.

## 5. Troubleshooting Common Issues

### Issue 1: Coin balance is not updating.

- **Cause:** The game is using its own local `getCredits/setCredits` functions instead of the global ones from `main.js`.
- **Solution:** Remove the local functions from the game-specific JavaScript file. Ensure `main.js` is included before the game script in `footer.php`.

### Issue 2: Clicks on the game canvas are not working or are inaccurate.

- **Cause:** CSS is scaling the canvas, but the JavaScript click coordinates are not being adjusted.
- **Solution:** You must scale the click coordinates. In your canvas click event listener, add this logic:

```javascript
canvas.addEventListener("click", (e) => {
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    const x = (e.clientX - rect.left) * scaleX;
    const y = (e.clientY - rect.top) * scaleY;

    // Now use x and y for your game logic
});
```

### Issue 3: Game script fails because the canvas element is `null`.

- **Cause:** The JavaScript is running before the HTML DOM is fully loaded.
- **Solution:** Wrap your entire game logic inside a `DOMContentLoaded` event listener.

```javascript
document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("gameCanvas");
    if (!canvas) return;
    const ctx = canvas.getContext("2d");

    // ... ALL your game code goes here ...
});
```

## 6. Deployment Guide (Railway.app)

1.  **Create a GitHub Repository:** Initialize a git repo and push your code.
2.  **Create a `Procfile`:** Create a file named `Procfile` in the root directory with this content:
    ```
    web: vendor/bin/heroku-php-apache2
    ```
3.  **Connect to Railway:** Create a new project on Railway, connect it to your GitHub repository, and deploy. Railway will automatically detect the PHP project and deploy it.

This guide provides a robust foundation for creating multiple high-quality social gaming websites. By following these patterns and best practices, you can ensure your projects are maintainable, scalable, and compliant.
