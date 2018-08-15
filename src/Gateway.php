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
			'merchant_id' => '',
			'merchant_key' => ''
		);
	}

	public function setMerchantID($merchantID)
	{
		Configuration::$merchant_id = $merchantID;
		return $this->setParameter('merchant_id', $merchantID);
	}

	public function getMerchantID()
	{
		return $this->getParameter('merchant_id');
	}

	public function setMerchantKey($merchantKey)
	{
		Configuration::$merchant_key = $merchantKey;
		return $this->setParameter('merchant_key', $merchantKey);
	}

	public function getMerchantKey()
	{
		return $this->getParameter('merchant_key');
	}

	public function setTestMode($value)
	{
		Configuration::$environment = $value ? 'production' : 'sandbox';
		return $this->setParameter('testMode', $value);
	}

	public function purchase(array $parameters = array())
	{
		return $this->createRequest('\SilverStripers\OmnipayZipPay\Messages\PurchaseRequest', $parameters);
	}

	public function completePurchase(array $parameters = array())
	{
		return $this->createRequest('\SilverStripers\OmnipayZipPay\Messages\CompletePurchaseRequest', $parameters);
	}



}