<?php

namespace App\Http\Controllers;

use App\Models\Sentiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Sentiment\Analyzer;

class SentimentController extends Controller
{
    public function analyze(Request $request)
    {
        $text = $request->input('text');
    $analyzer = new Analyzer();

    // Analyze word-level sentiment and generate highlighted text
    $words = explode(' ', $text);
    $highlightedText = '';
    $positiveCount = 0;
    $negativeCount = 0;
    $neutralCount = 0;

    foreach ($words as $word) {
        $wordResult = $analyzer->getSentiment($word);
        if ($wordResult['compound'] > 0) {
            $highlightedText .= '<span class="positive">' . htmlspecialchars($word) . '</span> ';
            $positiveCount++;
        } elseif ($wordResult['compound'] < 0) {
            $highlightedText .= '<span class="negative">' . htmlspecialchars($word) . '</span> ';
            $negativeCount++;
        } else {
            $highlightedText .= '<span class="neutral">' . htmlspecialchars($word) . '</span> ';
            $neutralCount++;
        }
    }

    // Determine overall sentiment
    if ($positiveCount > $negativeCount) {
        $sentiment = 'positive';
    } elseif ($negativeCount > $positiveCount) {
        $sentiment = 'negative';
    } else {
        $sentiment = 'neutral';
    }

    // Remove trailing space
    $highlightedText = trim($highlightedText);

    // Return results to the view
    return view('welcome', [
        'text' => $text,
        'highlightedText' => $highlightedText,
        'positiveCount' => $positiveCount,
        'negativeCount' => $negativeCount,
        'neutralCount' => $neutralCount,
        'sentiment' => $sentiment, // Pass $sentiment to the view
    ]);
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
}
