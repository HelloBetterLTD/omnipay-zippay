<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Message;


use Omnipay\Common\Message\AbstractRequest;
use zipMoney\Api\Checkout;
use zipMoney\Configuration;
use zipMoney\Request\Order;

class PurchaseRequest extends AbstractRequest
{

	public function getData()
	{
		return array(
			'currency_code' => $this->getCurrency(),
			'order_id' => $this->getTransactionId(),
			'success_url' => $this->getReturnUrl(),
			'cancel_url' => $this->getCancelUrl(),
			'error_url' => $this->getNotifyUrl(),
			'decline_url' => $this->getNotifyUrl(),
			'total' => $this->getAmount()
		);
	}

	public function sendData($data)
	{
		$checkout = new Checkout();
		$checkout->request->charge = false;
		$checkout->request->currency_code = $data['currency_code'];
		$checkout->request->txn_id = false;
		$checkout->request->order_id =  $data['order_id'];
		$checkout->request->in_store = false;


		$checkout->request->success_url =  $data['success_url'];
		$checkout->request->cancel_url =  $data['cancel_url'];
		$checkout->request->error_url =  $data['error_url'];
		$checkout->request->decline_url =  $data['decline_url'];

		$order = new Order();
		$order->id = $data['order_id'];
		$order->tax = 0;
		$order->shipping_tax = 0;
		$order->shipping_value = 0;
		$order->total = $data['total'];

		$checkout->request->order = $order;

		try{
			$response = $checkout->process();
			$this->response = new PurchaseResponse($this, $data);
			if($response->isSuccess()){
				$redirectURL = $response->getRedirectUrl();
				$this->response->setRedirectURL($redirectURL);
			} else {
			}

			return $this->response;

		} catch (\Exception $e){
			echo $e->getMessage();
			// TODO: Handle Error
		}

	}


}