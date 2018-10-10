<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:57 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay;


use Omnipay\Common\AbstractGateway;
use zipMoney\Configuration;

class Gateway extends AbstractGateway
{

	public function getName()
	{
		return 'ZipPay';
	}

	public function getDefaultParameters()
	{
		return array(
			'api_key' => '',
			'api_key_prefix' => 'Bearer',
			'platform' => ''
		);
	}


	public function setApiKey($apiKey)
	{
		Configuration::getDefaultConfiguration()->setApiKey('Authorization', $apiKey);
		return $this->setParameter('api_key', $apiKey);
	}

	public function getApiKey()
	{
		return $this->getParameter('api_key');
	}

	public function setApiKeyPrefix($prefix)
	{
		if($prefix) {
			Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', $prefix);
		}
		return $this->setParameter('api_key_prefix', $prefix);
	}

	public function getApiKeyPrefix()
	{
		return $this->getParameter('api_key_prefix');
	}

	public function setPlatform($platform)
	{
		Configuration::getDefaultConfiguration()->setPlatform($platform);
		return $this->setParameter('platform', $platform);
	}


	public function getPlatform()
	{
		return $this->getParameter('platform');
	}

	public function setTestMode($value)
	{
		$env = $value ? 'sandbox' : 'production';
		Configuration::getDefaultConfiguration()->setEnvironment($env);
		return $this->setParameter('testMode', $value);
	}



	public function purchase(array $parameters = array())
	{
		return $this->createRequest('\SilverStripers\OmnipayZipPay\Message\PurchaseRequest', $parameters);
	}

	public function completePurchase(array $parameters = array())
	{
		return $this->createRequest('\SilverStripers\OmnipayZipPay\Message\CompletePurchaseRequest', $parameters);
	}



}