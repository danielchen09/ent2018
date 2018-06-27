<?php
        //-----Google map value Start-----
        $set_address="台中市西區公益路68號"; //填寫所要的地址，Example地址為勤美綠園道
        $data_array = geocode($set_address);
        $latitude = $data_array[0];
        $longitude = $data_array[1];
        $data_address = $data_array[2];
        //-----Google map value End-----
        
        //-----function start-----
        function geocode($address){
            /*用來將字串編碼，在資料傳遞的時候，如果直接傳遞中文會出問題，所以在傳遞資料時，通常會使用urlencode先編碼之後再傳遞*/
            $address = urlencode($address);

            /*可參閱：(https://developers.google.com/maps/documentation/geocoding/intro)*/
            $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&language=zh-TW";

            /*取得回傳的json值*/
            $response_json = file_get_contents($url);

            /*處理json轉為變數資料以便程式處理*/
            $response = json_decode($response_json, true);

            /*如果能夠進行地理編碼，則status會回傳OK*/ 
            if($response['status']='OK'){
                //取得需要的重要資訊
                $latitude_data = $response['results'][0]['geometry']['location']['lat']; //緯度
                $longitude_data = $response['results'][0]['geometry']['location']['lng']; //精度
                $data_address = $response['results'][0]['formatted_address'];

                if($latitude_data && $longitude_data && $data_address){

                    $data_array = array();            
                    
                    //一個或多個單元加入陣列末尾
                    array_push(
                        $data_array,
                        $latitude_data, //$data_array[0]
                        $longitude_data, //$data_array[1]
                        '<b>地址: </b> '.$data_address //$data_array[2]
                    );

                    return $data_array; //回傳$data_array

                }else{
                    return false;
                }

            }else{
                return false;
            }
        }
        //-----function end-----
        ?>