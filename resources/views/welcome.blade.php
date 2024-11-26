<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Sentiment Analysis</title>
</head>
<body>
    <h1>Sentiment Analysis</h1>
    <form method="POST" action="/analyze">
        @csrf
        <textarea name="text" placeholder="Enter text to analyze"></textarea>
        <br>
        <button type="submit">Analyze</button>
    </form>
</body>
</html>
