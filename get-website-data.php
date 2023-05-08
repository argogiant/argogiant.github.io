<?php
$url = $_GET['url'];

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    echo 'Invalid URL';
    exit;
}

$html = file_get_contents($url);

if (!$html) {
    echo 'Could not fetch website data';
    exit;
}

$doc = new DOMDocument();
@$doc->loadHTML($html);

$title = $doc->getElementsByTagName('title')->item(0)->nodeValue;
$meta_title = '';
$meta_description = '';
$h1 = '';
$h2 = '';
$h3 = '';
$bold_text = '';
$italic_text = '';

$metas = $doc->getElementsByTagName('meta');

foreach ($metas as $meta) {
    if ($meta->getAttribute('name') == 'title') {
        $meta_title = $meta->getAttribute('content');
    }

    if ($meta->getAttribute('name') == 'description') {
        $meta_description = $meta->getAttribute('content');
    }
}

$headings = $doc->getElementsByTagName('h1');

if ($headings->length > 0) {
    $h1 = $headings->item(0)->nodeValue;
}

$headings = $doc->getElementsByTagName('h2');

if ($headings->length > 0) {
    $h2 = $headings->item(0)->nodeValue;
}

$headings = $doc->getElementsByTagName('h3');

if ($headings->length > 0) {
    $h3 = $headings->item(0)->nodeValue;
}

$bolds = $doc->getElementsByTagName('b');

foreach ($bolds as $bold) {
    $bold_text .= $bold->nodeValue . ' ';
}

$italics = $doc->getElementsByTagName('i');

foreach ($italics as $italic) {
    $italic_text .= $italic->nodeValue . ' ';
}

?>

<table>
    <tr>
        <th>URL</th>
        <th>Titel</th>
        <th>Meta-titel</th>
        <th>Meta-description</th>
        <th>H1</th>
        <th>H2</th>
        <th>H3</th>
        <th>Bold text</th>
        <th>Italic text</th>
    </tr>
	
	<tr>
        <td><?php echo $url; ?></td>
        <td><?php echo $title; ?></td>
        <td><?php echo $meta_title; ?></td>
        <td><?php echo $meta_description; ?></td>
        <td><?php echo $h1; ?></td>
        <td><?php echo $h2; ?></td>
        <td><?php echo $h3; ?></td>
        <td><?php echo $bold_text; ?></td>
        <td><?php echo $italic_text; ?></td>
    </tr>
</table>