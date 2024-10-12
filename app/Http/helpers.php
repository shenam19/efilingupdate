<?php
	
	use Carbon\Carbon;

	//Returnd human friendly date string
	function dateString($date)
	{
		return Carbon::parse( $date )->toFormattedDateString();

	}

	//Returns extension name from mime type of media
	function getExtension($file_name)
	{
		return strtoupper(substr($file_name,strripos($file_name,'.')+1));
	}

	//Returns fiscal year
	function fiscalYear()
	{
		$year = date('Y');
		$today = Carbon::today();
		$start = Carbon::create($year, 4, 1);
		if($today->lessThan($start))
		{
			return $year-1 .' - '.$year;
		}
		else
		{
			return $year .' - '.++$year;
		}
	}

	//Returns the url for media uploaded
	function get_url($media)
	{
		$year = $media->created_at->year ?? '';
		$month = $media->created_at->englishMonth ?? '';
		$id = $media->id ?? '';
		$name = $media->file_name ?? '';

		return 'media'. '/' . $year . '/' . $month. '/' . $id . '/' . $name;
	}

	//Gets the thumbnail of a media
	function getThumb($ext, $uuid)
	{
		$thumb = strtolower($ext).'-thumb.png';
		$url = asset("img/".$thumb);

		if (file_exists(public_path('img/'.$thumb)))
			return $url;
		else
			return route('media.show',$uuid);
	
	}

	// human friendly file size
	function humanFileSize($size,$unit="") 
	{
		if( (!$unit && $size >= 1<<30) || $unit == " GB")
		  return number_format($size/(1<<30),2)." GB";
		if( (!$unit && $size >= 1<<20) || $unit == " MB")
		  return number_format($size/(1<<20),2)." MB";
		if( (!$unit && $size >= 1<<10) || $unit == " KB")
		  return number_format($size/(1<<10),2)." KB";
		return number_format($size)." bytes";
	}