<?php

namespace h4kuna\Fio\Test;

use h4kuna\Fio,
	h4kuna\Fio\Test;

/**
 * @author Milan Matějček
 */
class Queue implements Fio\Request\IQueue
{

	public function download($token, $url)
	{
		$file = '';
		switch (basename($url, 'json')) {
			case 'transactions.':
				preg_match('~((?:/[^/]+){3})$~U', $url, $find);
				$file = str_replace(['/', '-' . $token], ['-', ''], ltrim($find[1], '/'));
				break;
		}
		if ($file) {
			return Test\Utils::getContent($file);
		}
		return $file;
	}

	public function upload($url, $token, array $post, $filename)
	{
		return file_get_contents($filename);
	}

}
