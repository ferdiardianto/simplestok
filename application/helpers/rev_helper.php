<?php
	
	function dateformatindo($vardate,$type='')
	{
		$hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
		$bulan = array(1=>'Januari', 2=>'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$dywk = date('w',strtotime($vardate));
		$dywk = $hari[$dywk];
		$dy = date('j',strtotime($vardate));
		$d = date('d',strtotime($vardate));
		$mth = date('n',strtotime($vardate));
		$m = date('M',strtotime($vardate));
		$mk = date('m',strtotime($vardate));
		$y = date('y',strtotime($vardate));
		$mth = $bulan[$mth];
		$yr = date('Y',strtotime($vardate));
		$hr = date('H',strtotime($vardate));
		$mi = date('i',strtotime($vardate));

		if ($type=='') {
			return $dywk.', '.$dy.' '.$mth.' '.$yr.'';
		} elseif ($type=='1') {
			return $dywk.', '.$dy.' '.$mth.' '.$yr.' | '.$hr.':'.$mi.' WIB';
		}elseif($type=='2') {
			return $dy.' '.$mth.' '.$yr.'';
		}elseif($type=='3'){
			return $dy.' '.$mth.' '.$yr.' &nbsp; '.$hr.':'.$mi.' WIB';
		}elseif($type=='4'){
			return $dywk.', '.$dy.' '.$mth.' '.$yr ;
		}elseif($type=='5'){
			return $dy.'/'.$m.'/'.$yr.' | '.$hr.':'.$mi.' WIB';
		}elseif($type=='7'){
			return $dywk.', '.$dy.' '.$mth.' '.$yr.' - '.$hr.':'.$mi.' WIB';
		}elseif($type=='d'){
			return $d;
		}elseif($type=='mth'){
			return $m;
		}elseif($type=='yr'){
			return $yr;
		}elseif($type=='my'){
			return $m .' '.$y;
		}elseif($type=='6'){
			return $yr.'/'.$mk.'/'.$d;
		}elseif ($type==9){
	  		return date('Y-m-d',strtotime($vardate)).'T'.date('H:i:s',strtotime($vardate)).'Z';
		}
	}



	function cleanteks($teks)
	{
        $find = array('|[_]{1,}|','|[ ]{1,}|','|[^0-9A-Za-z\-.]|','|[-]{2,}|','|[.]{2,}|');
		$replace = array('.','.','','.','.');
		$newname = strtolower(preg_replace($find,$replace,$teks));
		return $newname;
    }

	function toUrlLocal($url="",$title="")
	{
		$arr= explode ( '/', $url);
		unset($arr['0'],$arr['1'],$arr['2']);
		if($arr['4']=="xml")
		{
			unset($arr['4']);
		}
		return base_url().implode('/',$arr);
	}

	function cleanteks_url($var)
	{
	    $_ex = explode('/',$var);
		$total = count($_ex);
		$title = end($_ex);
		$new_title = str_replace($title,cleanteks($title),$var);
		return $new_title;
    }


	

	function timeago( $waktu )
	{
	    $selisih = time() - $waktu;

	    if( $selisih < 1 ) {
	        return 'baru saja';
	    }

	    $kondisi = array(
            12 * 30 * 24 * 60 * 60 => 'tahun',
                 30 * 24 * 60 * 60 => 'bulan',
                  7 * 24 * 60 * 60 => 'minggu',
                      24 * 60 * 60 => 'hari',
                           60 * 60 => 'jam',
                                60 => 'menit',
                                 1 => 'detik'
	    );

	    foreach( $kondisi as $detik => $satuan ) {
	        $d = $selisih / $detik;
	        if( $d >= 1 ) {
	            $r = round( $d );
	            return $r . ' ' . $satuan . ' lalu';
	        }
	    }
	}


	function timeago2($vardate) {
        $date = date('Y-m-d H:i:s');
		// $date = $vardate;
        $secs = strtotime($date) - strtotime($vardate);
		// return $secs;
        $second = 1;
        $minute = 60;
        $hour = 60 * 60;
        $day = 60 * 60 * 24;
        $week = 60 * 60 * 24 * 7;
        $month = 60 * 60 * 24 * 7 * 30;
        $year = 60 * 60 * 24 * 7 * 30 * 365;

        if ($secs <= 0) {
            $output = "now";
        } elseif ($secs > $second && $secs < $minute) {

            $output = round($secs / $second) . " detik lalu";
        } elseif ($secs >= $minute && $secs < $hour) {

            $output = round($secs / $minute) . " menit lalu";
        } elseif ($secs >= $hour && $secs < $day) {

            $output = round($secs / $hour) . " jam lalu";
        } elseif ($secs >= $day && $secs < $week) {

            $output = round($secs / $day) . " hari lalu";
        } elseif ($secs >= $week && $secs < $month) {

            $output = round($secs / $week) . " minggu lalu";
        } elseif ($secs >= $month && $secs < $year) {

            $output = round($secs / $month) . " bulan lalu";
        } elseif ($secs >= $year && $secs < $year * 10) {

            $output = round($secs / $year) . " tahun lalu";
        } else {
            $output = "bertahun tahun lalu";
        }

        if ($output <> "now") {
            $output = (substr($output, 0, 2) <> "1 ") ? $output . "" : $output;
        }
        return $output;
}

	function clearcoma($param){
		$hasil = str_replace(',','',$param);
		return $hasil;
	}

?>