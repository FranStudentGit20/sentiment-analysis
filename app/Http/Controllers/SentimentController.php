<?php

namespace App\Http\Controllers;

use App\Models\Sentiment;
use Illuminate\Http\Request;
use Sentiment\Analyzer;

class SentimentController extends Controller
{
    public function analyze(Request $request)
    {
        $text = $request->input('text');

        // Use the Sentiment Analyzer
        $analyzer = new Analyzer();
        $result = $analyzer->getSentiment($text);

        // Determine sentiment
        $sentiment = $this->mapSentiment($result['compound']);

        // Save to the database
        $record = Sentiment::create([
            'text' => $text,
            'sentiment' => $sentiment,
        ]);

        return response()->json(['sentiment' => $sentiment, 'record' => $record]);
    }

    private function mapSentiment($score)
    {
        if ($score > 0) {
            return 'positive';
        } elseif ($score < 0) {
            return 'negative';
        }
        return 'neutral';
    }

    public function store(Request $request)
{
    // Validate incoming data
    $validated = $request->validate([
        'text' => 'required|string',
        'sentiment' => 'required|string',
    ]);

    // Truncate the text to fit the database column
    $validated['text'] = Str::limit($validated['text'], 255);

    // Insert into the database
    \DB::table('sentiments')->insert([
        'text' => $validated['text'],
        'sentiment' => $validated['sentiment'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['message' => 'Data saved successfully!']);
}
}
