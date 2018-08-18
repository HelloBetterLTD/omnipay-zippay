<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Messages;


use Omnipay\Common\Message\AbstractRequest;
use zipMoney\Api\Checkout;
use zipMoney\Request\Order;

class PurchaseRequest extends AbstractRequest
{

	public function getData()
	{

		/*
//		$checkout->request->cart_url    = "https://your-domain/checkout/cart/";
//		$checkout->request->success_url = $this->succ;
//		$checkout->request->cancel_url  = "https://your-domain/zipmoney/express/cancel/";
//		$checkout->request->error_url   = "https://your-domain/zipmoney/express/error/";
//		$checkout->request->refer_url   = "https://your-domain/zipmoney/express/refer/";
//		$checkout->request->decline_url = "https://your-domain/zipmoney/express/decline/";

		$order = new Order();
		$order->id = 1;
		$order->tax = 110;
		$order->shipping_tax = 0;
		$order->shipping_value = 10;
		$order->total = 120;

		$checkout->request->order = $order;

		try{
			$response = $checkout->process();

			if($response->isSuccess()){
				echo 'success';
				//Do Something
			} else {
				//Handle Error
			}

		} catch (\Exception $e){
			// Handle Error
		}

		die();

		*/
	}

	public function sendData($data)
	{


		echo '<pre>' . print_r($data, 1) . '</pre>';
		die();

		$checkout = new Checkout();
		$checkout->request->charge = false;
		$checkout->request->currency_code = "AUD";
		$checkout->request->txn_id = false;
		$checkout->request->order_id =  $this->getTransactionId();
		$checkout->request->in_store = false;


		// $checkout->request->cart_url    = "https://your-domain/checkout/cart/";
		$checkout->request->success_url = $this->getReturnUrl(); //"https://your-domain/checkout/success/";
		$checkout->request->cancel_url  = $this->getCancelUrl(); "https://your-domain/zipmoney/express/cancel/";
		$checkout->request->error_url   = $this->getReturnUrl(); //"https://your-domain/zipmoney/express/error/";
		//$checkout->request->refer_url   = "https://your-domain/zipmoney/express/refer/";
		$checkout->request->decline_url = $this->getReturnUrl(); //"https://your-domain/zipmoney/express/decline/";

		$order = new Order();
		$order->id = $orderID;
		$order->tax = 1;
		$order->shipping_tax = 0;
		$order->shipping_value = 1;
		$order->total = 2;



		$checkout = new Checkout();
		$checkout->request->charge = false;
		$checkout->request->currency_code = $this->getCurrency();
		$checkout->request->txn_id = false;
		$checkout->request->order_id =  $this->getTestMode();
		$checkout->request->in_store = false;

		return $this->response = new PurchaseResponse($this, $data);
	}


}