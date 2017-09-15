<?php

namespace App\Helpers;

use Symfony\Component\Process\Process;
use Exception;

class YProcess {

	private $ytb;

	public function __construct(Youtube $ytb) {
		$this->ytb = $ytb;
	}

	public function urlBuilder($id) {
		return 'https://www.youtube.com/get_video_info?video_id=' . $id . '&&asv=3&el=detailpage&hl=en_US';
	}

	public function getInfo() {
		$info = file_get_contents($this->urlBuilder($this->ytb->id));
		parse_str($info, $decodeInfo);
		foreach ($decodeInfo as $key => $value) {
			$this->ytb->$key = $value;
		}

		parse_str($this->ytb->url_encoded_fmt_stream_map, $streamMap);
		$url = $streamMap['url'];
		$url = parse_url($streamMap['url']);
		parse_str($url['query'], $query);


        $query['mime'] = 'video/mp4';
		$url['query'] = http_build_query($query);

		return implode('', [$url['scheme'], '://', $url['host'], $url['path'], '?', $url['query']]);
	}

	public function getVideo() {
		$file = storage_path('videos/video.mp4');
		try {
			file_put_contents($file, fopen($this->getInfo(), 'r'));	
		} catch (Exception $e) {
			var_dump($e->getMessage());
			die();
		}

		return $file;
	}

	public function convert() {
		$this->getInfo();
		$video = $this->getVideo();
		$audio = storage_path('videos/' . str_slug($this->ytb->title) . '_' . time() . '.mp3');
		try {
			$process = new Process('ffmpeg -i ' . $video . ' -f mp3 -ab 320000 -vn ' . $audio);
			$process->run();
		} catch (Exception $e) {
			var_dump($e->getMessage());
			die();
		}

		return $audio;
	}

}