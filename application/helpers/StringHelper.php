<?php
class StringHelper{
	public static function concatArray2Str($array, $delimiter){
		$result = '';
		$maxCnt = count($array);
		if( $maxCnt > 0){
			$cnt = 1;
			foreach ($array as $item) {
				$result = $result.$item;
				if( $cnt < $maxCnt )
				{
					$result = $result.$delimiter;
				}
				$cnt++;
			}
		}
		return $result;
	}
}