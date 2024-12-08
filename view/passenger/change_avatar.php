<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Avatar</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png"> 
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Ensure avatar icons are styled and have selection feedback */
        .avatar-options {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .avatar-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 10px;
            cursor: pointer;
            transition: transform 0.2s, border 0.2s;
            border: 3px solid transparent;
        }
        .avatar-icon:hover {
            transform: scale(1.1);
        }
        .avatar-icon.selected {
            border: 3px solid #0071CE; /* Highlight selected avatar */
        }
        #save-avatar-btn, #cancel-avatar-btn {
            width: 200px;
            padding: 10px;
            margin: 10px 0;
            font-size: 1em;
            font-weight: bold;
            color: white;
            background-color: black;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }
        #save-avatar-btn:hover, #cancel-avatar-btn:hover {
            background-color: #A7A4A4;
        }
    </style>
</head>
<body>

    <div class="avatar-page-container">
        <div class="update-cont">
            <!-- Display Current Avatar before the user's name and ID -->
            <img id="current-avatar" src="GoGora/passenger/assets/current_avatar.png" alt="Current Avatar" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
        
            <section class="update-cont">
                <!-- User Info -->
                <h2>Jane Doe</h2>
                <p>22234440</p>

                <!-- Avatar Selection (6 avatars) -->
                <div class="avatar-options">
                    <img class="avatar-icon" id="avatar1" src="assets/1.png" onclick="selectAvatar(this, 'avatars/1.png')" alt="Avatar 1">
                    <img class="avatar-icon" id="avatar2" src="assets/2.png" onclick="selectAvatar(this, 'avatars/2.png')" alt="Avatar 2">
                    <img class="avatar-icon" id="avatar3" src="assets/3.png" onclick="selectAvatar(this, 'avatars/3.png')" alt="Avatar 3">
                    <img class="avatar-icon" id="avatar4" src="assets/4.png" onclick="selectAvatar(this, 'avatars/4.png')" alt="Avatar 4">
                    <img class="avatar-icon" id="avatar5" src="assets/5.png" onclick="selectAvatar(this, 'avatars/5.png')" alt="Avatar 5">
                    <img class="avatar-icon" id="avatar6" src="assets/6.png" onclick="selectAvatar(this, 'avatars/6.png')" alt="Avatar 6">
                </div>

                <!-- Save Changes Button -->
                <form action="save_avatar.php" method="POST">
                    <input type="hidden" name="selected_avatar" id="selected-avatar" value="">
                    <button id="save-avatar-btn" class="submit-btn">Save Changes</button>
                </form>

                <!-- Cancel Button -->
                <button id="cancel-avatar-btn" class="btn-cancel" onclick="window.location.href='updateavatar.php';">Cancel</button>
            </section>
        </div>
    </div>
    
    </body>
    </html>