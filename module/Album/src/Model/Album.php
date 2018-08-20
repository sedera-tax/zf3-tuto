<?php
namespace Album\Model;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;

class Album implements InputFilterAwareInterface {
	/**
	 * @var int
	 */
	public $id;

	/**
	 * @var string
	 */
	public $artist;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $email;

	/**
	 * @var InputFilterInterface
	 */
	private $inputFilter;

	public function exchangeArray(array $data)
	{
		$this->id = !empty($data['id']) ? $data['id'] : null;
		$this->artist = !empty($data['artist']) ? $data['artist'] : null;
		$this->title = !empty($data['title']) ? $data['title'] : null;
		$this->email = !empty($data['email']) ? $data['email'] : null;
	}

	public function getArrayCopy() {
		return [
			'id' => $this->id,
			'artist' => $this->artist,
			'title' => $this->title,
			'email' => $this->email,
		];
	}

	/**
	 * @inheritDoc
	 */
	public function setInputFilter( InputFilterInterface $inputFilter ) {
		throw new \DomainException(sprintf(
			'%s does not allow injection of an alternate input filter',
			__CLASS__
		));
	}

	/**
	 * @inheritDoc
	 */
	public function getInputFilter() {
		if ($this->inputFilter) {
			return $this->inputFilter;
		}

		$inputFilter = new InputFilter();

		$inputFilter->add([
			'name' => 'id',
			'required' => true,
			'filters' => [
				['name' => ToInt::class],
			],
		]);

		$inputFilter->add([
			'name' => 'artist',
			'required' => true,
			'filters' => [
				['name' => StripTags::class],
				['name' => StringTrim::class],
			],
			'validators' => [
				[
					'name' => StringLength::class,
					'options' => [
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 100,
					],
				],
			],
		]);

		$inputFilter->add([
			'name' => 'title',
			'required' => true,
			'filters' => [
				['name' => StripTags::class],
				['name' => StringTrim::class],
			],
			'validators' => [
				[
					'name' => StringLength::class,
					'options' => [
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 100,
					],
				],
			],
		]);

		$inputFilter->add([
			'name' => 'email',
			'required' => false,
			'filters' => [
				['name' => StripTags::class],
				['name' => StringTrim::class],
			],
			'validators' => [
				[
					'name' => StringLength::class,
					'options' => [
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' => 255,
					],
				],
				[
					'name' => EmailAddress::class,
					'options' => [
						'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
						'useMxCheck' => false,
					],
				]
			],
		]);

		$this->inputFilter = $inputFilter;
		return $this->inputFilter;
	}
}