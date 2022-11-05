<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Request\CreatePaymentRequest;

class PaymentController extends Controller
{
    public function sartlarKosullar()
    {
        return Inertia::render('Frontend/ProsedurPages/SartlarKosullar');
    }

    public function payment(Request $request)
    {
//        return $request;
//        return $this->orderNumber();

        if (Auth::user()) {

            $request->validate(
                [
                    "sartkosul" => "accepted",
                ],
                [
                    'sartkosul.accepted' => 'Şartlar ve koşullar alanı boş bırakılamaz!!',
                ]
            );


            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->with('product', 'product.category')->get();
            $totalPrice = 0.0;
            foreach ($carts as $cart) {
                $totalPrice += $cart->product->price != null ? $cart->product->price * $cart->count : $cart->product->old_price * $cart->count;
            }
//            $lastorder = Order::latest()->first();
            $cardName = $request->cardname;
            $cardNo = $request->cardno;
            $cardMonth = $request->month;
            $cardYear = $request->year;
            $cardCvc = $request->cvc;

            if ($request->address_choice == 'yeni_adres') {
                $validated = $request->validate([
                    "name" => "required",
                    "surname" => "required",
                    "country" => "required",
                    "city" => "required",
                    "district" => "required",
                    "zipcode" => "required",
                    "phone" => "required",
                    "address" => "required",
                ],
                    [
                        'name.required' => 'İsim alanı boş bırakılamaz!!',
                        'surname.required' => 'Soyisim alanı boş bırakılamaz!!',
                        'country.required' => 'Ülke alanı boş bırakılamaz!!',
                        'city.required' => 'İl alanı boş bırakılamaz!!',
                        'district.required' => 'İlçe alanı boş bırakılamaz!!',
                        'zipcode.required' => 'Zipkod alanı boş bırakılamaz!!',
                        'phone.required' => 'Telefon alanı boş bırakılamaz!!',
                        'address.required' => 'Adres alanı boş bırakılamaz!!',
                    ]);

                $address = [
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'country' => $request->country,
                    'city' => $request->city,
                    'district' => $request->district,
                    'zipcode' => $request->zipcode,
                    'phone' => $request->phone,
                    'address' => $request->new_address,
                ];
            } else {
                $address = Address::where('id', $request->address['id'])->first();
//                return $address->city;
            }
            $address = (object)$address;
//            return $address->zipcode;

            $options = new \Iyzipay\Options();
            $options->setApiKey(env("TEST_IYZI_API_KEY"));
            $options->setSecretKey(env("TEST_IYZI_SECRET_KEY"));
            $options->setBaseUrl(env("TEST_IYZI_BASE_URL"));


            $orderNumber = $this->orderNumber();

            $payrequest = new \Iyzipay\Request\CreatePaymentRequest();
            $payrequest->setLocale(\Iyzipay\Model\Locale::TR);
            $payrequest->setConversationId($orderNumber);
            $payrequest->setPrice($totalPrice);
            $payrequest->setPaidPrice($totalPrice);
            $payrequest->setCurrency(\Iyzipay\Model\Currency::TL);
            $payrequest->setInstallment(1); //taksit seçeneğini belirlediğimiz yer
//            $payrequest->setBasketId($lastorder->id);
            $payrequest->setBasketId($orderNumber);
            $payrequest->setPaymentChannel(PaymentChannel::WEB);
            $payrequest->setPaymentGroup(PaymentGroup::PRODUCT);


            $paymentCard = new PaymentCard();
            $paymentCard->setCardHolderName($cardName);
            $paymentCard->setCardNumber($cardNo);
            $paymentCard->setExpireMonth($cardMonth);
            $paymentCard->setExpireYear($cardYear);
            $paymentCard->setCvc($cardCvc);
            $paymentCard->setRegisterCard(0);//kartı kaydetme kısmı. iyziko kendi datasında saklıyo sanırım.
            $payrequest->setPaymentCard($paymentCard);


            $buyer = new Buyer();
            $buyer->setId($user->id);
            $buyer->setName($user->name);
            $buyer->setSurname($user->surname);
            $buyer->setGsmNumber($address->phone);
            $buyer->setEmail($user->email);
            $buyer->setIdentityNumber("11111111111");
//            $buyer->setLastLoginDate("2015-10-05 12:43:35");
//            $buyer->setRegistrationDate("2013-04-21 15:12:09");
            $buyer->setRegistrationAddress($address->address);
            $buyer->setIp($_SERVER["REMOTE_ADDR"]);
            $buyer->setCity($address->city);
            $buyer->setCountry($address->country);
            $buyer->setZipCode($address->zipcode);
            $payrequest->setBuyer($buyer);


            $shippingAddress = new \Iyzipay\Model\Address();
            $shippingAddress->setContactName($address->name . ' ' . $address->surname);
            $shippingAddress->setCity($address->city);
            $shippingAddress->setCountry($address->country);
            $shippingAddress->setAddress($address->address);
            $shippingAddress->setZipCode($address->zipcode);
            $payrequest->setShippingAddress($shippingAddress);

            $billingAddress = new \Iyzipay\Model\Address();
            $billingAddress->setContactName($address->name . ' ' . $address->surname);
            $billingAddress->setCity($address->city);
            $billingAddress->setCountry($address->country);
            $billingAddress->setAddress($address->address);
            $billingAddress->setZipCode($address->zipcode);
            $payrequest->setBillingAddress($billingAddress);


            foreach ($carts as $cart) {
                $item = new \Iyzipay\Model\BasketItem();
                $item->setId($cart->product_id);
                $item->setName($cart->product->name);
                $item->setCategory1($cart->product->category->name);
//              $item->setCategory2("Usb / Cable");
                $item->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
                $newprice = $cart->product->price !== null ? $cart->product->price : $cart->product->old_price;
                $newprice = $newprice * $cart->count;
                $item->setPrice($newprice);
                $basketItems[] = $item;
            }

            $payrequest->setBasketItems($basketItems);


            $payment = \Iyzipay\Model\Payment::create($payrequest, $options);


//            Mail::send([],[],function ($message) use($request) {
//                $message->from('albatros@info.com', 'Albatros Kitabevi');
//                $message->to('omer.470@hotmail.com');
//                $message->subject('Sipariş Detayları');
////                $message->setBody('hello');
//            });

//            Mail::send([],[],function ($message) use($request) {
//                $message->from(env('MAIL_USERNAME'), 'Albatros Kitabevi');
//                $message->to('omer.470@hotmail.com');
//                $message->subject('Albatros Kitabevi');
//                $message->setBody($rt->name, 'text/html');
//            });


            if ($payment->getStatus() == "success") {


                if ($request->address_choice == 'yeni_adres') {
                    $address = (array)$address;
                    $address = Address::create($address);
                }

                $order = Order::create([
                    'address_id' => $address->id,
                    'user_id' => $request->user_id,
                    'order_number' => $orderNumber,
                    'total_price' => $totalPrice,
                    'iyziPaymentId' => $payment->getPaymentId(),
                    'status' => 1,
                ]);


                if ($order) {

                    $i = 0;
                    foreach ($carts as $cart) {
                        $orderDetail = OrderDetail::create([
                            'order_id' => $order->id,
                            'product_id' => $cart->product_id,
                            'count' => $cart->count,
                            'price' => $cart->product->price != null ? $cart->product->price : $cart->product->old_price,
                            'total_price' => $cart->product->price != null ? $cart->product->price * $cart->count : $cart->product->old_price * $cart->count,
                            'iyziPaymentTransactionId' => $payment->getPaymentItems()[$i]->getPaymentTransactionId()
                        ]);
                        $i++;

                        $product = Product::where('id', $cart->product_id)->first();
                        $product->stok = $product->stok - $cart->count;
                        $product->save();
                    }
                }

                Mail::raw('Siparişiniz alındı..Firmamız adına teşekkür ederiz... Sipariş Numaranız: ' . $orderNumber, function ($message) use ($request, $user) {
                    $message->from('albatros@info.com', 'Albatros Kitabevi');
                    $message->to($user->email);
//                $message->setBody('Siparişiniz alınmıştır..');
                    $message->subject('Albatros Kitabevi');
                });

                Cart::where('user_id', $user->id)->delete();


                return redirect()->route('/');


            } else {

                return $payment->getErrorMessage();

            }


        } else {
            return Inertia::render('Frontend/Login');
        }
    }

    public function orderNumber()
    {
        $date = date("Ymd");
        $ilk = strtoupper(substr(uuid_create(), 0, 7));
        $son = strtoupper(substr(uuid_create(), 0, 7));
        return $number = $ilk . $date . $son;
    }
}
