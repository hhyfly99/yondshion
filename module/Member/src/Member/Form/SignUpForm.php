<?php

namespace Member\Form;

use Zend\Captcha\ReCaptcha;

use Zend\Form\Element\Textarea;

use Zend\Form\Element\Checkbox;

use Zend\Form\Annotation\Options;

use Zend\Form\Element;

use Zend\Mvc\Router\Http\Method;
//use ZendService\ReCaptcha\ReCaptcha;
use Zend\Form\Form;
use Zend\Captcha\Image as CaptchaImage;
use Zend\Captcha\Factory;
//use Zend\Captcha;

class SignUpForm extends Form {
	
	//protected $captcha;
	/*
	public function setCaptcha(CaptchaAdapter $captcha) {
		$captcha = new Captcha\Dumb();
		$this->captcha = $captcha;
	}
	*/
	
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
				'options' => array(
					'label' => '姓名:  ',
				),
				'attributes' => array(
					'type' => 'text',
				),
			)
		);
		$this->add(array(
				'name' => 'memberMail',
				'options' => array(
					'label' => '邮箱:  ',
				),
				'attributes' => array(
					'type' => 'Email',
				),
			)
		);
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
		$this->add(array(
				'name' => 'memberPasswd',
				'options' => array(
					'label' => '密码:  ',
				),
				'attributes' => array(
					'type' => 'password',
				),
			)
		);
		$this->add(array(
				'name' => 'memberPasswdComfirm',
				'options' => array(
					'label' => '确认密码:',
				),
				'attributes' => array(
					'type' => 'password',
				),
			)
		);

		
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
		
		/*
		$options = array(
			'theme' => 'clean', 
			'lang' => 'zh',
		);
		$reCaptcha = new ReCaptcha(PUBKEY, PRIVKEY, null, $options);
		//var_dump($reCaptcha);
		
		$captcha = new Element\Captcha('captcha');
		$captcha->setCaptcha('reCaptcha')->setService($reCaptcha->getHtml());
		$this->add($captcha);
		
		//$cap = new Recaptcha();
		
		$captcha = new Element\Captcha('captcha');
		$captcha->setCaptcha($reCaptcha);
		$this->add($captcha);
		*/
		/*
		$this->add(array(
		    'type' => 'reCaptcha',
			'name' => 'captcha',
		    'options' => array(
				
		      	'captcha' => 'Captcha',
				'service' => $reCaptcha,
				
				//'captcha' => $reCaptcha,
		    ),
		));		
		*/
		
		/*
		$captcha = new Element\Captcha('captcha');
		$captcha->setCaptcha($this->captcha);
		$this->add($captcha);
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


