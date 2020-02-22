<?php

namespace MyFramework\Helpers\Templates;

class Templates{


	/**
	 * template for input standar
	 * @param  object $instance [description]
	 * @param  string $name     [description]
	 * @param  array  $errors   [description]
	 * @param  string $key      [description]
	 * @return [type]           [description]
	 */
	public static function inputMaker(object $instance, $name, array $errors, string $key)
	{
		$instance->errors = $errors[$key] ?? '';
		if(isset($errors[$key]) AND $errors[$key] !== null) {
            $instance->classListAdvanced = 'form-control input-danger is-invalid';
        }
        if(isset($name) AND $errors !== []) {
            $instance->setValue($name);
        }
		echo $instance->advancedSetInput(70);
		echo $instance->invalidCustomFeedBack($instance->errors);
	}


	/**
	 * template for select
	 * @param  object $instance [description]
	 * @param  array  $options  [description]
	 * @param  array  $errors   [description]
	 * @param  string $key      [description]
	 * @return [type]           [description]
	 */
	public static function inputMakerForSelect(object $instance, array $options, $option, array $errors, string $key)
	{
		$instance->errors = $errors[$key] ?? '';
		if(isset($option) && $errors !== []) {
            $instance->setValue($option);
        }
		echo $instance->setUniqueSelect($options, $option);
		echo $instance->invalidCustomFeedBack($instance->errors);
	}

	/**
	 * template for select
	 * @param  object $instance [description]
	 * @param  array  $options  [description]
	 * @param  array  $errors   [description]
	 * @param  string $key      [description]
	 * @return [type]           [description]
	 */
	public static function inputMakerForMultiSelect(object $instance, array $options, $option, array $errors, string $key)
	{
		$instance->errors = $errors[$key] ?? '';
		if(isset($option) && $errors !== []) {
            $instance->setValue($option);
        }
		echo $instance->setMultiSelect($options, $option);
		echo $instance->invalidCustomFeedBack($instance->errors);
	}


	/**
	 * Template for radio
	 * @param  object $instance [description]
	 * @param  array  $options  [description]
	 * @param  array  $errors   [description]
	 * @param  string $key      [description]
	 * @return [type]           [description]
	 */
	public static function inputMakerForRadio(object $instance, array $options, $option, array $errors, string $key)
	{
		$instance->errors = $errors[$key] ?? '';
		if(isset($option) && $errors !== []) {
            $instance->setValue($option);
        }
		echo $instance->advancedSetInputRadio($options, $option, 10);
		echo $instance->invalidCustomFeedBack($instance->errors);

	}


	public static function formattedNameAndSurname(string $defaultName)
	{

		if ($defaultName == ""  || $defaultName == null || empty($defaultName)) {
			return "";
		}else{
			$each = explode(' ', $defaultName);

			$name = strtoupper($each[0]);

			$tabSurname = [];
			for ($i=1; $i < count($each); $i++) { 
				$tabSurname[] = $each[$i];
			}
			$surname =  ucwords(implode(' ', $tabSurname));

			return implode(' ', [$name, $surname]);
		}

	}


	public static function setTheSecondIfFirstNotSet($first, $second)
	{
		if (!isset($first) || $first == "") {
			return $second;
		}
		else{
			return $first;
		}
	}

	public static function formattedClasseName(string $classeName):?string
	{
		if (strpos('Seconde', $classeName)) {
			
		}
	}



}

