<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hlavní stránka</title>
    <link rel="stylesheet"  href="style.css">
    <style>
        .footer {
            padding-top: 1000px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #282828;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .footer a {
            color: #FFD700;
            text-decoration: none;
        }

        .footer a:hover {
            color: #FF6347;
        }

        .profile-container {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .profile {
            width: 40%;
        }

        .profile img {
            width: 100%;
            height: auto;
        }
        
        .header-text, .references {
            text-align: center;
            padding: 20px;
            font-size: 1.5em;
        }

        .references {
            padding-top: 1000px; /* To make the page long enough for scrolling */
        }
    </style>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <div class="header-text">
        <p>Welcome to our creative studio. We are a team of two professionals specializing in videography, photography, video editing, and marketing. </p>
    </div>

    <div class="profile-container">
        <div class="profile">
            <img src="example-image1.jpg" alt="Videographer and Photographer">
            <p>John Doe - a skilled videographer and photographer. Known for his ability to capture the perfect moments and edit them into timeless pieces.</p>
        </div>

        <div class="profile">
            <img src="example-image2.jpg" alt="Video Editor and Marketing Specialist">
            <p>Jane Doe - an experienced video editor and marketing specialist. Her expertise lies in creating engaging videos and effective marketing strategies.</p>
        </div>
    </div>

    <div class="references">
        <h2>Our Work</h2>
        <p>Here are some examples of our work and references from our satisfied clients. We take pride in our work and strive to deliver the best results for our clients.</p>
        <!-- Add examples of work and references here -->
    </div>

    <footer>
        <div class="footer">
            <p><a href="mailto:john.doe@example.com">john.doe@example.com</a> | <a href="tel:0123456789">0123456789</a> | John Doe</p>
            <p><a href="mailto:jane.doe@example.com">jane.doe@example.com</a> | <a href="tel:9876543210">9876543210</a> | Jane Doe</p>
            <p><a href="#">Back to Top</a></p>
        </div>
    </footer>
</body>
</html>
