<?php

namespace Member\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Captcha as CaptchaFormElement;
use Zend\Captcha\ReCaptcha;
use ZendService\ReCaptcha\ReCaptcha as ReCaptchaService;
//use Zend\Captcha\Image as CaptchaImage;

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
		
		$options = array(
			'theme' => 'clean', 
			'lang' => 'zh',
		);
		/*
		$captchaService = new ReCaptchaService(PUBKEY, PRIVKEY);        
	    $recaptcha = new ReCaptcha();
	    $recaptcha->setService($captchaService);
	    $captcha = new CaptchaFormElement('captcha');
	    $captcha->setLabel('验证码:  ');
	    $captcha->setCaptcha($recaptcha);
	    $this->add($captcha);
	    */
		$reCaptchaService = new ReCaptchaService(PUBKEY, PRIVKEY, null, $options);
		$reCaptcha = new ReCaptcha();
		$reCaptcha->setService($reCaptchaService);
		$this->add(array(
				'name' => 'captcha',
				'type' => 'Captcha',
				'options' => array(
					'label' => '验证码:  ',
					'service' => $reCaptchaService,
					'captcha' => $reCaptcha,
				),
			)
		);
		
		/*
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
		*/
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


