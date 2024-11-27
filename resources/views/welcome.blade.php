<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Sentiment Analysis</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, aquamarine, cyan); 
            color: #1c1f26; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #ffffff; 
            color: #1c1f26; 
            border: none;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
            width: 100%;
            max-width: 600px; 
        }

        .card-header {
            background: linear-gradient(135deg, aquamarine, cyan); 
            color: #1c1f26; 
            font-weight: bold;
            text-align: center;
            font-size: 1.5rem;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
        }

        textarea {
            background-color: #f0f8ff; 
            color: #1c1f26; 
            border: 1px solid aquamarine;
            border-radius: 4px;
            padding: 10px;
            resize: vertical;
            max-height: 300px;
            overflow-y: auto;
        }

        textarea:focus {
            border-color: cyan;
            box-shadow: 0 0 5px cyan;
        }

        .btn-primary {
            background-color: aquamarine;
            border: none;
            color: #1c1f26; 
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: cyan;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .alert {
            text-align: center;
        }

        p {
    word-wrap: break-word;
        }

        .positive {
        color: green;
        font-weight: bold;
        }
        .negative {
            color: red;
            font-weight: bold;
        }
        .neutral {
            color: darkgray;
        }
        
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            Analyze Sentiment
        </div>
        <div class="card-body">
            <form method="POST" action="/analyze">
                @csrf
                <div class="mb-3">
                    <label for="text" class="form-label">{{ __('Enter Text') }}</label>
                    <textarea name="text" id="text" class="form-control" rows="5" placeholder="{{ __('Type text here...') }}" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">{{ __('Analyze') }}</button>
            </form>
            
            @if(isset($highlightedText))
            <div class="alert alert-info mt-3">
                <strong>Analysis Result:</strong> The sentiment is <b>{{ $sentiment }}</b>.
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Analysis Details</h5>
                    <p><strong>Submitted Text:</strong></p>
                    <p>{!! $highlightedText !!}</p> <!-- Render highlighted text -->
                    <p><strong>Positive Words(green):</strong> {{ $positiveCount }}</p>
                    <p><strong>Negative Words(red):</strong> {{ $negativeCount }}</p>
                    <p><strong>Neutral Words(grey):</strong> {{ $neutralCount }}</p>
                </div>
            </div>
        @endif

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
