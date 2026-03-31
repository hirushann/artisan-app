<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Prism\Prism\Prism;

class Decision extends Model
{
    protected $fillable = ['main_purpose', 'sub_purpose', 'other_purpose', 'options', 'report_type', 'ai_response', 'status'];

    public function generateAnalysis()
    {
        $data = json_decode($this->options, true);
        // Handle backward compatibility if strictly array of options
        $optionsData = isset($data['options']) ? $data['options'] : $data;
        $criteriaData = isset($data['criteria']) ? $data['criteria'] : [];

        $prompt = "I need a {$this->report_type} decision report for '{$this->main_purpose}'.\n\n";
        
        if (!empty($criteriaData)) {
            $prompt .= "The decision is based on these Weighted Criteria:\n";
            foreach ($criteriaData as $c) {
                // Check if name and weight exist
                $name = $c['name'] ?? 'Unknown';
                $weight = $c['weight'] ?? 5;
                $prompt .= "- {$name} (Weight: {$weight}/10)\n";
            }
            $prompt .= "\n";
        }

        foreach ($optionsData as $opt) {
            $optName = $opt['name'] ?? 'Option';
            $pros = isset($opt['pros']) ? implode(', ', (array)$opt['pros']) : '';
            $cons = isset($opt['cons']) ? implode(', ', (array)$opt['cons']) : '';
            $prompt .= "Option: {$optName}\n";
            $prompt .= "Pros: " . $pros . "\n";
            $prompt .= "Cons: " . $cons . "\n\n";
        }

        $prompt .= "Provide a JSON response with the following structure:
        {
            \"summary\": \"Overall summary of the decision context.\",
            \"criteria_analysis\": [
                {
                    \"criterion\": \"Criterion Name\",
                    \"scores\": {
                        \"Option Name 1\": 8, // Score 1-10
                        \"Option Name 2\": 6
                    }
                }
            ],
            \"options_analysis\": [
                {
                    \"name\": \"Option Name\",
                    \"pros\": [\"Expanded Pro 1\", \"...\"],
                    \"cons\": [\"Expanded Con 1\", \"...\"],
                    \"score\": 85, // Calculated total weighted score out of 100
                    \"reasoning\": \"Why this score?\"
                }
            ],
            \"recommended_option\": \"Exact Name of Best Option\",
            \"recommendation\": \"Detailed reasoning for the recommendation, referencing the criteria weights.\"
        }";

        $response = Prism::text()
            ->using('gemini', 'gemini-flash-latest')
            ->withPrompt($prompt)
            ->generate();
        
        $json = $response->text;
        $json = preg_replace('/^```json\s*|\s*```$/', '', $json);

        $this->ai_response = $json;
        $this->status = 'completed'; // Mark as completed after analysis
        $this->save();
    }
}
