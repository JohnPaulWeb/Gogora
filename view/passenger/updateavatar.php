<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Avatar</title>
    <link rel="icon" type="image/png" href="assets/favicon.png"> 
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="avatar-page-container">
        <div class="update-cont">
            <!-- Avatar -->
            <img id="current-avatar" src="GoGora/passenger/assets/profile.png" alt="Current Avatar" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
        
            <section class="update-cont">
                <!-- User Info -->
                <h2>Jane Doe</h2>
                <p>22234440</p>
            
                <!-- Buttons -->
                <form action="change_avatar.php" method="POST">
                    <button id="update-avatar-btn" class="submit-btn" type="button" onclick="window.location.href='change_avatar.php';">Change Avatar</button>
                </form>

                <button id="save-avatar-btn" class="submit-btn">Save Changes</button>
                <button id="cancel-avatar-btn" class="btn-cancel" onclick="window.location.href='profile.php';">Cancel</button>
            </section>
        </div>
    </div>

</body>
</html>
