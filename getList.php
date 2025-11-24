<?php
$apiKey = 'AIzaSyAaxpeDovmemrgXCScCKVlFwO2V7zkWQ_Y';
$channelId = 'UCe0ih17drjz3cV84gf6K8Tw'; // Canal Once
$videos = [];
$pageToken = '';

do {
    $url = "https://www.googleapis.com/youtube/v3/search?key={$apiKey}&channelId={$channelId}&part=id&order=date&maxResults=50&pageToken={$pageToken}";
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    
    foreach ($data['items'] as $item) {
        if (isset($item['id']['videoId'])) {
            $videos[] = $item['id']['videoId'];
        }
    }

    $pageToken = $data['nextPageToken'] ?? '';
    sleep(0.1); // evita throttling
} while ($pageToken != '');

file_put_contents('videos.txt', implode("\n", $videos));
echo "Total videos encontrados: " . count($videos);
?>
