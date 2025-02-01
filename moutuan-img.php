<?php
	// 设置格式并检测上传
	header('Content-Type: application/json');
	$response = array(
		'status' => 'warning',
		'tips' => '请求错误，请选文件上传。',
	);

	// 处理文件上传
	if (isset($_FILES['file'])) {
		// 获取件并设请求头
		$file = $_FILES['file'];
		$headers = array(
			'Accept: */*',
			'Pragma: no-cache',
			'sec-ch-ua-mobile: ?0',
			'Sec-Fetch-Mode: cors',
			'Sec-Fetch-Dest: empty',
			'Connection: keep-alive',
			'Cache-Control: no-cache',
			'Host: pic-up.meituan.com',
			'Sec-Fetch-Site: same-site',
			'sec-ch-ua-platform: "Windows"',
			'Origin: https://czz.meituan.com',
			'Referer: https://czz.meituan.com/',
			'Accept-Encoding: gzip, deflate, br',
			'client-id: p5gfsvmw6qnwc45n000000000025bbf1',
			'Accept-Language: zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
			'sec-ch-ua: "Not A(Brand";v="99", "Microsoft Edge";v="121", "Chromium";v="121"',
			'Content-Type: multipart/form-data; boundary=----WebKitFormBoundarywt1pMxJgab51elEB',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0',
			'token: YOUR-MOUTUAN-USER-TOKEN', // 这里需要替换为您自己的美团用户Token才能用，网上有教程可以自己搜一下噢。
		);

		// 构建multipart/form-data数据
		$postData = "------WebKitFormBoundarywt1pMxJgab51elEB\r\n";
		$postData .= 'Content-Disposition: form-data; name="file"; filename="' . $file['name'] . "\"\r\n";
		$postData .= 'Content-Type: ' . $file['type'] . "\r\n\r\n";
		$postData .= file_get_contents($file['tmp_name']) . "\r\n";
		$postData .= "------WebKitFormBoundarywt1pMxJgab51elEB--\r\n";

		// 使用Curl上传文件到某团
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_URL, 'https://pic-up.meituan.com/extrastorage/new/video?isHttps=true');
		$response = curl_exec($ch);

		// 检查是否有错误的发生
		if (curl_errno($ch)) {
			$response = array(
				'status' => 'warning',
				'tips' => '请求错误，出现网络问题。',
			);
		} else {
			// 停止Curl并继续判断
			curl_close($ch);
			$jsonResponse = json_decode($response, true);

			// 检查是否上传成功
			if (isset($jsonResponse['success']) && $jsonResponse['success'] === true) {
				// 提取原链接和原件名
				$originalLink = $jsonResponse['data']['originalLink'];
				$originalFileName = $jsonResponse['data']['originalFileName'];
				
				// 组成新的Json数组输出
				$response = array(
					'status' => 'success',
					'jobs' => $originalLink,
					'name' => $originalFileName,
					'tips' => '上传成功，文件连接成功。',
				);
			} else {
				// 上传失败输出错误
				$response = array(
					'status' => 'warning',
					'tips' => '上传失败，远程服务问题。',
				);
			}
		}
	}

	// 输出响应结果
	echo json_encode($response);
	/* 本项目基于前辈 www.lyszm.com 的代码 */
?>
