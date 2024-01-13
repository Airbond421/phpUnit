<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
	/**
	 * @dataProvider  IdenticalParenthesisProvider
	 * @return void
	 */
	public function testIdenticalParenthesisValid($input, $actual): void
	{
		$expected = isParenthesisValid($input);
		$this->assertEquals($expected, $actual);
	}

	public function IdenticalParenthesisProvider(): array
	{
		return [
			['dasd (dsa) dsa', true],
			['djsaiod (dosadokas', false],
			['dlpasdla (dsada (dsa) dsa)', true],
			['dsaldna (dsa) dsa (dsa)', true],
			['dmsakl) dsa (', false],
			['dasd [dsa] dsa', true],
			['djsaiod [dosadokas', false],
			['dlpasdla [dsada [dsa] dsa]', true],
			['dsaldna [dsa] dsa [dsa]', true],
			['dmsakl] dsa [', false],
			['dasd {dsa} dsa', true],
			['djsaiod {dosadokas', false],
			['dlpasdla {dsada {dsa} dsa}', true],
			['dsaldna {dsa} dsa {dsa}', true],
			['dmsakl} dsa {', false],
		];
	}

	/**
	 * @dataProvider  MixedParenthesisProvider
	 * @return void
	 */
	public function testMixedParenthesisValid($input, $actual): void
	{
		$expected = isParenthesisValid($input);
		$this->assertEquals($expected, $actual);
	}

	public function MixedParenthesisProvider(): array
	{
		return [
			['das {d (dsa) d} sa', true],
			['djsaiod (do] sadokas', false],
			['dlpasdla (dsada \<dsa\> dsa)', true],
			['dsaldna (dsa) [dsa] {dsa}', true],
			['dmsakl) dsa {', false],
			['dasd ([dsa] {dsa})', true],
			['djsaiod [dosadoka {s', false],
			['dmsakl {dsa]', false],
		];
	}

	public function testWithoutParenthesisValid(): void
	{
		$expected = isParenthesisValid('dsadasd fkdsml fsdlk');
		$this->assertTrue($expected);
	}

	public function testEmptyLineValid(): void
	{
		$this->expectException(\EmptyLine::class);
		isParenthesisValid('');
	}
}
