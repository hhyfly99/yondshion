<?php

namespace Member\Form;

use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Element;
use Zend\Captcha\Image as CaptchaImage;

class SignInForm extends Form {
	
	public function __construct($name = null) {
		parent::__construct('Member');
		
		$this->setAttribute('method', 'post');
		
		$this->add(array(
				'name' => 'id',
				'attributes' => array(
					'type' => 'hidden',
				),
			)
		);
		$this->add(array(
				'name' => 'memberName',
				'type' => 'text',
				'options' => array(
					'label' => '姓名:  ',
				),
				/*
				'attributes' => array(
					'type' => 'text',
				),
				*/
			)
		);
		$this->add(array(
				'name' => 'memberPasswd',
				'type' => 'password',
				'options' => array(
					'label' => '密码:  ',
				),
			)
		);
		
		
		$this->add(array(
				'name' => 'captcha',
				'type' => 'Captcha',
				'options' => array(
					'label' => '验证码:  ',
					'captcha' => array(
                        'class' => 'Dumb',
                    ),
				),
			)
		);
		
		/*
		$dirdata = './data';
		$captchaImg = new CaptchaImage(array(
			'Font' => $dirdata . '/font/arial.ttf',
         	'wordlen' => '5',
         	'Height' => '50',
         	'Width' => '100',
			'dotNoiseLevel' => 50,
			'lineNoiseLevel' => 4,
      	));
		$captchaImg->setImgUrl($dirdata . '/captcha');
		$captchaImg->setImgUrl('/images/captcha');
		$this->add(array(
		    'type' => 'Captcha',
		    'name' => 'captcha',
		    'options' => array(
		      'captcha' => $captchaImg,
		    ),
		));
		*/
		
		
		/*
		$captcha = new Element\Captcha('captcha');
		$captcha->setCaptcha(new Captcha\Dumb())->setLabel('Please verify you are human');
		$this->add($captcha);
		*/
		$this->add(array(
	            'name' => 'submit',
	            'attributes' => array(
	                'type'  => 'submit',
	                'value' => 'Go',
	                'id' => 'submitbutton',
	            ),
	        )
        );
	}
}


