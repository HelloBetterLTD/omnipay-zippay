<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:59 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Message;


use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
	public function isSuccessful()
	{
		return true;
	}

	public function getMessage()
	{
		return '';
	}

	public function getCode()
	{
		return '';
	}

	public function getTransactionReference()
	{
		return '';
	}

}