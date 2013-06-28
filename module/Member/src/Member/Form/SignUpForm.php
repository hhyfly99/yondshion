<?php

namespace Member\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\Captcha as CaptchaFormElement;
use Zend\Captcha\ReCaptcha;
use ZendService\ReCaptcha\ReCaptcha as ReCaptchaService;
use Zend\Form\Element\Checkbox;
//use Zend\Captcha\Image as CaptchaImage;

class SignUpForm extends Form {
	
	public function __construct($name = null) {
		parent::__construct('Member');
		
		$this->setAttribute('method', 'post');
		
		$this->add(array(
				'name' => 'id',
				'type' => 'hidden',
				/*
				'attributes' => array(
					'type' => 'hidden',
				),
				*/
			)
		);
		
		$this->add(array(
				'name' => 'memberName',
				'type' => 'text',
				'options' => array(
					'label' => '姓名:  ',
				),
			)
		);
		$this->add(array(
				'name' => 'memberMail',
				'type' => 'Email',
				'options' => array(
					'label' => '邮箱:  ',
				),
			)
		);
		/*
		$this->add(array(
				'name' => 'memberPhone',
				'options' => array(
					'label' => '手机:  ',
				),
				'attributes' => array(
					'type' => 'text',
					//'pattern'  => '/^(086|86){?}1(5[0-35-9]|8[06789]|3[0-9]|47)\d{8}$/',
				),
			)
		);
		*/
		$this->add(array(
				'name' => 'memberPasswd',
				'type' => 'password',
				'options' => array(
					'label' => '密码:  ',
				),
			)
		);
		$this->add(array(
				'name' => 'memberPasswdComfirm',
				'type' => 'password',
				'options' => array(
					'label' => '确认密码:',
				),
			)
		);
		
		$options = array(
			'theme' => 'clean', 
			'lang' => 'zh',
		);
		$reCaptchaService = new ReCaptchaService(PUBKEY, PRIVKEY, null, $options);
		$reCaptcha = new ReCaptcha();
		$reCaptcha->setService($reCaptchaService);
		$this->add(array(
				'name' => 'captcha',
				'type' => 'Captcha',
				'options' => array(
					'label' => '验证码:  ',
					'captcha' => $reCaptcha,
					'service' => $reCaptchaService,
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
			'messages' => array(
				'badCaptcha' => '验证码不正确',
			),
      	));
		$captchaImg->setImgUrl($dirdata . '/captcha');
		$captchaImg->setImgUrl('/images/captcha');
		$this->add(array(
		    'type' => 'Captcha',
		    'name' => 'captcha',
		    'options' => array(
				'label' => '验证码:  ',
		    	'captcha' => $captchaImg,
		    ),
		));
		*/
		
		//$agreement = new Checkbox('agreement');
		$this->add(array(
			'type' => 'Checkbox',
			'name' => 'agreement',
			'options' => array(
				'label' => '同意协议',
				'use_hidden_element' => true,
				'checked_value' => 1,
                'unchecked_value' => 'no',
			)
		));
		
		/*
		$this->add(array(
			'type' => 'Button',
			'name' => 'protocolInfo',
			'options' => array(
				'label' => '',
			),
		));
		*/
		/*
		$protocolInfo = new Textarea('protocolInfo');
		$protocolInfo->setLabel('ffffffffffffffffffffffffffffffffffffff');
		$this->add($protocolInfo);
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


