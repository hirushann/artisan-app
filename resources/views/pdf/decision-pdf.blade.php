<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Decision Report</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        h1 { color: #F97316; border-bottom: 2px solid #F97316; padding-bottom: 10px; }
        h2 { color: #333; margin-top: 20px; border-bottom: 1px solid #ddd; }
        h3 { font-size: 16px; margin-bottom: 5px; }
        .meta { color: #666; font-size: 12px; margin-bottom: 20px; }
        .summary { background: #f9fafb; padding: 15px; border-radius: 5px; border: 1px solid #eee; }
        .recommendation { background: #ecfdf5; padding: 15px; border-radius: 5px; border: 1px solid #a7f3d0; margin-top: 20px; }
        .rec-title { color: #065f46; font-weight: bold; font-size: 18px; }
        .option { margin-bottom: 20px; padding: 10px; border: 1px solid #eee; page-break-inside: avoid; }
        .option-header { display: flex; justify-content: space-between; align-items: center; background: #f3f4f6; padding: 5px 10px; }
        .pros-cons { display: table; width: 100%; margin-top: 10px; }
        .col { display: table-cell; width: 48%; vertical-align: top; padding: 5px; }
        .pro-title { color: #166534; font-weight: bold; border-bottom: 1px solid #bbf7d0; }
        .con-title { color: #991b1b; font-weight: bold; border-bottom: 1px solid #fecaca; }
        ul { margin-top: 5px; padding-left: 20px; font-size: 13px; }
        .chart-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
        .chart-table th, .chart-table td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        .chart-table th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h1>{{ $decision->main_purpose }}</h1>
    <div class="meta">
        Category: {{ $decision->sub_purpose }} | Date: {{ $decision->created_at->format('F j, Y') }}
    </div>

    <div class="summary">
        <strong>Summary:</strong><br>
        {{ $parsedResponse['summary'] ?? 'N/A' }}
    </div>

    @if(isset($parsedResponse['recommendation']))
        <div class="recommendation">
            <div class="rec-title">Recommended: {{ $parsedResponse['recommended_option'] ?? 'Best Option' }}</div>
            <p>{{ $parsedResponse['recommendation'] }}</p>
        </div>
    @endif

    {{-- Criteria Table --}}
    @if(isset($parsedResponse['criteria_analysis']) && is_array($parsedResponse['criteria_analysis']))
        <h2>Criteria Analysis</h2>
        <table class="chart-table">
            <thead>
                <tr>
                    <th>Criteria</th>
                    @if(isset($parsedResponse['options_analysis']))
                        @foreach($parsedResponse['options_analysis'] as $opt)
                            <th>{{ $opt['name'] }}</th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($parsedResponse['criteria_analysis'] as $row)
                    <tr>
                        <td>{{ $row['criterion'] ?? ($row['name'] ?? 'Criterion') }}</td>
                         @if(isset($parsedResponse['options_analysis']))
                            @foreach($parsedResponse['options_analysis'] as $opt)
                                @php
                                    $score = '-';
                                    if (isset($row['scores']) && isset($row['scores'][$opt['name']])) {
                                        $score = $row['scores'][$opt['name']];
                                    }
                                @endphp
                                <td>{{ $score }}/10</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Options Details</h2>
    @if(isset($parsedResponse['options_analysis']))
        @foreach($parsedResponse['options_analysis'] as $option)
            <div class="option">
                <div class="option-header">
                    <strong>{{ $option['name'] }}</strong>
                    @if(isset($option['score']))
                        <span>Score: <strong>{{ $option['score'] }}</strong></span>
                    @endif
                </div>
                
                @if(isset($option['reasoning']))
                    <div style="font-size: 12px; font-style: italic; margin-top: 5px; color: #555;">{{ $option['reasoning'] }}</div>
                @endif

                <div class="pros-cons">
                    <div class="col">
                        <div class="pro-title">Pros</div>
                        <ul>
                            @foreach($option['pros'] ?? [] as $pro)
                                <li>{{ $pro }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <div class="con-title">Cons</div>
                        <ul>
                            @foreach($option['cons'] ?? [] as $con)
                                <li>{{ $con }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div style="text-align: center; font-size: 10px; color: #999; margin-top: 50px;">
        Generated by Artisan AI Decision Maker
    </div>
</body>
</html>
