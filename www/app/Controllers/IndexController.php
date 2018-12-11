<?php
namespace Controllers;

class IndexController
{
    public function test(){
        echo 'what u wanna do';
    }

	public function randWords()
	{
		$stuffArray = ['施工中', '崩崩中', 'G排中', 'QQ中'];

		$rand_result = array_rand($stuffArray, 1);

		echo $rand_result;
	}

    
    
}