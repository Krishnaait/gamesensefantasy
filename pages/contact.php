<?php
/**
 * GameSense Fantasy - Contact Us Page
 */

require_once '../config/config.php';

$page_title = "Contact Us";
$page_description = "Get in touch with the GameSense Fantasy team. We are here to help with any questions or feedback.";

include '../includes/header.php';

// Handle form submission (demo only)
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = true;
}
?>

<section class="contact-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Contact Us</h1>
        <p class="text-lg">Have questions or feedback? We'd love to hear from you.</p>
    </div>
</section>

<section class="contact-content">
    <div class="container">
        <div class="game-wrapper">
            <!-- Contact Form -->
            <div class="card p-2xl">
                <?php if ($success): ?>
                    <div class="alert alert-success mb-xl">
                        <h3>Thank You!</h3>
                        <p>Your message has been sent successfully. We will get back to you as soon as possible.</p>
                    </div>
                <?php endif; ?>

                <h2 class="mb-lg">Send us a Message</h2>
                <form action="/pages/contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="technical">Technical Support</option>
                            <option value="feedback">Feedback</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="How can we help you?" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-full">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="control-panel">
                <h2 class="control-title">Contact Information</h2>
                <div class="mb-xl">
                    <h3 class="text-gold mb-sm">Email Support</h3>
                    <p><a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a></p>
                    <p class="text-sm text-tertiary">We typically respond within 24-48 hours.</p>
                </div>
                
                <div class="mb-xl">
                    <h3 class="text-gold mb-sm">Office Address</h3>
                    <p><?php echo COMPANY_ADDRESS; ?></p>
                </div>

                <div class="mb-xl">
                    <h3 class="text-gold mb-sm">Business Hours</h3>
                    <p>Monday - Friday: 10:00 AM - 6:00 PM</p>
                    <p>Saturday - Sunday: Closed</p>
                </div>

                <div class="alert alert-info">
                    <p><strong>Note:</strong> We do not provide phone support. All inquiries must be sent via email or the contact form.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
}

.w-full {
    width: 100%;
}
</style>

<?php include '../includes/footer.php'; ?>
