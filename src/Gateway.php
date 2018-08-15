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
			'merchant_key' => '',
			'environment' => 'production', // sandbox | production
		);
	}

	public function setMerchantID($merchantID)
	{
		return $this->setParameter('merchant_id', $merchantID);
	}

	public function getMerchantID()
	{
		return $this->getParameter('merchant_id');
	}

	public function setMerchantKey($merchantKey)
	{
		return $this->setParameter('merchant_key', $merchantKey);
	}

	public function getMerchantKey()
	{
		return $this->getParameter('merchant_key');
	}

	public function setEnvironment($environment)
	{
		return $this->setParameter('environment', $environment);
	}

	public function getEnvironment()
	{
		return $this->getParameter('environment');
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