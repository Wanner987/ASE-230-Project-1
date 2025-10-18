<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .test-section {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #007cba;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background: #005a87;
        }

        pre {
            background: #f5f5f5;
            padding: 10px;
            border-radius: 3px;
            overflow-x: auto;
        }

        input,
        select {
            padding: 5px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <h1>hello</h1>

    <div class="test-section">
        <h3>1. Get Artist by ID</h3>
        <input type="number" id="artist-id" placeholder="Artist ID" value="3">
        <button onclick="getArtistByID()">GET /artist/{id}</button>
        <pre id="artist-id-result"></pre>
    </div>

    <div id="artistResult"></div>

    <div class="test-section">
        <h3>2. Get Song by ID</h3>
        <input type="number" id="song-id" placeholder="Song ID" value="30">
        <button onclick="getSongByID()">GET /song/{id}</button>
        <pre id="Song-id-result"></pre>
    </div>

    <div id="songIDResult"></div>

    <div class="test-section">
        <h3>3. Get User by ID</h3>
        <input type="number" id="user-id" placeholder="User ID" value="300">
        <button onclick="getUserByID()">GET /user/{id}</button>
        <pre id="user-id-result"></pre>
    </div>

    <div id="artistResult"></div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="myJS.js"></script>
</body>
</html>