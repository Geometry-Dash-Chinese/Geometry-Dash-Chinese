<?php

namespace App\Http\Controllers;

use App\Exceptions\CommandParseException;
use App\Helpers\Command;
use App\Http\Requests\GeometryDashAccountCommentUploadRequest;
use App\Http\Services\GeometryDashProxyAccountCommentService;
use Base64Url\Base64Url;
use Illuminate\Support\Arr;

class GeometryDashProxyAccountCommentController extends Controller
{
	public function __construct(
		protected GeometryDashProxyAccountCommentService $service
	)
	{
	}

	public function proxyUpload(GeometryDashAccountCommentUploadRequest $request)
	{
		$data = $request->all();
		$content = base64_decode($data['comment']);

		try {
			$command = new Command($content);
			$replacement = Base64Url::encode(Arr::get($command->arguments, 'message', 'owo'));
			$data['comment'] = $replacement;

			$isCommand = true;
		} catch (CommandParseException) {
			$isCommand = false;
		}

		$response = $this->service->uploadToOfficial($data);

		if ($response !== '-1' && $isCommand) {
			$commandResponse = $this->service->handleCommand($content);

			if (!empty($commandResponse)) {
				return $commandResponse;
			}
		}

		return $response;
	}
}