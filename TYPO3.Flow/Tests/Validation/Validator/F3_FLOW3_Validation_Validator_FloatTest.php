<?php
declare(ENCODING = 'utf-8');
namespace F3::FLOW3::Validation::Validator;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * @package FLOW3
 * @subpackage Tests
 * @version $Id$
 */

/**
 * Testcase for the float validator
 *
 * @package FLOW3
 * @subpackage Tests
 * @version $Id$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class FloatTest extends F3::Testing::BaseTestCase {

	/**
	 * Data provider with valid email addresses
	 *
	 * @return array
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function validFloats() {
		return array(
			array(1029437.234726),
			array('123.45'),
			array('+123.45'),
			array('-123.45'),
			array('123.45e3'),
			array(123.45e3)
		);
	}

	/**
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @test
	 * @dataProvider validFloats
	 */
	public function floatValidatorReturnsTrueForAValidFloat($address) {
		$floatValidator = new F3::FLOW3::Validation::Validator::Float();
		$floatValidator->injectComponentFactory($this->componentFactory);
		$validationErrors = new F3::FLOW3::Validation::Errors();

		$this->assertTrue($floatValidator->isValidProperty($address, $validationErrors));
	}

	/**
	 * Data provider with invalid email addresses
	 *
	 * @return array
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function invalidFloats() {
		return array(
			array(1029437),
			array('1029437'),
			array('not a number')
		);
	}

	/**
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 * @test
	 * @dataProvider invalidFloats
	 */
	public function floatValidatorReturnsFalseForAnInvalidFloat($address) {
		$floatValidator = new F3::FLOW3::Validation::Validator::Float();
		$floatValidator->injectComponentFactory($this->componentFactory);
		$validationErrors = new F3::FLOW3::Validation::Errors();

		$this->assertFalse($floatValidator->isValidProperty($address, $validationErrors));
	}

	/**
	 * @test
	 * @author Andreas Förthner <andreas.foerthner@netlogix.de>
	 */
	public function floatValidatorCreatesTheCorrectErrorObjectForAnInvalidSubject() {
		$floatValidator = new F3::FLOW3::Validation::Validator::Float();
		$floatValidator->injectComponentFactory($this->componentFactory);
		$validationErrors = new F3::FLOW3::Validation::Errors();

		$floatValidator->isValidProperty(123456, $validationErrors);

		$this->assertType('F3::FLOW3::Validation::Error', $validationErrors[0]);
		$this->assertEquals(1221560288, $validationErrors[0]->getErrorCode());
	}

}

?>