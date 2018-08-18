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
		return ''; // TODO;
	}

	public function getMessage()
	{
		return ''; // TODO;
	}

	public function getCode()
	{
		return ''; // TODO;
	}

	public function getTransactionReference()
	{
		return ''; // TODO;
	}

}