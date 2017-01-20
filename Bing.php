<?php
/** 
 * Get a list of search results from Bing.
 * 
 * @package : Bing;
 * @version : 1.0;
 * @license : MIT License (MIT);
 * @author : Jochem Stoel;
 * @link : https://github.com/jochemstoel;
 * @param query, locale;
 * @return Mixed;
 */

class Bing {
	
	var $query;
	var $safe = false;
	var $xml;
	var $data = array();
	var $cache_path; 
	var $cache_file;

	function Bing($query, $safe = false) {
		
		$this->query = urlencode($query);
		$this->safe = $safe;

		$this->cache_path = dirname(__FILE__) . '/Cache/';
		$this->cache_file = preg_replace("/[^a-z0-9.]+/i", "+", $this->query) . '.json';
		
		if (file_exists($this->cache_path.$this->cache_file)) {
			$cache = file_get_contents($this->cache_path.$this->cache_file);
			$this->data = json_decode($cache, true);
		} else {
			
			$this->Query();
		}
	}

	function Query(){
	 	
	 	$agent = "AAPP Application/1.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4)";
	 	$safeParam = $this->safe == true ? '&adlt=strict' : '';
	    echo $host = "http://www.bing.com/search?q=".$this->query. $safeParam . "&format=rss";
	    $ch = curl_init();
	    
	    curl_setopt($ch, CURLOPT_URL, $host);
	    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	 
	    $this->xml = curl_exec($ch);
	    curl_close($ch);

	    $this->Parse();
	}

	function Parse() {
		
		$dom = xml_to_array($this->xml);

		foreach ($dom['channel']['item'] as $item) {
			$this->data[] = $item;
		}

		$this->link = "http://www.bing.com/search?q=".$this->query;

		$this->Cache();
	}

	function Cache() {
		
		$json = json_encode($this->data);
		
		if (is_writable($this->cache_path)) {
			file_put_contents($this->cache_path.$this->cache_file, $json);
		}
	}
}

function xml_to_array($xml,$main_heading = '') {
    $deXml = simplexml_load_string($xml);
    $deJson = json_encode($deXml);
    $xml_array = json_decode($deJson,TRUE);
    if (! empty($main_heading)) {
        $returned = $xml_array[$main_heading];
        return $returned;
    } else {
        return $xml_array;
    }
}
?>