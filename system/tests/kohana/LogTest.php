<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

/**
 * Tests Kohana Logging API
 *
 * @group kohana
 * @group kohana.logging
 *
 * @package    Unittest
 * @author     Kohana Team
 * @author     Matt Button <matthew@sigswitch.com>
 * @copyright  (c) 2008-2010 Kohana Team
 * @license    http://kohanaphp.com/license
 */
Class Kohana_LogTest extends Kohana_Unittest_TestCase
{

	/**
	 * Tests that when a new logger is created the list of messages is initially
	 * empty
	 *
	 * @test
	 * @covers Kohana_Log
	 */
	public function test_messages_is_initially_empty()
	{
		$logger = new Kohana_Log;

		$this->assertAttributeSame(array(), '_messages', $logger);
	}

	/**
	 * Tests that when a new logger is created the list of writers is initially
	 * empty
	 *
	 * @test
	 * @covers Kohana_Log
	 */
	public function test_writers_is_initially_empty()
	{
		$logger = new Kohana_Log;

		$this->assertAttributeSame(array(), '_writers', $logger);
	}

	/**
	 * Test that attaching a log writer adds it to the array of log writers
	 *
	 * @TODO Is this test too specific?
	 *
	 * @test
	 * @covers Kohana_Log::attach
	 */
	public function test_attach_attaches_log_writer_and_returns_this()
	{
		$logger = new Kohana_Log;
		$writer = $this->getMockForAbstractClass('Kohana_Log_Writer');

		$this->assertSame($logger, $logger->attach($writer));

		$this->assertAttributeSame(
			array(spl_object_hash($writer) => array('object' => $writer, 'types' => NULL)),
			'_writers',
			$logger
		);
	}

	/**
	 * When we call detach() we expect the specified log writer to be removed
	 *
	 * @test
	 * @covers Kohana_Log::detach
	 */
	public function test_detach_removes_log_writer_and_returns_this()
	{
		$logger = new Kohana_Log;
		$writer = $this->getMockForAbstractClass('Kohana_Log_Writer');

		$logger->attach($writer);

		$this->assertSame($logger, $logger->detach($writer));

		$this->assertAttributeSame(array(), '_writers', $logger);
	}


}
