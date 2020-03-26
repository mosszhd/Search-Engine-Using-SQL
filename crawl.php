<?php
include("classes/DomDocumentParser.php");

function createLink($src,$url) {

	$scheme = parse_url($url)["scheme"]; //http it will return an array saying access the scheme part of the url
	$host = parse_url($url)["host"]; //www.website.com

		if(substr($src,0,2) == "//") {
					$src = $scheme . ":" . $src;
		}

		else if(substr($src,0, 1) == "/"){
			$src = $scheme . "://" . $host . $src;
		}
		return $src;
		

}

		function followLinks($url){
			$parser = new DomDocumentParser($url);

			$linkList = $parser->getLinks();	

			foreach ($linkList as $link) {
						$href = $link->getAttribute("td");

						if(strpos($href, "#") !== false){
							continue;
						}

					else if(substr($href, 0 , 11) == "javascript:"){
						continue;
					}

			$href = createLink($href, $url);

			


						echo $href . "<br>";
					}		
		}



$startUrl= "https://rds3.northsouth.edu/"; //this is where we start to crawl website
	followLinks($startUrl);
 ?>