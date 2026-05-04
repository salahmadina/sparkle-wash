<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile — Sparkle Wash</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>
<body>

  <nav>
    <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="#profile">Profile</a></li>
    </ul>
  </nav>

  <div class="brand">🚗 SparkleWash</div>

  <div class="card">

    <!-- Cover + Avatar -->
    <div class="cover"></div>
    <div class="avatar-wrap"><div class="avatar">👤</div></div>

    <!-- Name & Email -->
    <div class="user-info">
      <h2><?php echo htmlspecialchars($fullName ?? 'Your Name'); ?></h2>
      <p><?php echo htmlspecialchars($email ?? 'Name@example.com'); ?> · Member since 2024</p>
    </div>

    <!-- Quick stats -->
    <div class="stats">
      <div class="stat"><strong>12</strong><span>Bookings</span></div>
      <div class="stat"><strong>3</strong><span>This Month</span></div>
     </div>

    <form method="post" action="">
      <div class="field">
        <label>Full Name</label>
        <input type="text" name="fullName" value="<?php echo htmlspecialchars($fullName ?? 'Your Mohamed'); ?>" />
      </div>
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? 'Name@example.com'); ?>" />
      </div>
      <div class="field">
        <label>Phone</label>
        <input type="tel" name="phone" value="<?php echo htmlspecialchars($phone ?? '+201xxxxxxxxx'); ?>" />
      </div>
      <div class="field">
        <label>City</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($city ?? 'Cairo'); ?>" />
      </div>

      <button type="submit" class="btn-save">
        Save Changes
      </button>
      <?php if ($message): ?>
        <p id="msg"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>
    </form>

  </div>

</body>
</html>

<?php
session_start();

// Initialize variables
$fullName = $_SESSION['fullName'] ?? 'Your Name';
$email = $_SESSION['email'] ?? 'Name@example.com';
$phone = $_SESSION['phone'] ?? '+201xxxxxxxxx';
$city = $_SESSION['city'] ?? 'Cairo';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $city = $_POST['city'] ?? '';

    // Save to session
    $_SESSION['fullName'] = $fullName;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['city'] = $city;

    $message = '✅ Profile updated successfully!';
}
?>