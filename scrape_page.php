<?
//print_r 'https://dotabuff.com/players/' . $_GET['playerId'] + '/matches';
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,"https://dotabuff.com/players/" . $_GET["playerId"] . "/matches");
//curl_setopt($curl_handle, CURLOPT_URL,'https://dotabuff.com/players/20651784/matches');
curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_handle, CURLOPT_HEADER, true);
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$html = curl_exec($curl_handle);
curl_close($curl_handle);
//print_r("HTML:");
//print_r($html);

//parse the html into a DOMDocument
$dom = new DOMDocument();
@$dom->loadHTML($html);

//print_r($dom);
//grab all the links on the page
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("//section/article/nav/span[8]/a");
//$hrefs = $xpath->evaluate("//a");

//print_r($hrefs);


for ($i = 0; $i < $hrefs->length; $i++) {
    $href = $hrefs->item($i);
    $url = $href->getAttribute('href');
   	echo json_encode(array('url'=>$url));

}

?>