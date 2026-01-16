<?php
/**
 * GameSense Fantasy - About Us Page
 */

require_once '../config/config.php';

$page_title = "About Us";
$page_description = "Learn more about GameSense Fantasy, our mission, and our commitment to safe, free-to-play social gaming.";

include '../includes/header.php';
?>

<section class="about-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>About <?php echo SITE_NAME; ?></h1>
        <p class="text-lg">India's Premier Social Gaming Destination</p>
    </div>
</section>

<section class="about-content">
    <div class="container">
        <div class="card p-2xl mb-2xl">
            <h2 class="mb-lg">Our Mission</h2>
            <p>At <?php echo SITE_NAME; ?>, our mission is to provide a world-class social gaming experience that is accessible, entertaining, and completely free of financial risk. We believe that the excitement of casino-style games should be available to everyone for pure entertainment purposes.</p>
            <p>We are dedicated to building a platform where players can enjoy high-quality games, compete with others, and experience the thrill of winning virtual coins in a safe and responsible environment.</p>
        </div>

        <div class="footer-content mb-2xl">
            <div class="card">
                <h3 class="text-gold mb-md">Who We Are</h3>
                <p><?php echo SITE_NAME; ?> is a product of <strong><?php echo COMPANY_NAME; ?></strong>, a technology-driven company based in Agra, Uttar Pradesh. We are a team of passionate gamers and developers committed to creating the best social gaming platform in India.</p>
            </div>
            <div class="card">
                <h3 class="text-gold mb-md">What We Offer</h3>
                <p>We offer a diverse collection of 10+ social casino games, including classics like Slots, Poker, and Blackjack, as well as unique titles like Chicken, Mines, and 247LASER. All our games are built with high-quality graphics and fair mechanics.</p>
            </div>
        </div>

        <div class="card p-2xl mb-2xl">
            <h2 class="mb-lg">Our Core Values</h2>
            <div class="footer-content">
                <div class="value-item">
                    <h4 class="text-gold">Transparency</h4>
                    <p>We are open about our game mechanics and the fact that our platform uses virtual coins only with no real-world value.</p>
                </div>
                <div class="value-item">
                    <h4 class="text-gold">Fair Play</h4>
                    <p>All our games use certified Random Number Generators (RNG) to ensure that every outcome is completely fair and unbiased.</p>
                </div>
                <div class="value-item">
                    <h4 class="text-gold">Responsibility</h4>
                    <p>We promote responsible gaming and provide tools and information to help our users play safely.</p>
                </div>
                <div class="value-item">
                    <h4 class="text-gold">Innovation</h4>
                    <p>We are constantly working to improve our platform and add new, exciting games for our community.</p>
                </div>
            </div>
        </div>

        <div class="card p-2xl text-center">
            <h2 class="mb-lg">Company Information</h2>
            <p><strong>Legal Name:</strong> <?php echo COMPANY_NAME; ?></p>
            <p><strong>CIN:</strong> <?php echo COMPANY_CIN; ?></p>
            <p><strong>GST:</strong> <?php echo COMPANY_GST; ?></p>
            <p><strong>PAN:</strong> <?php echo COMPANY_PAN; ?></p>
            <p><strong>Address:</strong> <?php echo COMPANY_ADDRESS; ?></p>
            <p><strong>Email:</strong> <?php echo COMPANY_EMAIL; ?></p>
        </div>
    </div>
</section>

<style>
.about-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
}

.value-item {
    padding: 15px;
    border-bottom: 1px solid var(--border-light);
}

.value-item:last-child {
    border-bottom: none;
}
</style>

<?php include '../includes/footer.php'; ?>
