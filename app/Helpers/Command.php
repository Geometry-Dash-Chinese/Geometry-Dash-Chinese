<?php

namespace App\Helpers;

use App\Exceptions\CommandParseException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Command
{
	public string $name;
	public array $parameters = [];
	public array $arguments = [];

	protected string $start;
	protected string $argumentStart;
	protected string $argumentDelimiter;

	/**
	 * @throws CommandParseException
	 */
	public function __construct(string $content)
	{
		$this->start = config('GeometryDashChinese.command.start', '!');
		$this->argumentStart = config('GeometryDashChinese.command.argument.start', ':');
		$this->argumentDelimiter = config('GeometryDashChinese.command.argument.delimiter', '=');

		if (!Str::startsWith($content, $this->start)) {
			throw new CommandParseException(
				__('命令必须以 :commandStart 开头', [
					'commandStart' => $this->start
				])
			);
		}

		$parts = explode(' ', $content);
		$this->name = ltrim(array_shift($parts), $this->start);

		foreach ($parts as $part) {
			if ($this->isArgument($part)) {
				$this->parseArgument($part);
			}

			if ($this->isParameter($part)) {
				$this->parseParameter($part);
			}
		}
	}

	protected function isArgument(string $part): bool
	{
		return Str::startsWith($part, $this->argumentStart) && Str::contains($part, $this->argumentDelimiter);
	}

	protected function parseArgument(string $part): void
	{
		[$key, $value] = explode($this->argumentDelimiter, $part, 2);

		if (!empty($key)) {
			if (empty($value)) {
				$value = true;
			}

			Arr::set($this->arguments, ltrim($key, $this->argumentStart), $value);
		}
	}

	protected function isParameter(string $part): bool
	{
		return !Str::startsWith($part, $this->start) && !$this->isArgument($part);
	}

	protected function parseParameter(string $part): void
	{
		$this->parameters[] = $part;
	}
}