<?php namespace integration;

use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class TagControllerTest extends \IntegrationCase {

	public function setUp()
	{
		parent::setUp();
		$this->setUpDb();
		DB::table('tags')->truncate();
		Auth::loginUsingId(1);
	}

	public function create_tag(){
		$this->visit('tags')
			->submitForm('Send', ['name' => 'test'])
			->see('Your tag has been created.');
		return $this;
	}

	public function test_create_tag(){
		$this->create_tag()->seePageIs('tags');
	}

	public function test_edit_tag(){
		$this->create_tag();

		$this->visit('tags/1')
			->submitForm('Send', ['name' => 'hej'])
			->see('Your tag has been updated.')
			->seePageIs('tags');
	}

	public function test_delete_tag(){
		$this->create_tag();

		$this->visit('tags/delete/1')
			->see('The tag has been deleted.')
			->seePageIs('tags');
	}

	public function test_delete_none_existing_tag(){
		$this->visit('tags')
			->visit('tags/delete/5')
			->see('The tag could not be deleted.')
			->seePageIs('tags');
	}

}