<?php

namespace App\Http\Services;

use App\Enums\GeometryDashKeys;
use App\Enums\GeometryDashSalts;
use App\Exceptions\CommandParseException;
use App\Helpers\Command;

class GeometryDashProxyAccountCommentService
{
	public function __construct(
		protected GeometryDashProxyAccountCommentCommandService $commandService,
		protected GeometryDashAlgorithmService                  $algorithmService,
		protected GeometryDashProxyService                      $proxyService
	)
	{

	}

	public function handleCommand(string $content): string|null
	{
		try {
			$command = new Command($content);

			if (method_exists($this->commandService, $command->name)) {
				return $this->formatMessage(
					$this->commandService->{$command->name}($command)
				);
			}

			return $this->formatMessage('Command not found');
		} catch (CommandParseException) {

		}

		return null;
	}

	protected function formatMessage(string $message): string
	{
		return "temp_98978399_$message";
	}

	public function uploadToOfficial(array $data): string
	{
		$data['chk'] = $this->algorithmService->encode(implode('', [$data['userName'], $data['comment'], 0, 0, $data['cType'], GeometryDashSalts::COMMENT->value]), GeometryDashKeys::COMMENT_CHK->value);
		return $this->proxyService->sendPost('/uploadGJAccComment20.php', $data);
	}
}