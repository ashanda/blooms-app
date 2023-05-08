<!DOCTYPE html>
<html>
<head>
    <title>Ad Accounts</title>
</head>
<body>
    <h1>Ad Accounts</h1>
    {{ dd($adsData); }}
    @foreach ($adsData as $ad)
    <div>
        <h4>{{ $ad['name'] }}</h4>
        @if ($ad['image_url'])
            <img src="{{ $ad['image_url'] }}" alt="Ad Image">
        @else
            <p>No image available</p>
        @endif
        <ul>
            @foreach ($ad['insights'] as $insight)
                <li>Ad Name: {{ $insight['ad_name'] }}</li>
                <li>Reach: {{ $insight['reach'] }}</li>
                <li>Impressions: {{ $insight['impressions'] }}</li>
                <li>Spend: {{ $insight['spend'] }}</li>
                <li>Clicks: {{ $insight['clicks'] }}</li>
                <hr>
            @endforeach
        </ul>
    </div>
@endforeach

</body>
</html>
