<?php
namespace Fincore\Test;

final class EmailTest extends \PHPUnit\Framework\TestCase {
  public function testCanBeCreatedFromValidEmailAddress(): void
  {
    $this->assertInstanceOf(
      \Fincore\Email::class,
      \Fincore\Email::fromString('user@example.com')
    );
  }

  public function testCannotBeCreatedFromInvalidEmailAddress(): void
  {
    $this->expectException(\InvalidArgumentException::class);
    \Fincore\Email::fromString('invalid');
  }

  public function testCanBeUsedAsString(): void
  {
    $this->assertEquals(
      'user@example.com',
      \Fincore\Email::fromString('user@example.com')
    );
  }
}
