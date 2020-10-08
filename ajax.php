<?php

	  
	  $client_id = "250hnAjA4_tT81X4cyva";
	  $client_secret = "9xiz7ObgRf";
	  $encText = urlencode($_POST['title']);
	  $url = "https://openapi.naver.com/v1/search/movie.xml?query=".$encText."&display=1"; // json 결과
	//  $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$encText; // xml 결과
	  $is_post = false;
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_POST, $is_post);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  $headers = array();
	  $headers[] = "X-Naver-Client-Id: ".$client_id;
	  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	  $response = curl_exec ($ch);
	  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	  //echo "status_code:".$status_code."";

	  curl_close ($ch);
		
	  if($status_code == 200) {
		$xml = simplexml_load_string($response) or die("에러: 객체를 생성할 수 없습니다");
		$items = $xml->channel->item;
		if(!empty($items)){
				foreach($items as $item){
                        echo $item->image."*";
                        echo $item->link;
					}
				}
		  } else {
			echo "Error 내용:".$response;
		  }
?>